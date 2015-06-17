#!/usr/bin/php
<?php

if (isset($argv) && isset($argv[1])) {
	if (preg_match('/^([a-zA-Z0-9]*\:\/\/)?([^\/]+)([^?#]*)/', $argv[1], $url)) {
		$domain = $url[2];
		$url_site = $url[1].$url[2];
		$url_base = $url[1].$url[2].$url[3];

		$curl = curl_init($url_base);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$return = curl_exec($curl);

		if (preg_match('/<img [^>]*src ?= ?"([^"]*)"[^>]*\/?>/', $return, $pictures)) {
			if (!file_exists($domain))
				mkdir($domain);

			array_shift($pictures);
			foreach ($pictures as $picture) {
				if (preg_match('/\/([^\/]+)$/', $picture, $name_parts))
					$filename = $name_parts[1];
				else
					$filename = 'picture';
				$path = $domain.'/'.$filename;

				if (preg_match('/^[a-zA-Z0-9]*\:\/\//', $picture))
					$url_picture = $picture;
				else if ($picture[0] == '/')
					$url_picture = $url_site.$picture;
				else
					$url_picture = $url_base.'/'.$picture;

				$curl = curl_init($url_picture);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$content = curl_exec($curl);
				file_put_contents($path, $content);
			}
		}
	}
}

?>