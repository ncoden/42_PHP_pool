#!/usr/bin/php
<?php

function			echo_min($str) {
	echo ($str);
	$len = strlen($str);
	while ($len % 8 != 0)
	{
		echo (' ');
		$len++;
	}
}

function			sort_by_console($tab1, $tab2) {
	return (strcmp($tab1['line'], $tab2['line']));
}

date_default_timezone_set('Europe/Paris');

if ($f = fopen("/var/run/utmpx", "r")) {
	$users = [];

	while ($line = fread($f, 628)) {
		$tab = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad", $line);
		if ($tab['type'] == 7)
			$users[] = $tab;
	}

	usort($users, "sort_by_console");

	foreach ($users as $tab) {
		if ($tab['type'] == 7)
		{
			echo_min(trim($tab['user']));
			echo (' ');
			echo_min(trim($tab['line']));
			echo (' ');
			echo (date('M', $tab['time1']));
			echo (' ');
			if (strlen($day = date('j', $tab['time1'])) == 1)
				echo (' ');
			echo ($day);
			echo (' ');
			echo (date("H:i\n", $tab['time1']));
		}
	}
}

?>