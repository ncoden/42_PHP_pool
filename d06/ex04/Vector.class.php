<?php

require_once 'Vertex.class.php';

class	Vector
{
	private					$_x;
	private					$_y;
	private					$_z;
	private					$_w;
	public static			$verbose = FALSE;

	public static function	doc ()
	{
		readfile('Vector.doc.txt');
	}

	public function			__construct( array $kwargs )
	{
		if (isset($kwargs['dest'])
			&& is_a($kwargs['dest'], Vertex))
		{
			$dest = $kwargs['dest'];

			if (isset($kwargs['orig'])
				&& is_a($kwargs['orig'], Vertex))
				$orig = $kwargs['orig'];
			else
				$orig = new Vertex ([
					'x' => 0,
					'y' => 0,
					'z' => 0,
					'w' => 1.0
				]);

			$this->_x = $dest->getX() - $orig->getX();
			$this->_y = $dest->getY() - $orig->getY();
			$this->_z = $dest->getZ() - $orig->getZ();
			$this->_w = $dest->getW() - $orig->getW();

			if (self::$verbose == TRUE)
				echo ($this." constructed\n");
		}
		else
		{
			if (self::$verbose == TRUE)
				echo ("Vector construction failed\n".self::doc());
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
		return ('Vector( '.
			'x: '.number_format($this->_x, 2, '.', '').', '.
			'y: '.number_format($this->_y, 2, '.', '').', '.
			'z: '.number_format($this->_z, 2, '.', '').', '.
			'w: '.number_format($this->_w, 2, '.', '').' )');
	}

	public function			getX() { return ($this->_x); }
	public function			getY() { return ($this->_y); }
	public function			getZ() { return ($this->_z); }
	public function			getW() { return ($this->_w); }

	public function			magnitude()
	{
		return (sqrt(
			$this->_x * $this->_x + 
			$this->_y * $this->_y + 
			$this->_z * $this->_z
		));
	}

	public function			normalize()
	{
		$magnitude = abs($this->magnitude());

		return (new Vector([
			'dest' => new Vertex([
				'x' => $this->_x / $magnitude,
				'y' => $this->_y / $magnitude,
				'z' => $this->_z / $magnitude,
			])
		]));
	}

	public function			add( Vector $rhs )
	{
		return (new Vector([
			'dest' => new Vertex([
				'x' => $this->_x + $rhs->_x,
				'y' => $this->_y + $rhs->_y,
				'z' => $this->_z + $rhs->_z,
			])
		]));
	}

	public function			sub( Vector $rhs )
	{
		return (new Vector([
			'dest' => new Vertex([
				'x' => $this->_x - $rhs->_x,
				'y' => $this->_y - $rhs->_y,
				'z' => $this->_z - $rhs->_z,
			])
		]));
	}

	public function			opposite()
	{
		return (new Vector([
			'dest' => new Vertex([
				'x' => -$this->_x,
				'y' => -$this->_y,
				'z' => -$this->_z,
			])
		]));
	}

	public function			scalarProduct( $k )
	{
		return (new Vector([
			'dest' => new Vertex([
				'x' => $this->_x * $k,
				'y' => $this->_y * $k,
				'z' => $this->_z * $k,
			])
		]));
	}

	public function			dotProduct( Vector $rhs )
	{
		return (
			$this->_x * $rhs->_x +
			$this->_y * $rhs->_y +
			$this->_z * $rhs->_z
		);
	}

	public function			cos( Vector $rhs )
	{
		return ($this->dotProduct($rhs) / (abs($this->magnitude()) * abs($rhs->magnitude())));
	}

	public function			crossProduct( Vector $rhs )
	{
		return (new Vector([
			'dest' => new Vertex([
				'x' => ($this->_y * $rhs->_z) - ($this->_z * $rhs->_y),
				'y' => ($this->_z * $rhs->_x) - ($this->_x * $rhs->_z),
				'z' => ($this->_x * $rhs->_y) - ($this->_y * $rhs->_x),
			])
		]));
	}
}

?>