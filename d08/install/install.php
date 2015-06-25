<?php

$servername = '127.0.0.1';
$username = 'root';
$password = '123456';
$dbname = 'd08';
$source = dirname(__FILE__).'/d08.sql';

// Create connection
$con = mysqli_connect($servername, $username, $password);
$sql = 'CREATE DATABASE `'.$dbname.'`';
if (mysqli_query($con, $sql))
	echo ("Database created successfully\n");
else
	echo ('Error creating database: '.mysqli_error($con)."\n");
mysqli_close($con);

$con = mysqli_connect($servername, $username, $password, $dbname);
$sqlfile = file_get_contents($source);

if (mysqli_multi_query($con, $sqlfile))
{
	// Store first result set
	if ($result = mysqli_store_result($con))
	{
		while ($row = mysqli_fetch_row($result))
			echo ($row[0]."\n");
		mysqli_free_result($con);
	}
}

?>