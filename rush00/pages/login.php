<?php

if ($g_user)
	redirect('/user/account');

$form_error = '';

if (isset($_POST['username'])
	&& isset($_POST['password']))
{
	if ($_POST['username'] != ''
		&& $_POST['password'] != '')
	{
		if (($return = db_select('users', 'username', $_POST['username']))
			&& isset($return[0])
			&& $return[0]['password'] == get_hash($_POST['password']))
		{
			$_SESSION['user'] = $return[0];
			header('Location: /');
		}
		else
			$form_error = 'Identifiant ou mot de passe invalide';
	}
}

?>
<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Login</h2>
	</div>

	<div class = "zone zone-box zone-white">
		<form action = "login" method = "POST">
			<?=$form_error ?>
			Nom d'utilisateur : <input name = "username" type = "text"/><br/>
			Mot de passe : <input name = "password" type = "password"/><br/>
			<input class = "button button-blue" type = "submit" value = "Valider"/>
		</form>
	</div>
</div>
