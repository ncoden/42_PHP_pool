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
<div class = "container">
	<center>
		<a href = "/">
			<img src = "/resources/others/warhammer.png" class = "full-width"/>
		</a>
		<div class = "zone">
			<form action = "/register" method = "POST">
				<input name = "login" type = "text"/><br/><br/>
				<input name = "password1" type = "password"/><br/><br/>
				<input name = "password2" type = "password"/><br/><br/>
				<input type = "submit" value = "S'inscire"/>
			</form>
		</div>
	</center>
</div>
