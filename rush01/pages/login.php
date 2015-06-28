<?php

require_once('class/User.class.php');

if (isset($_POST['login'])
	&& isset($_POST['password']))
{
	if (User::auth($_POST['login'], $_POST['password']))
	{
		if ($_POST['redirect'])
			redirect($_POST['redirect']);
		else
			redirect('/');
	}
}

?>
<div class = "container">
	<center>
		<a href = "/">
			<img src = "/resources/others/warhammer.png" class = "full-width"/>
		</a>
		<div class = "zone">
			<form action = "/login" method = "POST">
				<input name = "redirect" type = "hidden" value = "<?php if (isset($_GET['redirect'])) {echo ($_GET['redirect']);}?>"/>
				<input name = "login" type = "text"/><br/><br/>
				<input name = "password" type = "password"/><br/><br/>
				<input type = "submit" value = "Se connecter"/>
			</form>
		</div>
	</center>
</div>
