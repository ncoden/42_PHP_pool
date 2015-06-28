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
<div class = "container">
	<center>
		<a href = "/">
			<img src = "/resources/others/warhammer.png" class = "full-width"/>
		</a>
		<div class = "zone">
			<form action = "/game/create" method = "POST">
				Name: <input type = "text" name = "gameName"/><br/><br/>
				<input type = "submit" value = "create"/>
			</form>
		</div>
	</center>
</div>
