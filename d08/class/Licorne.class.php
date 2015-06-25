<?php

require_once('class/Ship.class.php');
require_once('class/Element.class.php');
require_once('class/EventManager.class.php');

abstract class Licorne
{
	const						ROTATION_LEFT = 0;
	const						ROTATION_RIGHT = 0;

	private static				$_map;
	private						$_moving;
	private						$_orientation;
	private						$_posX;
	private						$_posY;

	public static function		doc()
	{
		return (file_get_contents('./Licorne.doc.txt'));
	}

	public function			checkCollision($xmin, $ymin, $xmax, $ymax, $obj)
	{
		if (is_a($obj, 'Ship'))
		{
			$model = InstanceManager::getShipModel($obj->getModel());
			$width = $model->getWidth();
			$height = $model->getHeight();
		}
		else if (is_a($obj, 'Element'))
		{
			$width = $obj->getWidth();
			$height = $obj->getHeight();
		}
		if ($xmin < 0 || $xmax > 150)
			return FALSE;
		if ($ymin < 0 || $ymax > 100)
			return FALSE;
		if (($xmax < $obj->_posX))
			return FALSE;
		if (($xmin > ($obj->_posX + $width)))
			return FALSE;
		if (($ymax < $obj->_posY))
			return FALSE;
		if (($ymin > ($obj->_posX + $height)))
			return FALSE;
		return TRUE;
	}

	public function				setPos($x, $y)
	{
		if (!isset(self::$_map))
			self::$_map = array('Ships' => array(), 'Elements' => array());

		if (isset($x) && isset($y))
		{
			$this->_posX = $x;
			$this->_posY = $y;
			if (is_a($this, 'Ship') === TRUE)
				self::$_map['Ships'][$this->getId()] = $this;
			if (is_a($this, 'Elements') === TRUE)
				self::$_map['Elements'][$this->getId()] = $this;
		}
	}

	public function				moveTo($x, $y)
	{
		$model = InstanceManager::getShipModel($this->getModel());
		$xmin = $this->_posX;
		$ymin = $this->_posY;
		$xmax = $this->_posX + $model->getWidth();
		$ymax = $this->_posY + $model->getHeight();
		if ($x == $this->_posX && $y == $this->_posY)
		{
			$this->_moving = FALSE;
			return ;
		}
		if ($x == $this->_posX)
		{
			$this->_moving = TRUE;
			$stop = 0;
			for ($yi = 0; $yi < $y; $yi++)
			{
				foreach(self::$_map['Ships'] as $key => $value)
				{
					if ($this->checkCollision($xmin, $ymin + $yi, $xmax, $ymax + $yi, $value) == TRUE)
					{
						$value->inflictDamages($value->getHull());
						$this->inflictDamages($this->getHull());
						$stop = 1;
						if ($ymin + $yi < 0)
							$this->_posY = 0;
						else if ($ymax + $yi > 100)
							$this->_posY = 100;
						else
							$this->_posY = $ymin + $yi - 1;
					}
				}

				foreach(self::$_map['Elements'] as $key => $value)
				{
					if ($this->checkCollision($xmin, $ymin + $yi, $xmax, $ymax + $yi, $value) == TRUE)
					{
						$this->inflictDamages($value->getHull());
						$stop = 1;
						if ($ymin + $yi < 0)
							$this->_posY = 0;
						else if ($ymax + $yi > 100)
							$this->_posY = 100;
						else
							$this->_posY = $ymin + $yi - 1;
					}
				}
				if ($stop == 1)
				{
					break;
				}
			}
			return ;
		}

		if ($y == $this->_posY)
		{
			$this->_moving = TRUE;
			$stop = 0;
			for ($xi = 0; $xi < $x; $xi++)
			{
				foreach(self::$_map['Ships'] as $key => $value)
				{
					if ($this->checkCollision($xmin + $xi, $ymin, $xmax + $xi, $ymax, $value) == TRUE)
					{
						$value->inflictDamages($this->getHull());
						$this->inflictDamages($value->getHull());
						$stop = 1;
						if ($xmin + $xi < 0)
							$this->_posX = 0;
						else if ($xmax + $xi > 100)
							$this->_posX = 100;
						else
							$this->_posX = $xmin + $xi - 1;
					}
				}

				foreach(self::$_map['Elements'] as $key => $value)
				{
					if ($this->checkCollision($xmin + $xi, $ymin, $xmax + $xi, $ymax, $value) == TRUE)
					{
						$this->inflictDamages($value->getHull());
						$stop = 1;
					}
					if ($xmin + $xi < 0)
						$this->_posX = 0;
					else if ($xmax + $xi > 100)
						$this->_posX = 100;
					else
						$this->_posX = $xmin + $xi - 1;
				}
				if ($stop == 1)
				{
					break;
				}
			}
			return ;
		}
	}

	public function 			stop()
	{
		$this->_moving = 0;
		DataBase::update('ships', $this->id, array('moving' => '0'));
	}

	public function 			rotate($rotation)
	{
		if ($rotation == self::ROTATION_LEFT)
			$this->_orientation -= 90;
		else if ($rotation == self::ROTATION_RIGHT)
			$this->_orientation += 90;
		if ($this->_orientation == 360);
			$this->_orientation = 0;
		DataBase::update('ships', $this->getId(), array('orientation' => $this->getOrientation()));
	}

	public function				forward($movement)
	{
		$this->moveTo(
			$this->_posX + $movement * cos($this->_orientation),
			$this->_posY + $movement * sin($this->_orientation)
		);
		DataBase::update('ships', $this->getId(), array(
			'posX' => $this->_posX,
			'posY' => $this->_posY
		));
	}

	public function				getPosX()			{ return ($this->_posX); }
	public function				getPosY()			{ return ($this->_posY); }
	public function				getOrientation()	{ return ($this->_orientation); }
	public function				getMoving()			{ return ($this->_moving); }
}

?>

