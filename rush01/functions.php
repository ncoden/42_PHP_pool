<?php

function		redirect($path)
{
	header('Location: '.$path);
	exit(0);
}

function		simplematch($pattern, $string, &$result) {
	return (preg_match("#^".strtr(preg_quote($pattern, '#'), array('\*' => '(.*)', '\?' => '.'))."$#i", $string, $result));
}

function		path_to_page($path, &$match)
{
	global		$g_pages;

	foreach ($g_pages as $name => $page)
	{
		if (simplematch($page[0], $path, $result))
		{
			array_shift($result);
			$match = $result;
			return ($name);
		}
	}
	return (FALSE);
}

function		array_recursive_sum(array $array)
{
	$sum = 0;
	foreach ($array as $value)
	{
		if (is_array($$value))
			$sum += array_recursive_sum($value);
		else
			$sum += floatval($value);
	}
	return ($sum);
}

?>