<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "rush00";

// Create connection
$con = mysqli_connect($servername, $username, $password);
$sql = "CREATE DATABASE test01";
    if (mysqli_query($con, $sql)) {
        echo "Database created successfully\n";
    }
    else
        echo "Error creating database: " . mysqli_error($con);
mysqli_close($con);
$con = mysqli_connect($servername, $username, $password, $dbname);
$sqlfile = file_get_contents("rush00.sql");

if (mysqli_multi_query($con,$sqlfile))
{    // Store first result set
    if ($result=mysqli_store_result($con))
      {
      while ($row=mysqli_fetch_row($result))
        {
        printf("%s\n",$row[0]);
        }
      mysqli_free_result($con);
      }
}

?>