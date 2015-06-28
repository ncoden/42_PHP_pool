#!/usr/bin/php
<?php

function is_alol($content, $i)
{
	if ($content[$i] == '<' && $content[$i + 1] == 'a' && $content[$i + 2] == ' ')
	{
		return (1);
	}
	else
		return (0);
}

function is_endalol($content, $i)
{
	if ($content[$i] == '>' && $content[$i - 1] == 'a' && $content[$i - 2] == '/')
	{
		return (1);
	}
	else
		return (0);
}

function is_title($content, $i)
{
	if ($content[$i] == '"' && 
		$content[$i - 1] == '=' && 
		$content[$i - 2] == 'e' && 
		$content[$i - 3] == 'l' && 
		$content[$i - 4] == 't' && 
		$content[$i - 5] == 'i' && 
		$content[$i - 6] == 't')
	{
		return (1);
	}
	else
		return (0);
}

if (isset($argv[1]))
{
	$content = file_get_contents($argv[1]);
	$i = 0;
	$da = 0;
	while ($content[$i])
	{
		if (is_alol($content, $i))
			$da = 1;
		if ($da == 1 && is_title($content, $i))
		{
			$i++;
			while ($content[$i] != '"')
			{
				$content[$i] = strtoupper($content[$i]);
				$i++;
			}
		}
		if ($da == 1 && $content[$i] == '>')
		{
			$i++;
			while ($content[$i] != '<' && $content[$i] != '')
			{
				$content[$i] = strtoupper($content[$i]);
				$i++;
			}
		}
		if ($da == 1 && is_endalol($content, $i))
			$da == 0;
		$i++;
	}
	echo $content;
}
?>