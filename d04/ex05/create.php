<?php

class			UsersDB {
	public		$autosave = TRUE;
	public		$src_dir = '../private';
	public		$src_file = '../private/passwd';
	private		$users = [];

	static function		hash($data)
	{
		return (hash('whirlpool', '@#$@#@ *(e D(44'.$data.'#@*$W#(@) #()'));
	}

	function		__construct() 
	{
		if (file_exists($this->src_file))
			$this->users = unserialize(file_get_contents($this->src_file));
	}

	function		save()
	{
		if (!file_exists($this->src_dir))
			mkdir($this->src_dir);
		return (file_put_contents($this->src_file, serialize($this->users)));
	}

	function		add_user($login, $passwd) {
		if ($login == '' || $passwd == '')
			return (FALSE);

		if ($this->get_user($login))
			return (FALSE);

		$this->users[] = [
			'login' => $login,
			'passwd' => self::hash($passwd)
		];

		if ($this->autosave)
			return ($this->save());
	}

	function		get_user($login) {
		foreach ($this->users as $user)
		{
			if (isset($user['login']) && $user['login'] == $login)
				return ($user);
		}
		return (FALSE);
	}
}

$error = TRUE;

if (isset($_POST['login']) 
	&& isset($_POST['passwd']))
{
	$db = new UsersDB;

	if ($db->add_user($_POST['login'], $_POST['passwd']))
		$error = FALSE;
}

if (!$error)
{
	echo("OK\n");
	header('Location: index.html');
}
else
	echo("ERROR\n");

?>