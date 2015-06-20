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

	function		get_user_data($login, $index) {
		foreach ($this->users as $user)
		{
			if (isset($user['login']) && $user['login'] == $login 
				&& isset($user[$index]))
				return ($user[$index]);
		}
		return (FALSE);
	}
}

function auth($login, $passwd)
{
	static $db = NULL;

	if ($db == NULL)
		$db = new UsersDB;

	if ($db)
	{
		if ($db->get_user_data($login, 'passwd') == $db::hash($passwd))
			return (TRUE);
	}
	return (FALSE);
}

?>