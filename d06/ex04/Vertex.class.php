<?php

require_once 'Color.class.php';

class	Vertex
{
	private					$_x;
	private					$_y;
	private					$_z;
	private					$_w;
	private					$_color;
	public static			$verbose = FALSE;

	public static function	doc ()
	{
		readfile('Vertex.doc.txt');
	}

	public function			__construct( array $kwargs )
	{
		if (array_key_exists('x', $kwargs)
			&& array_key_exists('y', $kwargs)
			&& array_key_exists('z', $kwargs))
		{
			$this->_x = (float)$kwargs['x'];
			$this->_y = (float)$kwargs['y'];
			$this->_z = (float)$kwargs['z'];

			if (array_key_exists('w', $kwargs))
				$this->_w = (float)$kwargs['w'];
			else
				$this->_w = 1.0;

			if (array_key_exists('color', $kwargs)
				&& is_a($kwargs['color'], Color))
				$this->_color = $kwargs['color'];
			else
				$this->_color = new Color(['rgb' => 0xFFFFFF]);

			if (self::$verbose == TRUE)
				echo ($this." constructed\n");
		}
		else
		{
			if (self::$verbose == TRUE)
				echo ("Vertex construction failed\n".self::doc());
			return (FALSE);
		}
	}

	public function			__destruct()
	{
		if (self::$verbose == TRUE)
			echo ($this." destructed\n");
	}

	public function			__toString()
	{
		$str = 'Vertex( '.
			'x: '.number_format($this->_x, 2, '.', '').', '.
			'y: '.number_format($this->_y, 2, '.', '').', '.
			'z: '.number_format($this->_z, 2, '.', '').', '.
			'w: '.number_format($this->_w, 2, '.', '');

		if (self::$verbose)
			$str .= ', '.$this->_color;

		$str .= ' )';
		return ($str);
	}

	public function			getX() { return ($this->_x); }
	public function			setX( $x ) { $this->_x = (float)$x; }

	public function			getY() { return ($this->_y); }
	public function			setY( $y ) { $this->_y = (float)$y; }

	public function			getZ() { return ($this->_z); }
	public function			setZ( $z ) { $this->_z = (float)$z; }

	public function			getW() { return ($this->_w); }
	public function			setW( $w ) { $this->_w = (float)$w; }

	public function			getColor() { return ($this->_color); }
	public function			setColor( Color $color ) { $this->_color = $color; }
}

?>