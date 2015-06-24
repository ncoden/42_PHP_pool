<?php

abstract class Lannister
{
	public function		sleepWith ( $pers )
	{
		if (is_a($pers, Lannister))
			echo ("Not even if I'm drunk !\n");
		else
			echo ("Let's do this.\n");
	}
}

?>