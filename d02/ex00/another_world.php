#!/usr/bin/php
<?php

if (isset($argv) && isset($argv[1])) {
	$argv[1] = trim(preg_replace('/[ \t]+/', ' ', $argv[1]));
	echo ($argv[1]);
}

echo ("\n");

?>