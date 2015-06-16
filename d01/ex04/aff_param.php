#!/usr/bin/php
<?php

if (isset($argv))
{
	array_shift($argv);

	foreach ($argv as $arg) {
		echo ($arg."\n");
	}
}
else
	echo ("\n");

?>