<?php

require_once('class/Licorne.class.php');

class Projectile extends Licorne
{
	private						$_model;
	private						$_count;
	private						$_dispersion_left;
	private						$_dispersion_right;

	public static function		doc()
	{
		return (file_get_contents('Projectile.doc.txt'));
	}

	public function				__construct(array $kwargs)
	{
		if (isset($kwargs['count'])
			&& isset($kwargs['dispersion_left'])
			&& isset($kwargs['dispersion_right'])
			&& isset($kwargs['posX'])
			&& isset($kwargs['posY'])
			&& isset($kwargs['orientation'])
			&& isset($kwargs['model']))
		{
			$this->_model = intval($kwargs['model']);
			$this->_count = intval($kwargs['count']);
			$this->_dispersion_left = intval($kwargs['dispersion_left']);
			$this->_dispersion_right = intval($kwargs['dispersion_right']);
			$this->setPos(intval($kwargs['posX']), intval($kwargs['posY']));
			$this->_orientation = intval($kwargs['orientation']);
			$this->_moving = 1;
		}
		else
			var_dump($kwargs);
	}

	public function				lanch()
	{
		$this->_moving = TRUE;
		echo ("X: ".$this->getPosX());
		echo ("Y: ".$this->getPosY());
		while ($this->getMoving())
		{
			$this->forward(1);
			echo ("X: ".$this->getPosX());
			echo ("Y: ".$this->getPosY());
		}
	}

	public function				getModel()			{ return ($this->_model); }
	public function				getCount()			{ return ($this->_count); }
	public function				getDispersionLeft()	{ return ($this->_dispersion_left); }
	public function				getDispersionRight(){ return ($this->_dispersion_right); }
	public function				getHull()			{ return (1); }
	public function				inflictDamages()	{ echo ("COLLISION"); }
}

?>
