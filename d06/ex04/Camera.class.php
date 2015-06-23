<?php

require_once 'Camera.class.php';

class	Camera
{
	private					$_origin;
	private					$_orientation;

	private					$_semwidth;
	private					$_semheight;
	private					$_tr;
	private					$_proj;
	public static			$verbose = FALSE;

	public static function	doc ()
	{
		readfile('Camera.doc.txt');
	}

	public function			__construct( array $kwargs )
	{
		if (isset($kwargs['origin'])
			&& is_a($kwargs['origin'], Vertex)
			&& isset($kwargs['orientation'])
			&& is_a($kwargs['orientation'], Matrix)
			&& isset($kwargs['fov'])
			&& isset($kwargs['near'])
			&& isset($kwargs['far'])
			&& (isset($kwargs['ratio'])
			XOR !(isset($kwargs['width'])
				XOR isset($kwargs['height'])))
			&& (isset($kwargs['width'])
				|| isset($kwargs['height'])))
		{
			$this->_origin = $kwargs['origin'];
			$this->_orientation = $kwargs['orientation'];

			if (isset($kwargs['ratio']))
			{
				$ratio = (float)$kwargs['ratio'];
				if (isset($kwargs['width']))
				{
					$this->_semwidth = (float)$kwargs['width'] / 2;
					$this->_semheight = $this->_semwidth * $ratio;
				}
				else
				{
					$this->_semheight = (float)$kwargs['height'] / 2;
					$this->_semwidth = ($this->_semheight / $ratio);
				}
			}
			else
			{
				$this->_semwidth = (float)$kwargs['width'] / 2;
				$this->_semheight = (float)$kwargs['height'] / 2;
				$ratio = $this->_semwidth / $this->_semheight;
			}

			$tt = new Matrix ([
				'preset' => Matrix::TRANSLATION,
				'vtc' => (new Vector(['dest' => $this->_origin]))->opposite()
			]);
			$tr = $this->_orientation->opposite();
			$this->_tr = $tr->mult($tt);

			$this->_proj = new Matrix([
				'preset' => Matrix::PROJECTION,
				'ratio' => $ratio,
				'fov' => $kwargs['fov'],
				'near' => $kwargs['near'],
				'far' => $kwargs['far']
			]);

			if (self::$verbose == TRUE)
				echo ("Camera instance constructed\n");
		}
	}

	public function			__destruct()
	{
		if (self::$verbose == TRUE)
			echo ("Camera instance destructed\n");
	}

	public function			__toString()
	{
		$tt = new Matrix ([
			'preset' => Matrix::TRANSLATION,
			'vtc' => (new Vector(['dest' => $this->_origin]))->opposite()
		]);
		$tr = $this->_orientation->opposite();

		return (
			"Camera( \n".
			'+ Origine: '.$this->_origin."\n".
			"+ tT:\n".$tt."\n".
			"+ tR:\n".$tr."\n".
			"+ tR->mult( tT ):\n".$this->_tr."\n".
			"+ Proj:\n".$this->_proj."\n".
			")\n"
		);
	}

	public function			watchVertex( Vertex $worldVertex )
	{
		$vtx = $this->_proj->transformVertex($this->_tr->transformVertex($worldVertex));
		$vtx->setX($this->_semwidth + $vtx->getX());
		$vtx->setY($this->_semheight + $vtx->getY());
		return ($vtx);
	}
}

?>