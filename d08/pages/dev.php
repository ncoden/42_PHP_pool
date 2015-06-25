<?php

if (isset($g_path) && isset($g_path[0]))
	$gameId = intval($g_path[0]);

if (!isset($gameId))
	header('Location: /');

require_once('class/Api.class.php');
$api = new Api();
$api->gameRefresh(array(
	'gameId' => $gameId
));

?>
<pre>
	<?php
		var_dump($api->getReturn());
	?>
</pre>