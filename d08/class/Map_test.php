<!DOCTYPE html>

<html lang=''>
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/buttons_login.css">
    <title>MAP TEST</title>
</head>

<body>


<?php
session_start();
include('Dice.class.php');
include('Game.class.php');
  $boolarray = Array(false => 'false', true => 'true');

//print Dice::toss()."\n";
//var_dump(Dice::multi_toss(5));
//print $boolarray[Dice::min_toss(3, 1)]."\n";
  $m_game = new Game();
  $m_game->GenerateMap();

  $rendermode = 2;
  if ($rendermode == 1)
  {
      echo "<table class=\"myTable\" cellspacing=\"0\" cellpadding = \"0\">";
      $m_game->RenderMap();
      echo "</table>";
  }
  else
  {
      echo "<div class=\"map_container\">";
      $m_game->RenderMap2();
      echo "</div>";
  }

?>


</body>
</html>
