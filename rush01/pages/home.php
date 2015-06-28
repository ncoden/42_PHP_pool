<?php

require_once('class/User.class.php');

$games = DataBase::req('SELECT * FROM games');

?>

<div class = "container">
	<center>
		<a href = "/">
			<img src = "/resources/others/warhammer.png" class = "full-width"/>
		</a>
		<div class = "zone">
<?php if (User::isAuth()) { ?>
			<div class = "align-right">
				<?=$g_user['login']?>
				<a class = "button" href = "/logout">Logout</a>
			</div>
<?php } else { ?>
			Vous devez être connectés pour rejoindre une partie.
		 	<a class = "button" href = "/login">Login</a>
		 	<a class = "button" href = "/register">Register</a>
<?php } ?>
			<br/>
			<br/>
			<div class = "row">
<?php 
	foreach ($games as $game) {
		$count = DataBase::req('SELECT COUNT(id) FROM players WHERE gameId = ?', array($game['id']));
		$count = $count[0]['COUNT(id)'];
?>
				<div class = "col6 sm-col4 md-col3">
					<div class = "box">
<?php if ($count == 1) { ?>
						1 Player
<?php } else { ?>
						<?=$count?> Players
<?php } ?>
						<a class = "button" href = "/game/<?=$game['id']?>">Play</a>
					</div>
				</div>
<?php } ?>
			</div>
			<br/>
<?php if (User::isAuth()) { ?>
			<a class = "button" href = "/game/create">Create a game</a>
<?php } ?>
		</div>
	</center>
</div>