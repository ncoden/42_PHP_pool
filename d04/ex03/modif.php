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

	function		get_user_index($login) {
		foreach ($this->users as $id => $user)
		{
			if (isset($user['login']) && $user['login'] == $login)
				return ($id);
		}
		return (-1);
	}

	function		get_user_data($login, $index) {
		foreach ($this->users as $user)
		{
			if (isset($user['login']) && $user['login'] == $login 
				&& isset($user[$index]))
				return ($user[$index]);
		}
		return (FALSE);
	}

	function		set_user_data($login, $index, $data) {
		if ($index != '' && ($id = $this->get_user_index($login)) != -1)
		{
			$this->users[$id][$index] = $data;
			if ($this->autosave)
				return ($this->save());
			return (TRUE);
		}
		return (FALSE);
	}
}

$error = TRUE;

if (isset($_POST['login']) && isset($_POST['oldpw']) && isset($_POST['newpw'])
	&& $_POST['login'] != '' && $_POST['newpw'] != '')
{
	$db = new UsersDB;

	if ($db->get_user_data($_POST['login'], 'passwd') == $db::hash($_POST['oldpw']))
		$error = !$db->set_user_data($_POST['login'], 'passwd', $db::hash($_POST['newpw']));
}

if (!$error)
	echo("OK\n");
else
	echo("ERROR\n");

?>