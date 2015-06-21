<?php

if (!$g_user)
	redirect('/login');

// ACCOUNT FORM
$account_updated = FALSE;
if (isset($_POST['action'])
	&& $_POST['action'] == 'account_edit')
{
	if (isset($_POST['first_name'])
		&& isset($_POST['last_name'])
		&& isset($_POST['email']))
	{
		db_update('users', $g_user['id'], [
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email']
		]);
		$g_user['first_name'] = $_POST['first_name'];
		$g_user['last_name'] = $_POST['last_name'];
		$g_user['email'] = $_POST['email'];
		$_SESSION['user'] = $g_user;
		$account_updated = TRUE;
	}
}

?>
<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Account</h2>
		<span class = "align-right">
			<a class = "button" href = "/user/cart">Cart</a>
			<a class = "button" href = "/user/purchases">Purchases</a>
			<a class = "button button-blue" href = "/logout">Logout</a>
		</span>
	</div>

	<div class = "zone zone-box zone-white">
		<div class = "title title-h3">
			<h3 class = "title-text">Edit my details</h3>
		</div>
		<form action = "/user/account" method = "POST">
			First name : <input type = "text" name = "first_name" value = "<?=$g_user['first_name']?>"/><br/>
			Last name : <input type = "text" name = "last_name" value = "<?=$g_user['last_name']?>"/><br/>
			Email : <input type = "text" name = "email" value = "<?=$g_user['email']?>"/><br/>
			<input type = "hidden" name = "action" value = "account_edit"/>
			<input class = "button button-blue" type = "submit" value = "Valid"/>
		</form>
	</div>

	<div class = "zone zone-box zone-white">
		<div class = "title title-h3">
			<h3 class = "title-text">Advanced</h3>
		</div>
<?php if ($g_user['type'] == 'admin') { ?>
		<a class = "button" href = "/admin">Admin panel</a>
<?php } ?>
		<form class = "form-inline" action = "/user/account" method = "POST">
			<input type = "hidden" name = "action" value = "account_close"/>
			<a class = "button" href = "/user/account/close">Close my account</a>
		</form>
	</div>
</div>
