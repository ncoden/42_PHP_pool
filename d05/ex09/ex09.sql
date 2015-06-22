SELECT COUNT(`duree_min`) AS 'nb_court-metrage'
	FROM `db_ncoden`.`film`
	WHERE `duree_min` <= 42