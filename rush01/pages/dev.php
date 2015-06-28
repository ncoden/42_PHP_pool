<?php

if (isset($g_path) && isset($g_path[0]))
	$gameId = intval($g_path[0]);

if (!isset($gameId))
	header('Location: /');

require_once('class/Api.class.php');
require_once('class/InstanceManager.class.php');

$ship = InstanceManager::getShip(165);
$ship->fire(10);

?>
<pre>
	<?php
		var_dump($ship);
	?>
</pre>
