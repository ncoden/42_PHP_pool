<?php

class Color
{
	static public	$verbose = FALSE;

	public			$red = 0;
	public			$green = 0;
	public			$blue = 0;

	static function	doc ()
	{
		readfile('Color.doc.txt');
	}

	function		__construct( array $kwargs = [] )
	{
		if (array_key_exists('rgb', $kwargs))
		{
			$rgb = (int)$kwargs['rgb'];
			$this->red = self::limit_color($rgb >> 16);
			$this->green = self::limit_color(($rgb >> 8) % 256);
			$this->blue = self::limit_color($rgb % 256);
		}
		if (array_key_exists('red', $kwargs))
			$this->red = self::limit_color((int)$kwargs['red']);
		if (array_key_exists('green', $kwargs))
			$this->green = self::limit_color((int)$kwargs['green']);
		if (array_key_exists('blue', $kwargs))
			$this->blue = self::limit_color((int)$kwargs['blue']);
		if (self::$verbose == TRUE)
			echo ($this.' constructed.'. "\n");
	}

	function		__destruct ()
	{
		if (self::$verbose == TRUE)
			echo ($this.' destructed.' . "\n");
	}

	function		__toString()
	{
		$sp_nb = 4 - strlen($this->red);
		$sp = '';
		$str = '';
		while ($sp_nb > 0)
		{
			$sp .= ' ';
			$sp_nb--;
		}
		$str .= "Color( red:" . $sp . $this->red . ", green:";
		$sp_nb = 4 - strlen($this->green);
		$sp = '';
		while ($sp_nb > 0)
		{
			$sp .= ' ';
			$sp_nb--;
		}
		$str .= $sp . $this->green . ", blue:";
		$sp_nb = 4 - strlen($this->blue);
		$sp = '';
		while ($sp_nb > 0)
		{
			$sp .= ' ';
			$sp_nb--;
		}
		$str .= $sp . $this->blue . ' )';
		return ($str);
	}

	function		add( Color $color )
	{
		return (new Color([
			'red' => self::limit_color($this->red + $color->red),
			'green' => self::limit_color($this->green + $color->green),
			'blue' => self::limit_color($this->blue + $color->blue)
		]));
	}

	function		sub( Color $color )
	{
		return (new Color([
			'red' => self::limit_color($this->red - $color->red),
			'green' => self::limit_color($this->green - $color->green),
			'blue' => self::limit_color($this->blue - $color->blue)
		]));
	}

	function		mult( $f )
	{
		return (new Color([
			'red' => self::limit_color($this->red * $f),
			'green' => self::limit_color($this->green * $f),
			'blue' => self::limit_color($this->blue * $f)
		]));
	}

	static private function limit_color( $color )
	{
		if ($color > 255)
			return (255);
		else if ($color < 0)
			return (0);
		return ($color);
	}
}

?>