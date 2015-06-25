<?php

class WeaponModel
{
	private						$_id;
	private						$_name;
	private						$_short_range;
	private						$_medium_range;
	private						$_long_range;
	private						$_dispersion;
	private						$_width;
	private						$_default_charge;

	public static function		doc()
	{
		return (file_get_contents('./WeaponModel.doc.txt'));
	}

	public function		__construct(array $kwargs)
	{
		if (isset($kwargs['id']) 
			&& isset($kwargs['name']) 
			&& isset($kwargs['short_range']) 
			&& isset($kwargs['medium_range']) 
			&& isset($kwargs['long_range']) 
			&& isset($kwargs['default_charge']) 
			&& isset($kwargs['dispersion']) 
			&& isset($kwargs['width'])) 
		{
			$this->_id = intval($kwargs['id']);
			$this->_name = $kwargs['name'];
			$this->_short_range = intval($kwargs['short_range']);
			$this->_medium_range = intval($kwargs['medium_range']);
			$this->_long_range = intval($kwargs['long_range']);
			$this->_dispersion = intval($kwargs['dispersion']);
			$this->_default_charge = intval($kwargs['default_charge']);
			$this->_width = intval($kwargs['width']);
		}
		return ;
	}

	public function		getId()				{ return ($this->_id); }
	public function		getName()			{ return ($this->_name); }
	public function		getShortRange()		{ return ($this->_short_range); }
	public function		getMediumRange()	{ return ($this->_medium_range); }
	public function		getLongRange()		{ return ($this->_long_range); }
	public function		getDispersion()		{ return ($this->_dispersion); }
	public function		getWidth()			{ return ($this->_width); }
	public function		getDefaultCharge()	{ return ($this->_default_charge); }
}

?>
