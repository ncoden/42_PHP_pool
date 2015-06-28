<?php

require_once('class/Licorne.class.php');
require_once('class/Projectile.class.php');

class Ship extends Licorne
{
	const						STATE_OK = 1;
	const						STATE_KILLED = 2;

	private						$_id;
	private						$_state;
	private						$_round;
	private						$_model;
	private						$_player;
	private						$_pp;
	private						$_speed;
	private						$_hull;
	private						$_shield;
	private						$_weapons;

	public static function		doc()
	{
		return (file_get_contents('Ship.doc.txt'));
	}

	public function				__construct(array $kwargs)
	{
		if (isset($kwargs['id'])
			&& isset($kwargs['state'])
			&& isset($kwargs['round'])
			&& isset($kwargs['model'])
			&& isset($kwargs['player'])
			&& isset($kwargs['posX'])
			&& isset($kwargs['posY'])
			&& isset($kwargs['orientation'])
			&& isset($kwargs['moving'])
			&& isset($kwargs['pp'])
			&& isset($kwargs['speed'])
			&& isset($kwargs['hull'])
			&& isset($kwargs['shield'])
			&& isset($kwargs['weapons']))
		{
			$this->_id = intval($kwargs['id']);
			$this->_state = intval($kwargs['state']);
			$this->_round = intval($kwargs['round']);
			$this->_model = intval($kwargs['model']);
			$this->_player = intval($kwargs['player']);
			$this->setPos(intval($kwargs['posX']), intval($kwargs['posY']));
			$this->_orientation = intval($kwargs['orientation']);
			$this->_moving = intval($kwargs['moving']);
			$this->_pp = intval($kwargs['pp']);
			$this->_speed = intval($kwargs['speed']);
			$this->_hull = intval($kwargs['hull']);
			$this->_shield = intval($kwargs['shield']);
			$this->_weapons = $kwargs['weapons'];
		}
		else
			var_dump($kwargs);
	}

	public function				usePP(array $kwargs)
	{
		$sum = array_recursive_sum($kwargs);
		if ($this->_p > $sum)
		{
			// update pp
			$this->_pp -= $sum;
			DataBase::update('ships', $this->_id, array('pp' => $this->_pp));

			// increase speed
			if (isset($kwargs['speed']))
			{
				for ($i = 0; $i <  $kwargs['speed']; $i++)
					$this->_speed += Dice::toss();
				DataBase::update('ships', $this->_id, array('speed' => $this->_speed));
			}

			// increase shield
			if (isset($kwargs['shield']))
			{
				$this->_shield += $kwargs['shield'];
				DataBase::update('ships', $this->_id, array('shield' => $this->_speed));
			}

			// increase weapon
			if (isset($kwargs['weapons'])
				&& is_array($kwargs['weapons']))
			{
				foreach ($kwargs['weapons'] as $id => $weapon_point)
				{
					if (in_array($id, $this->_weapons))
					{
						$weapon = InstanceManager::getWeapon($id);
						$charge = $weapon->getCharge() + $weapon_point;
						$weapon->setCharge($charge);
						DataBase::update('weapons', $id, array('charge' => $charge));
					}
				}
			}

			// repair ship
			if (isset($kwargs['repair']) && !$this->moving)
			{
				while ($kwargs['repair'] > 0
					&& $this->_hull < $this->_model->_default_hull)
				{
					if (Dice::toss() == 6)
						$this->_hull++;
					$kwargs['repair']--;
				}
				DataBase::update('ships', $this->_id, array('hull' => $this->_hull));
			}
		}
	}

	public function				inflictDamages($damages)
	{
		// Inflict damages to shield
		$this->_shield -= $damages;
		if ($this->_shield < 0)
		{
			// if shield is destroyed, inflict others damages to hull
			$this->_hull += $this->_shield;
			$this->_shield = 0;
			if ($this->_hull <= 0)
			{
				// if hull is destroyed, kill the ship
				$this->_hull = 0;
				$this->kill();
			}
			DataBase::update('ships', $this->_id, array('hull' => $this->_hull));
		}
		DataBase::update('ships', $this->_id, array('shield' => $this->_shield));
	}

	public static function 		createShips($gameId, $playerId)
	{
		$ship0 = array (
			'idShipsModel' 	=> '1',
			'playerId' 		=> $playerId,
			'posX' 			=> '10',
			'posY' 			=> '10',
			'orientation' 	=> '0',
			'moving' 		=> '0',
			'pp' 			=> '0',
			'hull' 			=> '0',
			'shield' 		=> '0',
			'state' 		=> '1',
			'speed' 		=> '0',
			'bigTurn' 		=> '0'
			);
		$ship1 = array (
			'idShipsModel' 	=> '1',
			'playerId' 		=> $playerId,
			'posX' 			=> '20',
			'posY' 			=> '10',
			'orientation' 	=> '0',
			'moving' 		=> '0',
			'pp' 			=> '0',
			'hull' 			=> '0',
			'shield' 		=> '0',
			'state' 		=> '1',
			'speed' 		=> '0',
			'bigTurn' 		=> '0'
			);
		$ship2 = array (
			'idShipsModel' 	=> '1',
			'playerId' 		=> $playerId,
			'posX' 			=> '30',
			'posY' 			=> '10',
			'orientation' 	=> '0',
			'moving' 		=> '0',
			'pp' 			=> '0',
			'hull' 			=> '0',
			'shield' 		=> '0',
			'state' 		=> '1',
			'speed' 		=> '0',
			'bigTurn' 		=> '0'
			);
		$ship3 = array (
			'idShipsModel' 	=> '1',
			'playerId' 		=> $playerId,
			'posX' 			=> '10',
			'posY' 			=> '20',
			'orientation' 	=> '0',
			'moving' 		=> '0',
			'pp' 			=> '0',
			'hull' 			=> '0',
			'shield' 		=> '0',
			'state' 		=> '1',
			'speed' 		=> '0',
			'bigTurn' 		=> '0'
			);
		$ship4 = array (
			'idShipsModel' 	=> '1',
			'playerId' 		=> $playerId,
			'posX' 			=> '10',
			'posY' 			=> '30',
			'orientation' 	=> '0',
			'moving' 		=> '0',
			'pp' 			=> '0',
			'hull' 			=> '0',
			'shield' 		=> '0',
			'state' 		=> '1',
			'speed' 		=> '0',
			'bigTurn' 		=> '0'
			);
		$ship5 = array (
			'idShipsModel' 	=> '1',
			'playerId' 		=> $playerId,
			'posX' 			=> '30',
			'posY' 			=> '30',
			'orientation' 	=> '0',
			'moving' 		=> '0',
			'pp' 			=> '0',
			'hull' 			=> '0',
			'shield' 		=> '0',
			'state' 		=> '1',
			'speed' 		=> '0',
			'bigTurn' 		=> '0'
			);
		DataBase::insert('ships', $ship0);
		DataBase::insert('ships', $ship1);
		DataBase::insert('ships', $ship2);
		DataBase::insert('ships', $ship3);
		DataBase::insert('ships', $ship4);
		DataBase::insert('ships', $ship5);

		$allShips = InstanceManager::getAllShips($gameId);
		foreach ($allShips as $key => $ship)
		{
			if ($ship->getPlayer() == $playerId)
			{
				$shipModel = InstanceManager::getShipModel($ship->getModel());
				$weapons = $shipModel->getWeapons();
				foreach ($weapons as $weaponId)
				{
					$weaponModel = InstanceManager::getWeaponModel($weaponId);
					DataBase::insert('weapons', array(
						'idWeaponsModel' 	=> $weaponId,
						'charge' 			=> $weaponModel->getDefaultCharge(),
						'shipId' 			=> $ship->getId()
					));
				}				
			}
		}
	}

	public function				kill()
	{
		// get the game
		$player = InstanceManager::getPlayer($this->_player);
		$gameId = $player->getGame();
		$game = InstanceManager::getGame($gameId);

		// kill the ship
		DataBase::update('ships', $this->_id, array('state' => self::STATE_KILLED));
		$this->_state = self::STATE_KILLED;

		// send the event
		EventManager::trigger($gameId, 'ship_killed', $this->_id);
	}

	public function				fire($weaponId)
	{
		if (in_array($weaponId, $this->_weapons))
		{
			$weapon = InstanceManager::getWeapon($weaponId);
			$model = InstanceManager::getWeaponModel($weapon->getModel());

			// I know I should not call the same function in a loop,
			// but the PHP didn't think it could be usefull to have
			// read-only protected variables in a Class.
			// So let's code as shit and wait for a better language !
			//          (WOW, I am really saying that ? Such anger !)
			for ($i = 0; $i < $model->getWidth(); $i++)
			{
				$projectile = new Projectile(array(
					'count' => $weapon->getCharge(),
					'dispersion_left' => ($model->getDispersion() & ($i == 0)),
					'dispersion_right' => ($model->getDispersion() & ($i == ($model->getWidth() - 1))),
					'posX' => $this->absPosX($i),
					'posY' => $this->absPosY(1),
					'orientation' => $weapon->getOrientation(),
					'model' => $weapon->getModel()
				));
				$projectile->lanch();
			}
		}
	}

	public function				getId()		{ return ($this->_id); }
	public function				getPlayer()	{ return ($this->_player); }
	public function				getModel()	{ return ($this->_model); }
	public function				getHull()	{ return ($this->_hull); }
	public function				getShield()	{ return ($this->_shield); }
	public function				getRound()	{ return ($this->_round); }
	public function				getState()	{ return ($this->_state); }
	public function				getWeapons(){ return ($this->_weapons); }
}

?>
