<?php
	session_start();

	if (isset($_GET['login']))
	{
		$_SESSION['login'] = $_GET['login'];

		if (isset($_GET['passwd']))
			$_SESSION['passwd'] = $_GET['passwd'];
	}

	if (isset($_SESSION['login']))
		$login = $_SESSION['login'];
	else
		$login = '';

	if (isset($_SESSION['passwd']))
		$password = $_SESSION['passwd'];
	else
		$password = '';
?>
<html>
	<body>
		<form action = "index.php" method = "GET">
			Identifiant: <input type = "text" name = "login" value = "<?=$login ?>"/><br/>
			Mot de passe : <input type = "password" name = "passwd" value = "<?=$password ?>"/>
			<input type = "submit" value = "OK"/>
		</form>
	</body>
</html>