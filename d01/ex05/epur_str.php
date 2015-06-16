#!/usr/bin/php
<?php

function		epur_str($str) {
	return (trim(preg_replace('/\s\s+/', ' ', $str)));
}

if (isset($argv) && isset($argv[1]))
	echo (epur_str($argv[1]));
echo ("\n");

?>