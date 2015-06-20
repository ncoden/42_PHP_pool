<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

$error = TRUE;

include('auth.php');

if (isset($_GET['login']) && isset($_GET['passwd'])
	&& $_GET['login'] != ''
	&& auth($_GET['login'], $_GET['passwd']))
{
	$_SESSION['loggued_on_user'] = $_GET['login'];
	echo ("OK\n");
}
else
{
	$_SESSION['loggued_on_user'] = '';
	echo ("ERROR\n");
}

?>