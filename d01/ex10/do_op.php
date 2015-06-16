#!/usr/bin/php
<?php

if (isset($argc) && isset($argv) && $argc == 4) {
	$nbr1 = (int)trim($argv[1]);
	$op = trim($argv[2]);
	$nbr2 = (int)trim($argv[3]);

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
}
else
	echo ("Incorrect Parameters");
echo ("\n");

?>