<?php

if ($g_user)
	redirect('/user/account');

$form_validated = FALSE;
$form_errors = [
	'username' => ''
];

if (isset($_POST['username'])
	&& isset($_POST['password1'])
	&& isset($_POST['password2']))
{
	if ($_POST['username'] != ''
		&& $_POST['password1'] != ''
		&& $_POST['password1'] == $_POST['password2'])
	{
		if (db_select('users', 'username', $_POST['username']))
			$form_errors['username'] = 'Le nom d\'utilisateur existe déjà';
		else
		{
			db_insert('users', [
				'username' => $_POST['username'],
				'password' => get_hash($_POST['password1']),
			]);
			$form_validated = TRUE;
		}
	}
}

if ($form_validated)
	echo ('Inscription réussie, vous pouvez vous conneter<br/>');

?>
<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Register</h2>
	</div>

	<div class = "zone zone-box zone-white">
		<form action = "register" method = "POST">
			Nom d'utilisateur : <input name = "username" type = "text"/><br/>
			<?=$form_errors['username'] ?>
			Mot de passe : <input name = "password1" type = "password"/><br/>
			Confirmez le mot de passe : <input name = "password2" type = "password"/><br/>
			<input class = "button button-blue" type = "submit" value = "Valider"/>
		</form>
	</div>
</div>