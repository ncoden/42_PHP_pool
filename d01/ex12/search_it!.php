#!/usr/bin/php
<?php

if (isset($argv) && isset($argv[1])) {
	array_shift($argv);
	$search = array_shift($argv);

	foreach ($argv as $arg) {
		list($index, $value) = explode(':', $arg);

		if ($index == $search)
		{
			echo ($value);
			break;
		}
	}
}
echo ("\n");

?>