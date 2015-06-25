<?php

require_once('class/DataBase.class.php');

class User
{
	private static				$_salt = '#Wrwf42324 a )d_#)()#(r ';

	private						$_id;
	private						$_login;
	private						$_password;
	private						$_gameWon;
	private						$_gameLost;

	public static function		doc()
	{
		return (file_get_contents('User.doc.txt'));
	}

	public static function		create(array $kwargs)
	{
		if (isset($kwargs['login'])
			&& isset($kwargs['password']))
		{
			$users = DataBase::req('SELECT login FROM users WHERE login = ?', array($kwargs['login']));

			if (empty($users))
			{
				$return = DataBase::insert('users', array(
					'login' => $kwargs['login'],
					'password' => md5(self::$_salt.$kwargs['password'])
				));
				return ($return);
			}
		}
		return (FALSE);
	}

	public static function		auth($login, $password)
	{
		$return = DataBase::req('SELECT * FROM users WHERE login = ? AND password = ?', array(
			$login,
			md5(self::$_salt.$password)
		));
		var_dump($return);
		if (isset($return[0]))
		{
			$_SESSION['userId'] = intval($return[0]['id']);
			$_SESSION['user'] = $return[0];
			return (new User(($return[0])));
		}
		return (FALSE);
	}

	public static function		getAuth()
	{
		if (isset($_SESSION['user']))
			return ($_SESSION['user']);
		else
			return (FALSE);
	}

	public static function		getAuthId()
	{
		if (isset($_SESSION['userId']))
			return ($_SESSION['userId']);
		else
			return (FALSE);
	}

	public static function		isAuth()
	{
		if (isset($_SESSION['user']))
			return (TRUE);
		else
			return (FALSE);
	}

	public function				__construct(array $kwargs)
	{
		if (isset($kwargs['id'])
			&& isset($kwargs['login'])
			&& isset($kwargs['password'])
			&& isset($kwargs['gameWon'])
			&& isset($kwargs['gameLost']))
		{
			$this->_id = intval($kwargs['id']);
			$this->_login = $kwargs['login'];
			$this->_password = $kwargs['password'];
			$this->_gameWon = intval($kwargs['gameWom']);
			$this->_gameLost = intval($kwargs['gameLost']);
		}
	}
}

?>