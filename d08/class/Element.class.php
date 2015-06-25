<?php

require_once('class/Licorne.class.php');

class Element extends Licorne
{
	private						$_id; 
	private						$_type;
	private						$_width;
	private						$_height;

	public function				__construct(array $kwargs)
	{
		$this->_id = $kwargs['id'];
		$this->_type = $kwargs['type'];
		$this->_posX = $kwargs['posX'];
		$this->_posY = $kwargs['posY'];
		$this->_width = $kwargs['width'];
		$this->_height = $kwargs['height'];
	}

	public function				get_id()
	{
		return $this->_id;
	}

	public function				get_type()
	{
		return $this->_type;
	}

	public function				set_type($type)
	{
		$this->_type = $type;
	}

	public function				set_dimensions($width, $height)
	{
		$this->_width = $width;
		$this->_height = $height;
	}

	public function				get_map_id()
	{
		return $this->_map_id;
	}

	public function				getType()	{ return ($this->_type); }
	public function				getWidth()	{ return ($this->_width); }
	public function				getHeight()	{ return ($this->_height); }
}


?>