<?php

require_once('class/Element.class.php');

class Map
{
	/*All below values need to be stored inside the SQL Server. Please read documentation for this class for further info*/
	private 		$_map_id;
	private			$_map_width;
	private			$_map_height;		
	private			$_map_p1_zone_posX;
	private			$_map_p1_zone_posY;
	private			$_map_p2_zone_posX;
	private			$_map_p2_zone_posY;
	private			$_map_p_zone_width;
	private			$_map_p_zone_height;
	private			$_map_tile_width;
	private			$_map_tile_height;
	private			$_map_elements;
	private			$TILE_EMPTY;
	private			$TILE_ASTEROID;
	private			$TILE_P1;
	private			$TILE_P2;
	private			$_asteroid_probability;
	private			$_element_types;

	public static function		doc()
	{
		return (file_get_contents('Map.doc.txt'));
	}

	function					__construct()
	{
		$this->_map_width = 150; 
		$this->_map_height = 100; 
		$this->_map_p1_zone_posX = 0;
		$this->_map_p1_zone_posY = 0;
		$this->_map_p2_zone_posX = 119;
		$this->_map_p2_zone_posY = 69;
		$this->_map_p_zone_height = 30;
		$this->_map_p_zone_width = 30;
		$this->_map_tile_height = 10;
		$this->_map_tile_width = 10;
		$this->_element_types = Array('p1' => 0,'p2' => 1, 'empty' => 2, 'asteroid' => 3, 'occupied' => 4);
		//Change the following textures to your own as you wish.
		$this->TILE_EMPTY = "/resource/space-tile.jpg";
		$this->TILE_ASTEROID = "/resource/Spinning-asteroid-1.gif";
		$this->TILE_P1 = "/resource/player1.png";
		$this->TILE_P2 = "/resource/player2.png";
		$this->_asteroid_probability = 2;
	}

	function					__destruct()
	{

	}

	public function				GenerateMap($mapId)
	{
		$element_id = 0;
		$this->_map_elements = array();
		//echo ("test".$this->_map_width." ".$this->_map_height."\n");

		for ($i = 0; $i < $this->_map_width; $i++)
		{
			$map_elements_y = array();
			for ($j = 0; $j < $this->_map_height; $j++)
			{

				$element_type = $this->_element_types['empty'];
				//ensure that random element types are only generated OUTSIDE of player SPAWN ZONES
				$prob = rand(0, 1000);
				$w1 = 1;
				$w2 = 1;
				if ($prob < $this->_asteroid_probability)
				{
					$element_type = $this->_element_types['asteroid'];
					$w1 = rand(1,4); // change the probable sizes of asteroids here....
					$w2 = rand(1,4);
				}
				//Check if we are in player zone, in which case asteroids do not apply.
				if ($i >= $this->_map_p1_zone_posX && $i <= ($this->_map_p1_zone_posX + $this->_map_p_zone_width))
					if ($j >= $this->_map_p1_zone_posY && $j <= ($this->_map_p1_zone_posY + $this->_map_p_zone_height))
					{
						//P1
						$element_type = $this->_element_types['p1'];
						$w1 = 1;
						$w2 = 1;
					}	
				if ($i >= $this->_map_p2_zone_posX && $i <= ($this->_map_p2_zone_posX + $this->_map_p_zone_width))
					if ($j >= $this->_map_p2_zone_posY && $j <= ($this->_map_p2_zone_posY + $this->_map_p_zone_height))
					{
						//P2
						$element_type = $this->_element_types['p2'];
						$w1 = 1;
						$w2 = 1;
					}
				if ($element_type == $this->_element_types['asteroid'])
				{
					DataBase::insert('elements', array(
						'type' => $element_type,
						'x' => $i,
						'y' => $j,
						'width' => $this->_map_tile_width * $w1,
						'height' => $this->_map_tile_height * $w2,
						'mapId' => $mapId
					));

					$element_id++;
					//$map_elements_y[$j] = $current_element;
				}

			}
			//$this->_map_elements[$i] = $map_elements_y;
		}
		//$this->CheckOccupied();
	}

	private function			CheckOccupied()
	{
		$current_y = 0;
		while ($current_y < $this->_map_height)
		{
			for ($i = 0; $i < count($this->_map_elements); $i++)
			{
				if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['asteroid'])
				{
					$isotherzone = FALSE;
					//apply -1 to indicate do not render anything on asteroided space. This is an asteroid takes up more than 1 square.
					$num_width_units = $this->_map_elements[$i][$current_y]->getWidth() / $this->_map_tile_width;
					$num_height_units = $this->_map_elements[$i][$current_y]->getHeight() / $this->_map_tile_height;
					//Check for overlap with areas other than empty. If there is overlap, cancel the asteroid ENTIRELY.
					for ($x = $i; $x < $i + $num_width_units ; $x++)
						for ($y = $current_y; $y < $current_y + $num_height_units ; $y++)
						{
							if ($x == $i && $y == $current_y)
									continue;
							if ($this->_map_elements[$x][$y]->get_type() != $this->_element_types['empty'])
							{
								//reset the space back to empty.
								$isotherzone = TRUE;
								$this->_map_elements[$i][$current_y]->set_type($this->_element_types['empty']);
								$this->_map_elements[$i][$current_y]->set_dimensions($this->_map_tile_width,$this->_map_tile_height);
							}
						}
					//created occupied space for asteroid if we have complete empty space to work with
					if (!$isotherzone)
						for ($x = $i; $x < $i + $num_width_units ; $x++)
							for ($y = $current_y; $y < $current_y + $num_height_units ; $y++)
								if ($x == $i && $y == $current_y)
									;
								else
									$this->_map_elements[$x][$y]->set_type($this->_element_types['occupied']);
				}
			}
			$current_y = $current_y + 1;
		}
	}

	public function				RenderMap()
	{
		$current_y = 0;
		while ($current_y < $this->_map_height)
		{
			echo("<tr>");
			for ($i = 0; $i < count($this->_map_elements); $i++)
			{
				echo("<td>");
				echo ("<img style=\"width:10px; height:10px;\" src=\"");
				if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['p1'])
					echo ($this->TILE_P1);
				else if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['p2'])
					echo ($this->TILE_P2);
				else if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['empty'])
					echo ($this->TILE_EMPTY);
				else if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['asteroid'])
					echo ($this->TILE_ASTEROID);
				echo ("\"/>");
				echo "</a>";
				echo("</td>");
			}
			$current_y = $current_y + 1;
			echo("</tr>");
		}
	
		
	}

	public function				RenderMap2()
	{
		$current_y = 0;
		while ($current_y < $this->_map_height)
		{
			for ($i = 0; $i < count($this->_map_elements); $i++)
			{

				if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['occupied']) //occupied space for asteroids.
					continue;
				echo ("<div ");
				echo ("style=\"position: absolute; margin: 0;
				padding: 0;
				margin-top:0;
				padding-top: 0; 
				line-height:0;");
				echo ("left:");
					echo ($this->_map_tile_width * $i);
				echo ("px; ");
				echo ("top:");
					echo ($this->_map_tile_height * $current_y);
				echo ("px; ");
				echo ("width:");
					echo ($this->_map_elements[$i][$current_y]->get_width());
				echo ("px; ");
				echo ("height:");
					echo ($this->_map_elements[$i][$current_y]->get_height());
				echo ("px; ");
				echo ("background: red;");
				echo ("\"");
				echo (">");
				echo ("<img style=\"width:100%;height:100%; \"src=\"");
				if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['p1'])
					echo ("http://".$_SERVER['HTTP_HOST'].$this->TILE_P1);
				else if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['p2'])
					echo ("http://".$_SERVER['HTTP_HOST'].$this->TILE_P2);
				else if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['empty'])
					echo ("http://".$_SERVER['HTTP_HOST'].$this->TILE_EMPTY);
				else if ($this->_map_elements[$i][$current_y]->get_type() == $this->_element_types['asteroid'])
					echo ("http://".$_SERVER['HTTP_HOST'].$this->TILE_ASTEROID);
				echo ("\"/>");
				echo "</div>\n";
			}
			$current_y = $current_y + 1;
		}
	}

	// public static function		SaveMapInDatabase($theMap)
	// {

	// }
}

?>
