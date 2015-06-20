<?php

session_start();
header('Content-Type: text/html; charset=utf-8');
$error = TRUE;

include('auth.php');

if (isset($_POST['login']) && isset($_POST['passwd'])
	&& $_POST['login'] != ''
	&& auth($_POST['login'], $_POST['passwd']))
{
	$_SESSION['loggued_on_user'] = $_POST['login'];
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
		<style type = "text/css">
			html, body {
				margin: 0;
				padding: 0;
			}
			body {
				background-color: #F8F8F8;
				font-size: 16px;
				font-family: sans-serif;
			}

			iframe {
				border: 0;
			}
			.chat {
				border-bottom: 1px solid #BBB;
			}
		</style>
	</head>
	<body>
		<iframe name="chat" src="chat.php" width="100%" height="550px" class = "chat"></iframe>
		<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
	</body>
</html>
<?php
}
else
{
	if (!isset($_SESSION['loggued_on_user']))
		$_SESSION['loggued_on_user'] = '';
	echo ("ERROR\n");
}

?>