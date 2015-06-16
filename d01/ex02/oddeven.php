#!/usr/bin/php
<?php

while (42) {
	echo ("Entrez un nombre: ");
	$handle = new SplFileObject('php://stdin');
	$number= $handle->current();

	if (strlen($number) == 0)
	{
		echo ("\n");
		exit (0);
	}
	else
		$number = rtrim($number, "\n");

	if (is_numeric($number)) {
		$number = (int)$number;

		echo ("Le chiffre ".$number." est ");
		if (($number % 2) == 0)
			echo ("Pair");
		else
			echo ("Impair");
	}
	else
		echo ("'".$number."' n'est pas un chiffre");
	echo ("\n");
}

?>