#!/usr/bin/php
<?php

function		parse_csv($file, $index = NULL) {

	if (file_exists($file)) {
		$lines = explode("\n", file_get_contents($file));
		$indexs = explode(';', $lines[0]);

		if ($index != NULL && ($index = array_search($index, $indexs)) == FALSE)
			return (NULL);

		if ($index != NULL)
			$return = array_fill_keys($indexs, []);
		else
		{
			$return = [];
			$indexs_count = count($indexs);
		}

		$count = count($lines);
		for ($i = 0; $i < $count; $i++) {
			$datas = explode(';', $lines[$i]);

			if ($index != NULL) {
				foreach ($indexs as $index_number => $index_name)
					$return[$index_name][$datas[$index]] = $datas[$index_number];
			}
			else if ($indexs_count == count($datas))
				$return[] = array_combine($indexs, $datas);
		}
		return ($return);
	}
	return (NULL);
}

if (isset($argv) && isset($argv[1]) && isset($argv[2]) && $argv[2] != NULL) {

	if (($datas = parse_csv($argv[1], $argv[2])) != NULL) {
		while (42) {
			echo ('Entrez votre commande: ');
			$handle = new SplFileObject('php://stdin');
			$command = $handle->current();

			if (strlen($command) == 0)
			{
				echo ("\n");
				exit (0);
			}

			$callback = function ($_command, $_datas) {
				extract($_datas);
				eval($_command);
			};
			$callback($command, $datas);
		}
	}
}

?>