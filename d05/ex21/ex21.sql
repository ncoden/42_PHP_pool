SELECT MD5(REPLACE(CONCAT(`telephone`, '42'), '7', '9'))
	FROM `db_ncoden`.`distrib`
	WHERE `id_distrib` = 84