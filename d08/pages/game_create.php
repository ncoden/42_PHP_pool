<?php

if (isset($_POST['gameName']))
{
	require_once('class/Api.class.php');

	$api = new Api();
	$gameId = $api->gameCreate(array(
		'name' => $_POST['gameName'],
	));
	header('Location: /game/'.$gameId);
}

?>
<form action = "/game/create" method = "POST">
	<input type = "text" name = "gameName"/>
	<input type = "submit" value = "create"/>
</form>