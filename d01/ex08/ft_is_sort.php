<?php

function			ft_is_sort ($array) {
	$prev = array_shift($array);

	foreach ($array as $value) {
		if (strcmp($prev, $value) > 0)
			return (FALSE);
		$prev = $value;
	}
	return (TRUE);
}

?>