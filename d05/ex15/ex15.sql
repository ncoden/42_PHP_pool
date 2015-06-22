SELECT REVERSE(RIGHT(`telephone`, LENGTH(`telephone`) - 1)) as 'enohpelet'
	FROM `db_ncoden`.`distrib`
	WHERE `telephone` LIKE '05%'