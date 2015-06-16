#!/usr/bin/php
<?php

if (isset($argv) && isset($argv[1])) {
	if (preg_match("/^ *(-?[0-9]+) *([\+\-\*\\\%]) *(-?[0-9]+) *$/", $argv[1], $match))
	{
		$nbr1 = (int)trim($match[1]);
		$op = trim($match[2]);
		$nbr2 = (int)trim($match[3]);

		if ($op == "+")
			echo ($nbr1 + $nbr2);
		else if  ($op == "-")
			echo ($nbr1 - $nbr2);
		else if  ($op == "*")
			echo ($nbr1 * $nbr2);
		else if  ($op == "/")
			echo ($nbr1 / $nbr2);
		else if  ($op == "%")
			echo ($nbr1 % $nbr2);
		else
			echo ("Syntax Error");
	}
	else
		echo ("Syntax Error");
}
else
	echo ("Incorrect Parameters");
echo ("\n");

?>