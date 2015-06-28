<?php

class Dice
{
	const DICE_MAX = 6;

	public static function		doc()
	{
		return (file_get_contents('Dice.doc.txt'));
	}

	public static function		toss()
	{
 		$roll = rand(1, self::DICE_MAX);
 		return $roll;
	}

	public static function		multi_toss($numtoss = 0)
	{
		$arr = array();
		if (is_int($numtoss) && $numtoss > 0)
		{
			while ($numtoss > 0)
			{
				array_push($arr, rand(1, self::DICE_MAX));
				$numtoss--;
			}
		}
		return $arr;
	}

	public static function		min_toss($min = 0, $n = 0)
	{
		if (is_int($min) && is_int($n) && ($min <= self::DICE_MAX))
			while ($n > 0)
			{
				if (rand(1, self::DICE_MAX) > $min)
					return TRUE;
				$n--;
			}
		return FALSE;
	}
}

?>
