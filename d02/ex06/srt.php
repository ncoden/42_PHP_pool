#!/usr/bin/php
<?php

function	cmp_by_subindex($a, $b) {
	return $a[0] - $b[0];
}

if (isset($argv) && isset($argv[1]) && file_exists($argv[1])) {

	$blocks = explode("\n\n", file_get_contents($argv[1]));
	$datas = [];
	$statics = [];

	foreach ($blocks as $i => $block) {
		$block = trim($block);
		if (preg_match('/([^\n]*)\n(([0-9]+)\:([0-9]+)\:([0-9]+),([0-9]+) --> ([0-9]+)\:([0-9]+)\:([0-9]+),([0-9]+))\n([^\n]*)/', $block, $m)) {
			$statics[] = $m[1];
			$datas[] = [
				(int)$m[3] * 10000000 + (int)$m[4] * 100000 + (int)$m[5] * 1000 + (int)$m[6]
				+ (int)$m[7] * 10000000 + (int)$m[8] * 100000 + (int)$m[9] * 1000 + (int)$m[10],
				$m[2],
				$m[11]
			];
		}
	}
	usort($datas, "cmp_by_subindex");

	foreach ($datas as $i => $data) {
		if ($i != 0)
			echo ("\n");
		echo ($statics[$i]."\n".$data[1]."\n".$data[2]."\n");
	}
}

?>