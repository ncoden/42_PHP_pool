<?php

$realm = 'Espace membres';

$users = [
	'zaz' => 'jaimelespetitsponeys',
];

echo ('<html><body>');

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
	$user = $_SERVER['PHP_AUTH_USER'];
	$password = $_SERVER['PHP_AUTH_PW'];

	if (isset($users[$user]) && $users[$user] == $password)
	{
		$base64 = base64_encode(file_get_contents('img/42.png'));
		echo ("Bonjour ".$user."<br />\n<img src='data:image/png;base64,".$base64."'>\n");
	}
	else
	{
		header ('WWW-Authenticate: Basic realm="'.$realm.'"');
		header ('HTTP/1.0 401 Unauthorized');
		echo ('Cette zone est accessible uniquement aux membres du site');
	}
}

echo ("</body></html>\n");

?>