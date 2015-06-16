#!/usr/bin/php
<?php

if (isset($argv) && isset ($argv[1]))
{
	$tab = array_filter(explode(' ', $argv[1]));;

	array_unshift($tab, array_pop($tab));
	echo (implode($tab, ' '));
}
echo ("\n");

?>