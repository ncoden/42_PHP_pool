<?php

class Jaime extends Lannister
{
	public function		sleepWith ( $pers )
	{
		if (is_a($pers, Cersei))
			echo ("With pleasure, but only in a tower in Winterfell, then.\n");
		else if (is_a($pers, Lannister))
			echo ("Not even if I'm drunk !\n");
		else
			echo ("Let's do this.\n");
	}
}

?>