<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$g_page_defaut = 'home';
$g_page_nofound = '404';

$g_pages = [
	'home' =>				['',						'pages/home.php'],
	'404' =>				['404',						'pages/404.php'],
	'register' =>			['register',				'pages/register.php'],
	'login' =>				['login',					'pages/login.php'],
	'logout' =>				['logout',					'pages/logout.php'],
	'user' =>				['user/account',			'pages/user_account.php'],
	'user_cart' =>			['user/cart',				'pages/user_cart.php'],
	'user_purchases' =>		['user/purchases',			'pages/user_purchases.php'],
	'user_close' =>			['user/account/close',		'pages/user_close.php'],
	'article' =>			['article/*',				'pages/article.php'],
	'category' =>			['category/*',				'pages/category.php'],
	'admin' =>				['admin',					'pages/admin.php'],
	'admin_articles' =>		['admin/articles',			'pages/admin_articles.php'],
	'admin_edit_article' =>	['admin/edit/article/*',	'pages/admin_edit_article.php'],
];

$db_server = 'localhost';
$db_name = 'rush00';
$db_username = 'root';
$db_password = '123456';


// ----- INIT -----

require('functions.php');


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
	'file'
], $g_pages[$g_page]);


// ----- USER -----

$g_user = NULL;

session_start();
if (isset($_SESSION['user']))
	$g_user = $_SESSION['user'];
else
	$_SESSION['user'] = NULL;


// ----- PAGE -----

header('Content-Type: text/html; charset=utf-8');

include('pages/header.php');

if (file_exists($g_page_datas['file']))
	include($g_page_datas['file']);

include('pages/footer.php');

?>