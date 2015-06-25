<?php

require_once('class/User.class.php');

if (isset($_POST['login'])
	&& isset($_POST['password1'])
	&& isset($_POST['password2']))
{
	$return = User::create(array(
		'login' => $_POST['login'],
		'password' => $_POST['password1']
	));
	if ($return)
		header('Location: /login');
}

?>
<form action = "/register" method = "POST">
	<input name = "login" type = "text"/>
	<input name = "password1" type = "password"/>
	<input name = "password2" type = "password"/>
	<input type = "submit" value = "S'inscire"/>
</form>