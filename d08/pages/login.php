<?php

require_once('class/User.class.php');

if (isset($_POST['login'])
	&& isset($_POST['password']))
{
	if (User::auth($_POST['login'], $_POST['password']))
		header('Location: /');
}

?>
<form action = "/login" method = "POST">
	<input name = "login" type = "text"/>
	<input name = "password" type = "password"/>
	<input type = "submit" value = "Se connecter"/>
</form>