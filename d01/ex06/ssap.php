#!/usr/bin/php
<?php

function		ft_split($str) {
	if (is_string($str)) {
		$tab = array_filter(explode(' ', $str));
		sort ($tab, SORT_STRING);
		return ($tab);
	}
	else
		return (FALSE);
}

if (isset($argv))
{
	array_shift($argv);
	$return = ft_split(implode($argv, ' '));

	foreach ($return as $arg)
		echo ($arg."\n");
}
else
	echo ("\n");


?>