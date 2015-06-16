#!/usr/bin/php
<?php

function		is_alpha ($c) {
	if (($c >= 'a' && $c <= 'z') || ($c >= 'A' && $c <= 'Z'))
		return (TRUE);
	else
		return (FALSE);
}

function		is_num ($c) {
	if ($c >= '0' && $c <= '9')
		return (TRUE);
	else
		return (FALSE);
}

function		compare($ca, $cb) {
	if (is_alpha($ca))
	{
		if (is_alpha($cb))
			return (strcasecmp($ca, $cb));
		else
			return (-1);
	}
	if (is_alpha($cb))
	{
		if (is_alpha($ca))
			return (strcasecmp($ca, $cb));
		else
			return (1);
	}
	if (is_num($ca))
	{
		if (is_num($cb))
			return ($ca - $cb);
		else
			return (-1);
	}
	if (is_num($cb))
	{
		if (is_num($ca))
			return ($ca - $cb);
		else
			return (1);
	}
	return ($cb - $ca);
}

function		ft_sort($a, $b) {
	$lena = strlen($a);
	$lenb = strlen($a);
	$len = min($lena, $lenb);

	for ($i = 0; $i < $len; $i++) {
		if (($result = compare($a[$i], $b[$i])) != 0)
			return ($result);
		$i++;
	}
	return ($lena - $lenb);
}

if (isset($argv))
{
	array_shift($argv);
	$tab = array_filter(explode(' ', implode($argv, ' ')));
	usort($tab, ft_sort);

	foreach ($tab as $arg)
		echo ($arg."\n");
}
else
	echo ("\n");
?>