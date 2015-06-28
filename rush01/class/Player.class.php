<?php

class Player
{
	private						$_id;
	private						$_game;
	private						$_team;
	private						$_user;

	public static function		doc()
	{
		return (file_get_contents('Player.doc.txt'));
	}

	public function				__construct(array $kwargs)
	{
		if (isset($kwargs['id'])
			&& isset($kwargs['game'])
			&& isset($kwargs['team'])
			&& isset($kwargs['user']))
		{
			$this->_id = $kwargs['id'];
			$this->_game = $kwargs['game'];
			$this->_team = $kwargs['team'];
			$this->_user = $kwargs['user'];
		}
	}

	public function				getId()		{ return ($this->_id); }
	public function				getTeam()	{ return ($this->_team); }
	public function				getGame()	{ return ($this->_game); }
}

?>
