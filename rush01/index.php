<?php

$g_page_defaut = 'home';
$g_page_nofound = '404';

$g_pages = [
	'api' =>			['api/*',		'pages/api.php',			TRUE,	FALSE],

	'home' =>			['',			'pages/home.php',		 	FALSE,	TRUE],
	'login' =>			['login',		'pages/login.php',		 	FALSE,	TRUE],
	'logout' =>			['logout',		'pages/logout.php',		 	TRUE,	TRUE],
	'register' =>		['register',	'pages/register.php',		FALSE,	TRUE],
	'game_create' =>	['game/create',	'pages/game_create.php',	TRUE,	TRUE],
	'game_load' =>		['game/*',		'pages/game_load.php',		TRUE,	FALSE],

	'404' =>			['404',			'pages/404.php',			FALSE,	TRUE],
	'dev' =>			['dev/*',		'pages/dev.php',			FALSE,	TRUE],
];

// ----- INIT -----

require('functions.php');
require('class/DataBase.class.php');
require('class/User.class.php');

DataBase::init( array(
	'server' => 'localhost',
	'name' => 'rush01',
	'username' => 'root',
	'password' => '123456'
));


// ----- ROOT -----

$g_page = $g_page_defaut;
$g_path = [];

if (isset($_GET['path']) && $_GET['path'] != '')
{
	if (!($g_page = path_to_page($_GET['path'], $g_path)))
	{
		$g_page = $g_page_nofound;
		$g_page_datas = $g_pages[$g_page];
	}
}

$g_page_datas = array_combine([
	'match',
	'file',
	'auth',
	'header'
], $g_pages[$g_page]);


// ----- USER -----

$g_user = NULL;

session_start();
if (isset($_SESSION['user']))
	$g_user = $_SESSION['user'];
else
	$_SESSION['user'] = NULL;

if ($g_page_datas['auth'] && !User::isAuth())
	redirect('/login?redirect='.$_SERVER['REQUEST_URI']);


// ----- PAGE -----

header('Content-Type: text/html; charset=utf-8');

if ($g_page_datas['header'])
	include('pages/header.php');

if (file_exists($g_page_datas['file']))
	include($g_page_datas['file']);

if ($g_page_datas['header'])
	include('pages/footer.php');

?>
