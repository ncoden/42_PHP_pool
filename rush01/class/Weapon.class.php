<?php

class Weapon
{
	private						$_id;
	private						$_model;
	private						$_charge;
	private						$_orientation;
	private						$_posX;
	private						$_posY;

	public static function		doc()
	{
		return (file_get_contents('./Weapon.doc.txt'));
	}

	public function		__construct(array $kwargs)
	{
		if (isset($kwargs['id'])
			&& isset($kwargs['posX'])
			&& isset($kwargs['posY'])
			&& isset($kwargs['charge'])
			&& isset($kwargs['orientation'])
			&& isset($kwargs['model']))
		{
			$this->_id = intval($kwargs['id']);
			$this->_model = intval($kwargs['model']);
			$this->_posY = intval($kwargs['posY']);
			$this->_posX = intval($kwargs['posX']);
			$this->_orientation = intval($kwargs['orientation']);
			$this->_charge = intval($kwargs['charge']);
		}
		return ;
	}

	public function		__destruct()
	{
		return ;
	}

	public function				setCharge($tocharge)
	{
		$this->_charge = $tocharge;
	}

	public function				getId()			{ return ($this->_id); }
	public function				getModel()		{ return ($this->_model); }
	public function				getCharge()		{ return ($this->_charge); }
	public function				getOrientation(){ return ($this->_orientation); }
	public function				getposX()		{ return ($this->_posX); }
	public function				getposY()		{ return ($this->_posY); }
}

?>
