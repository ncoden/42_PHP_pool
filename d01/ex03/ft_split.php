<?php

function		ft_split($str) {
	if (is_string($str)) {
		$tab = array_filter(explode(' ', $str));
		sort ($tab, SORT_STRING);
		return ($tab);
	}
	else
		return (FALSE);
}

?>