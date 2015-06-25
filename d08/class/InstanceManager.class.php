<?php

require_once('Game.class.php');
require_once('Ship.class.php');
require_once('ShipModel.class.php');
require_once('Weapon.class.php');
require_once('WeaponModel.class.php');
require_once('Player.class.php');
require_once('Element.class.php');

abstract class InstanceManager
{
	private	static			$_instances = [
		'games'				=> [],
		'elements'			=> [],
		'ships'				=> [],
		'shipModels'		=> [],
		'weapons'			=> [],
		'weaponModels'		=> [],
		'players'           => []
	];

	public static function	getShip($id)
	{
		if (!isset(self::$_instances['ships'][$id]))
		{
			$ship = DataBase::select('ships', $id);
			$weapons = DataBase::req('SELECT * FROM weapons WHERE shipId = ?', array($id));

			$weaponsIds = array();
			foreach ($weapons as $weapon)
				array_push($weaponsIds, $weapon['id']);

			self::$_instances['ships'][$id] = new Ship(array(
				'id' => $id,
				'state' => $ship['state'],
				'round' => $ship['bigTurn'],
				'model' => $ship['idShipsModel'],
				'player' => $ship['playerID'],
				'posX' => $ship['posX'],
				'posY' => $ship['posY'],
				'orientation' => $ship['orientation'],
				'moving' => $ship['moving'],
				'pp' => $ship['pp'],
				'speed' => $ship['speed'],
				'hull' => $ship['hull'],
				'shield' => $ship['shield'],
				'weapons' => $weaponsIds
			));
		}
		return (self::$_instances['ships'][$id]);
	}

	public static function	getPlayers($id)
	{
		if (!isset(self::$_instances['players'][$id]))
		{
			$players = DataBase::select('players', $id);

			self::$_instances['players'][$id] = new Ship(array(
				'id' => $id,
				'userId' => $players['userId'],
				'gameId' => $players['gameId']
			));
		}
		return (self::$_instances['players'][$id]);
	}

	public static function	getShipModel($id)
	{
		if (!isset(self::$_instances['shipModels'][$id]))
		{
			$shipModel = DataBase::select('shipsmodel', $id);
			$weaponModels = DataBase::req('SELECT * FROM weaponsshipsrelations WHERE shipId = ?', array($id));

			$weaponsIds = array();
			foreach ($weaponModels as $weaponModel)
				array_push($weaponsIds, $weaponModel['id']);

			self::$_instances['shipModels'][$id] = new ShipModel(array(
				'id' => $shipModel['id'],
				'name' => $shipModel['name'],
				'width' => $shipModel['width'],
				'height' => $shipModel['height'],
				'sprite' => $shipModel['sprite'],
				'default_pp' => $shipModel['defaultPp'],
				'default_hull' => $shipModel['defaultHull'],
				'default_shield' => $shipModel['defaultShield'],
				'inerty' => $shipModel['inertia'],
				'speed' => $shipModel['speed'],
				'weapons' => $weaponsIds
			));
		}
		return (self::$_instances['shipModels'][$id]);
	}

	public static function	getWeapon($id)
	{
		if (!isset(self::$_instances['weapons'][$id]))
		{
			$weapon = DataBase::select('weapons', $id);
			self::$_instances['weapons'][$id] = new Weapon(array(
				'id' => $id,
				'model' => $weapon['idWeaponModel'],
				'charge' => $weapon['charge']
			));
		}
		return (self::$_instances['weapons'][$id]);
	}

	public static function	getWeaponModel($id)
	{
		if (!isset(self::$_instances['weapons'][$id]))
		{
			$weaponModel = DataBase::select('weaponsmodel', $id);
			self::$_instances['weaponModels'][$id] = new WeaponModel(array(
				'id' => $id,
				'name' => $weaponModel['name'],
				'short_range' => $weaponModel['shortRange'],
				'medium_range' => $weaponModel['mediumRange'],
				'long_range' => $weaponModel['longRange'],
				'default_charge' => $weaponModel['defaultCharge'],
				'dispersion' => $weaponModel['dispersion'],
				'width' => $weaponModel['width']
			));
		}
		return (self::$_instances['weaponModels'][$id]);
	}

	public static function getGame($id)
	{
		if (!isset(self::$_instances['games'][$id]))
		{
			$game = DataBase::select('games', $id);
			self::$_instances['games'][$id] = new Game(array(
				'id' => $id,
				'timestamp' => $game['timestamp'],
				'winnerId' => $game['winnerId'],
				'state' => $game['state'],
				'playerTurn' => $game['playerTurn'],
				'mapId' => $game['mapId'],
				'bigTurn' => $game['bigTurn'],
				'smallTurn' => $game['smallTurn']

			));
		}
		return (self::$_instances['games'][$id]);
	}

	public static function getAllShips($gameId)
	{
		self::$_instances['ships'] = array();
		$allShips = DataBase::req('SELECT * FROM `ships`
			INNER JOIN `players` ON `ships`.`playerID` = `players`.`id`
			WHERE `players`.`gameId` = ?', array($gameId));

		foreach ($allShips as $ship)
		{
			$shipId = intval($ship['id']);
			$weapons = DataBase::req('SELECT * FROM weapons WHERE shipId = ?', array($shipId));
			$weaponIds = array();
			foreach ($weapons as $weapon)
				array_push($weaponIds, intval($weapon['id']));

			self::$_instances['ships'][$shipId] = new Ship(array(
				'id' => $shipId,
				'state' => $ship['state'],
				'round' => $ship['bigTurn'],
				'model' => $ship['idShipsModel'],
				'player' => $ship['playerID'],
				'posX' => $ship['posX'],
				'posY' => $ship['posY'],
				'orientation' => $ship['orientation'],
				'moving' => $ship['moving'],
				'pp' => $ship['pp'],
				'speed' => $ship['speed'],
				'hull' => $ship['hull'],
				'shield' => $ship['shield'],
				'weapons' => $weaponIds
			));
		}
		return (self::$_instances['ships']);
	}

	public static function getAllPlayers($gameId)
	{
		self::$_instances['players'] = array();
		$allPlayers = DataBase::req('SELECT * FROM `players`
			INNER JOIN `games` ON `players`.`gameId` = `games`.`id`
			WHERE `players`.`gameId` = ?', array($gameId));

		foreach ($allPlayers as $player)
		{
			self::$_instances['players'][$player['id']] = new Player(array(
				'id' => $player['id'],
				'userId' => $player['userId'],
				'gameId' => $player['gameId'],
			));
		}
		return (self::$_instances['players']);
	}

	public static function getAllShipModels($gameId)
	{
		self::$_instances['shipModels'] = array();
		$allShipModel = DataBase::req('SELECT * FROM `shipsmodel`');

		foreach ($allShipModel as $shipModel)
		{
			$weaponModels = DataBase::req('SELECT id FROM weaponsshipsrelations WHERE shipId = ?', array($shipModel['id']));
	//	array_push($weaponsIds, $weaponModel['id']);

			$weaponModelIds = array();
			foreach($weaponModels as $weaponModel)
				array_push($weaponModelIds, $weaponModel['id']);

			self::$_instances['shipModels'][$shipModel['id']] = new ShipModel(array(
				'id' => $shipModel['id'],
				'name' => $shipModel['name'],
				'width' => $shipModel['width'],
				'height' => $shipModel['height'],
				'sprite' => $shipModel['sprite'],
				'default_pp' => $shipModel['defaultPp'],
				'default_hull' => $shipModel['defaultHull'],
				'default_shield' => $shipModel['defaultShield'],
				'inerty' => $shipModel['inertia'],
				'speed' => $shipModel['speed'],
				'weapons' => $weaponModelIds
			));
		}
		return (self::$_instances['shipModels']);
	}

	public static function getAllElements($gameId)
	{
		$game = DataBase::select('games', $gameId, array('mapId'));
		$AllElements = DataBase::req('SELECT * FROM `elements`
			WHERE `mapId` = ?', array($game['mapId']));

		foreach ($AllElements as $element)
		{
			self::$_instances['elements'][$element['id']] = new Element(array(
				'id' => $element['id'],
				'type' => $element['type'],
				'posX' => $element['x'],
				'posY' => $element['y'],
				'width' => $element['width'],
				'height' => $element['height'],
			));
		}
		return (self::$_instances['elements']);
	}

	public static function 	getAllWeapons($gameId)
	{
		self::$_instances['weapons'] = array();
		$ships = InstanceManager::getAllShips($gameId);

		foreach ($ships as $ship)
		{
			$weapons = DataBase::req('SELECT * FROM weapons WHERE shipId = ?', array($ship->getId()));
			foreach ($weapons as $weapon)
			{
				self::$_instances['weapons'][$weapon['id']] = new Weapon(array(
					'id' => $weapon['id'],
					'model' => $weapon['idWeaponModel'],
					'charge' => $weapon['charge']
				));
			}
		}
		return (self::$_instances['weapons']);
	}

	public static function 	getAllWeaponModels()
	{
		self::$_instances['weaponModels'] = array();
		$weaponModels = DataBase::req('SELECT * FROM `weaponsmodel`');

		foreach ($weaponModels as $weaponModel)
		{
			self::$_instances['weaponModels'][$weaponModel['id']] = new WeaponModel(array(
				'id' => $weaponModel['id'],
				'name' => $weaponModel['name'],
				'short_range' => $weaponModel['shortRange'],
				'medium_range' => $weaponModel['mediumRange'],
				'long_range' => $weaponModel['longRange'],
				'default_charge' => $weaponModel['defaultCharge'],
				'dispersion' => $weaponModel['dispersion'],
				'width' => $weaponModel['width']
			));
		}
		return (self::$_instances['weaponModels']);
	}
}

?>