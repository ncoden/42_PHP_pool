#!/usr/bin/php
<?php

if (isset($argv) && isset($argv[1])) {

	date_default_timezone_set('Europe/Paris');
	$date_found = 0;

	$days = [
		'lundi',
		'mardi',
		'mercredi',
		'jeudi',
		'vendredi',
		'samedi',
		'dimamche'
	];

	$months = [
		'janvier',
		'février',
		'mars',
		'avril',
		'mai',
		'juin',
		'juillet',
		'aout',
		'septembre',
		'octobre',
		'novembre',
		'décembre'
	];

	if (preg_match('/^([A-Z]?[a-z]+) ([0-9]{1,2}) ([A-Z]?[a-z]+) ([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/', $argv[1], $date)) {
		if (($day = array_search(lcfirst($date[1]), $days)) >= 0 
			&& ($month = array_search(lcfirst($date[3]), $months)) >= 0 
			&& ($year = (int)$date[4]) >= 1970)
		{
			if ($timestamp = mktime((int)$date[5], (int)$date[6], (int)$date[7], $month + 1, (int)$date[2], $year))
			{
				$date_found = 1;
				echo ($timestamp);
			}
		}
	}

	if (!$date_found)
		echo ('Wrong Format');
}

echo ("\n");

?>