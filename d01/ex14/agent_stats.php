#!/usr/bin/php
<?php

if (isset($argv) && isset($argv[1]))
{
	$mode = array_search($argv[1], [
		"moyenne",
		"moyenne_user",
		"ecart_moulinette"
	]);

	if ($mode >= 0)
	{
		$line = rtrim(fgets(STDIN), "\n");
		$indexs = array_flip(explode(';', $line));

		if (isset($indexs["User"])
			&& isset($indexs["Note"])
			&& isset($indexs["Noteur"])
			&& isset($indexs["Feedback"])) {

			if ($mode == 0) {
				$somme = 0;
				$count = 0;

				while ($line = rtrim(fgets(STDIN), "\n"))
				{
					$results = explode(';', $line);
					if (isset($results[$indexs["Note"]])
						&& is_numeric($note = $results[$indexs["Note"]])
						&& (!isset($results[$indexs["Noteur"]])
							|| (isset($results[$indexs["Noteur"]]) 
							&& $results[$indexs["Noteur"]] != "moulinette")))
					{
						$somme += (int)$note;
						$count++;
					}
				}

				echo ($somme / $count);
			}

			if ($mode == 1 || $mode == 2) {
				$moyennes = [];
				$moulinette = [];

				while ($line = fgets(STDIN))
				{
					$results = explode(';', $line);

					if (isset($results[$indexs["Note"]])
						&& is_numeric($note = $results[$indexs["Note"]])
						&& isset($results[$indexs["User"]]))
					{
						$user = $results[$indexs["User"]];

						if (!isset($results[$indexs["Noteur"]])
							|| (isset($results[$indexs["Noteur"]]) 
							&& $results[$indexs["Noteur"]] != "moulinette")) {

							if (!isset($moyennes[$user]))
								$moyennes[$user] = [0, 0];
							$moyennes[$user][0] ++;
							$moyennes[$user][1] += $note;
						}
						else if ($mode == 2 
							&& isset($results[$indexs["Noteur"]])
							&& $results[$indexs["Noteur"]] == "moulinette") {
							if (!isset($moulinette[$user]))
								$moulinette[$user] = [0, 0];
							$moulinette[$user][0] ++;
							$moulinette[$user][1] += $note;
						}
					}
				}

				ksort($moyennes, SORT_STRING);
				if ($mode == 1)
					foreach ($moyennes as $user => $value)
						echo ($user.":".($value[1] / $value[0])."\n");
				else if ($mode == 2)
					foreach ($moyennes as $user => $value) {
						if (isset($moulinette[$user]))
							echo ($user.":".(($value[1] / $value[0]) - ($moulinette[$user][1] / $moulinette[$user][0]))."\n");
						else
							echo ($user.":".($value[1] / $value[0])."\n");
					}
			}
		}
	}
}
else
	echo ("\n");

?>