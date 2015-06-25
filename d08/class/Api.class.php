<?php

require_once('class/Game.class.php');
require_once('class/InstanceManager.class.php');
require_once('class/User.class.php');

class Api
{
	private					$_return;

	public function			__construct()
	{
		$this->_return = array();
	}

	private function		MakeRefArray($gameId, array $array)
	{
		$refs = array();

		foreach ($array as $category => $instances)
		{
			if (!isset($refs[$category]))
				$refs[$category] = array();
			foreach ($instances as $instance)
			{
				if ($category == 'players')
					$this->addPlayerToReturn($instance);
				else if ($category == 'elements')
					$this->addElementToReturn($instance);
				else if ($category == 'ships')
					$this->addShipToReturn($gameId, $instance);
				else if ($category == 'shipModels')
					$this->addShipModelToReturn($instance);
				else if ($category == 'weapon')
					$this->addWeaponToReturn($instance);
				else if ($category == 'weaponModels')
					$this->addWeaponModelToReturn($instance);
				array_push($refs[$category], $instance->getId());
			}
		}
		return ($refs);
	}

	private function		addToReturn($category, $data)
	{
		if (!isset($this->_return[$category]))
			$this->_return[$category] = array();
		array_push($this->_return[$category], $data);
	}

	private function		addPlayerToReturn($player)
	{
		$this->addToReturn('players', array(
			'id' => $player->getId(),
			'team' => $player->getTeam(),
		));
	}

	private function		addElementToReturn($element)
	{
		$this->addToReturn('elements', array(
			'type' => $element->getType(),
			'posX' => $element->getPosX(),
			'posY' => $element->getPosY(),
			'width' => $element->getWidth(),
			'height' => $element->getHeight(),
		));
	}

	private function		addShipToReturn($gameId, $ship)
	{
		$game = InstanceManager::getGame($gameId);
		$this->addToReturn('ships', array(
			'id' => $ship->getId(),
			'player' => $ship->getPlayer(),
			'model' => $ship->getModel(),
			'posX' => $ship->getPosX(),
			'posY' => $ship->getPosY(),
			'orientation' => $ship->getOrientation(),
			'moving' => $ship->getMoving(),
			'hull' => $ship->getHull(),
			'shield' => $ship->getShield(),
			'active' => ($ship->getRound() == $game->getBigTurn()),
			'state' => $ship->getState(),
			'weapons' => $ship->getWeapons(),
		));
	}

	private function		addShipModelToReturn($shipModel)
	{
		$this->addToReturn('shipModels', array(
			'id' => $shipModel->getId(),
			'name' => $shipModel->getName(),
			'width' => $shipModel->getWidth(),
			'height' => $shipModel->getHeight(),
			'sprite' => $shipModel->getSprite(),
			'defaultPP' => $shipModel->getDefaultPp(),
			'defaultHull' => $shipModel->getDefaultHull(),
			'defaultShield' => $shipModel->getDefaultShield(),
			'inerty' => $shipModel->getInerty(),
			'speed' => $shipModel->getSpeed(),
		));
	}

	private function		addWeaponToReturn($weapon)
	{
		$this->addToReturn('weapons', array(
			'id' => $weapon->getId(),
			'model' => $weapon->getModel(),
			'charge' => $weapon->getCharge(),
			'orientation' => $weapon->getOrientation(),
			'posX' => $weapon->getposX(),
			'posY' => $weapon->getposY()
		));
	}

	private function		addWeaponModelToReturn($weaponModel)
	{
		$this->addToReturn('weaponModels', array(
			'id' => $weaponModel->getId(),
			'name' => $weaponModel->getName(),
			'shortRange' => $weaponModel->getShortRange(),
			'mediumRange' => $weaponModel->getMediumRange(),
			'longRange' => $weaponModel->getLongRange(),
			'dispersion' => $weaponModel->getDispersion(),
			'width' => $weaponModel->getWidth()
		));
	}

	public function			request($request, array $datas)
	{
		$methods = [
			'game/create' => 'gameCreate',
			'game/join' => 'gameJoin',
			'game/load' => 'gameLoad',
			'game/refresh' => 'gameRefresh',
			'ship/move' => 'shipMove',
			'ship/fire' => 'shipFire',
		];

		if (isset($methods[$request]))
			return(call_user_func(array($this, $methods[$request]), $datas));
		return (FALSE);
	}

	public function 		gameCreate(array $datas)
	{
		if (isset($datas['name']))
		{
			$gameId = Game::create($datas['name']);
			$this->gameJoin(array('gameId' => $gameId));
			return ($gameId);
		}
		return (FALSE);
	}

	public function 		gameJoin(array $datas)
	{
		if (!isset($datas['gameId']))
			return (FALSE);
		$gameId = $datas['gameId'];

		$auth = User::getAuthId();
		if ($auth)
		{
			Database::insert('players', array(
				'userId' => $auth,
				'gameId' => $gameId
				));
			$playerId = Database::getLastEntry('players');
			Ship::createShips($gameId, $playerId);
		}
		else
			return (FALSE);
	}

	public function			gameLoad(array $datas)
	{
		if (!isset($datas['gameId']))
			return (FALSE);
		$gameId = $datas['gameId'];

		$return = array();

		$game				= InstanceManager::getGame($gameId);
		$players			= InstanceManager::getAllPlayers($gameId);
		$elements			= InstanceManager::getAllElements($gameId);
		$ships				= InstanceManager::getAllShips($gameId);
		$shipModels			= InstanceManager::getAllShipModels($gameId);
		$weapons			= InstanceManager::getAllWeapons($gameId);
		$weaponModels		= InstanceManager::getAllWeaponModels($gameId);

		$this->_return['game'] = array(
			'state' => $game->getState(),
			'bigTurn' => $game->getBigTurn(),
			'smallTurn' => $game->getSmallTurn(),
			'winnerId' => $game->getWinnerId(),
		);

		foreach ($players as $player)
			$this->addPlayerToReturn($player);
		foreach ($elements as $element)
			$this->addElementToReturn($element);
		foreach ($ships as $ship)
			$this->addShipToReturn($game, $ship);
		foreach ($shipModels as $shipModel)
			$this->addShipModelToReturn($shipModel);
		foreach ($weapons as $weapon)
			$this->addWeaponToReturn($weapon);
		foreach ($weaponModels as $weaponModel)
			$this->addWeaponModelToReturn($weaponModel);
	}

	public function			gameRefresh(array $datas)
	{
		if (!isset($datas['gameId']))
			return (FALSE);
		$gameId = $datas['gameId'];

		$events = EventManager::check($gameId);
		if ($events)
		{
			foreach ($events as $event)
			{
				if ($event['name'] == 'game_start')
				{
					$players			= InstanceManager::getAllPlayers($gameId);
					$ships				= InstanceManager::getAllShips($gameId);
					$weapons			= InstanceManager::getAllWeapons($gameId);

					$datas = $this->makeRefArray($gameId, array(
						'players' => $players,
						'ships' => $ships,
						'weapons' => $weapons
					));
				}
				else if ($event['name'] == 'game_end')
				{
					$game = InstanceManager::getGame($gameId);
					$datas = array(
						'winnerId' => $game->getWinnerId(),
					);
				}
				else if ($event['name'] == 'ship_moved')
				{
					$ship = InstanceManager::getShip($event['data']);
					$datas = array(
						'shipId' => $ship->getId(),
						'posX' => $ship->getPosX(),
						'posY' => $ship->getPosY(),
						'orientation' => $ship->getOrientation(),
						'moving' => $ship->getMoving(),
					);
				}
				else if ($event['name'] == 'ship_damaged')
				{
					$ship = InstanceManager::getShip($event['data']);
					$datas = array(
						'shipId' => $ship->getId(),
						'hull' => $ship->getHull(),
					);
				}

				$this->addToReturn('events', array(
					'name' => $event['name'],
					'datas' => $datas
				));
			}
		}
	}

	public function			shipMove(array $datas)
	{
		if (isset($datas['gameId'])
			&& isset($datas['shipId']))
		{
			$gameId = $datas['gameId'];
			$shipId = $datas['shipId'];
			InstanceManager::getAllShips($gameId);
			InstanceManager::getAllElements($gameId);
			$ship = InstanceManager::getShip($shipId);
			$model = InstanceManager::getShipModel($ship->getModel());
			$movement = 0;

			//$ship->active();

			if ($ship->getMoving())
				$movement = $model->getInerty();
			if (isset($datas['movement']) && $datas['movement'] > $movement)
				$movement = $datas['movement'];

			if (isset($datas['rotation']))
			{
				if ($datas['rotation'] == 'gauche')
					$ship->rotate(Ship::ROTATION_LEFT);
				else if ($datas['rotation'] == 'droite')
					$ship->rotate(Ship::ROTATION_RIGHT);
			}
			if ($movement > 0 && $ship->forward($movement))
			{
				if ($datas['movement'] == $model->getInerty())
					$ship->stop();
			}

			EventManager::trigger($gameId, 'ship_moved', $shipId);

			$this->gameRefresh(array(
				'gameId' => $gameId,
			));
		}
	}

	public function			getReturn()
	{
		return ($this->_return);
	}
}

?>