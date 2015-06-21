<?php

if (!$g_user)
	redirect('/login');

// ACCOUNT CLOSE
if (isset($_POST['action'])
	&& $_POST['action'] == 'account_close')
{
	db_exec('DELETE FROM users WHERE id = ?', [$g_user['id']]);
	redirect('/logout');
}

?>
<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Close account</h2>
	</div>

	<div class = "zone zone-box zone-white">
		Do you really want to close your account ?<br/>
		<br/>
		<form action = "/user/account/close" method = "POST">
			<input type = "hidden" name = "action" value = "account_close"/>
			<input class = "button button-blue" type = "submit" value = "Close my account"/>
			<a class = "button" href = "/user/account">Cancel</a>
		</form>
	</div>
</div>