<html>
	<head>
		<title>Chinese Store</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
		<link rel = "stylesheet" type = "text/css" href = "/resources/aaacss.css"/>
		<link rel = "stylesheet" type = "text/css" href = "/resources/style.css"/>
	</head>
	<body>
		<header class = "header">
			<nav class = "container">
				<a class = "header-link" href = "/">Chinese Store</a>
				<div class = "align-right">
<?php if ($g_user) { ?>
				<a class = "header-link" href = "/user/account"><?=$g_user['username']?></a>
<?php } else { ?>
				<a class = "header-link" href = "/login">Login</a>
				<a class = "header-link" href = "/register">Register</a>
<?php } ?>
				</div>
			</nav>
		</header>
<?php

?>