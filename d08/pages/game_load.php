<?php
if (isset($g_path) && isset($g_path[0]))
	$gameId = intval($g_path[0]);

if (!isset($gameId))
	header('Location: /');

?>
<!DOCTYPE HTML>
<html lang=''>
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/resources/css/index.css">
	<link rel="stylesheet" href="/resources/css/signup.css">
	<link rel="stylesheet" href="/resources/css/buttons_login.css">
		<style>
	input{
		display: block;
	}
	.formu {
		position: absolute;
		width: 100px;
		height: 150px;
		/*background-color: #222; */
		display: none; 
	};
	</style>
	<title>MAP TEST</title>
</head>

<body id="A" onload="init();">
<script src="//code.jquery.com/jquery-1.11.2.min.js"> </script>
<script> var gameId = <?php echo($gameId); ?>; </script>
<div id="carrerouge" class="formu">
<input placeholder="moteur" id="moteur">
<input placeholder="arme" id="arme">
<input placeholder="bouclier" id="bouclier">
<select placeholder="rotation" id="rotation">
	<option id="none">aucune</option>
	<option id="gauche">gauche</option>
	<option id="droite">droite</option>
</select>
<input placeholder="nombre de cases" type="number" id="number">
<input type="submit" id="move" value="Se deplacer">
<input type="submit" id="fire" value="Tirer">
</div>
<canvas id="Warhammer" width="1695" height="1000" style="background-color: grey;"></canvas>
<script src="https://code.createjs.com/easeljs-0.8.0.min.js"></script>
<script src="https://code.createjs.com/tweenjs-0.6.0.min.js"></script>
<script src="https://code.createjs.com/soundjs-0.6.0.min.js"></script>
<script src="/resources/js/Input.js" type="text/javascript"></script>
<script src="/resources/js/Map.js" type="text/javascript"></script>
<script src="/resources/js/Ship.js" type="text/javascript"></script>
<script src="/resources/js/Ajax.js" type="text/javascript"></script>
<script src="/resources/js/Events.js" type="text/javascript"></script>
<script src="/resources/js/Asteroid.js" type="text/javascript"></script>
<script src="/resources/js/BoundingBoxHitTest.js" type="text/javascript"></script> 
<script>

var stage;
  var direction = "up";
  var tmpship;
  function init()
  {
	  var stage = new createjs.Stage("Warhammer");
	  stage.enableMouseOver(50);
	  Events_init(stage);
	  generateGrid(stage);
	 
	//  tmpship = new Ship(1, 0, 1, "test", 15, 8, 'a', 1,2,3,4,5, 0,0);
	  //tmpship.rendership(stage);
	  //tmpship.Makeclickable(stage);	 

	  createjs.Ticker.setInterval(25);
	  createjs.Ticker.setFPS(60);
	  createjs.Ticker.addEventListener("tick", handleTick);
	   AJAX_game_id(gameId);
	   Event_Load_Sounds();
	  function handleTick(event)
	  {

			stage.update();
			if (FLAG_Setup_Ships)
			{
				Event_Render_Map_Ships();
				FLAG_Setup_Ships = false;
			}
			if (FLAG_Setup_Elements)
			{
				Event_Render_Map_Elements();
				FLAG_Setup_Elements = false;
			}
	  }
	  
	 //  window.addEventListener('keydown', whatKey, true);
	   window.setInterval(AJAX_game_refresh, 2000);
  }
  function whatKey(event)
  {
	switch (event.keyCode)
	{
		// left arrow
		case 37:
			direction = ship_rotation.LEFT;
			tmpship.tweenPos_Map(tmpship.mapX - 5, tmpship.mapY);
			break;
			// right arrow
		case 39:
			direction = ship_rotation.RIGHT;
			tmpship.tweenPos_Map(tmpship.mapX + 5, tmpship.mapY);
			break;
			// down arrow
		case 40:
			direction = ship_rotation.DOWN;
			 tmpship.tweenPos_Map(tmpship.mapX , tmpship.mapY + 5);
			 
			break;
			// up arrow 
		case 38:
			direction = ship_rotation.UP;
			tmpship.tweenPos_Map(tmpship.mapX , tmpship.mapY - 5);
			break;
	}
  }
</script>
</body>
</html>