SELECT	`genre`.`id_genre`		AS 'id_genre',
		`genre`.`nom`			AS 'nom genre',
		`distrib`.`id_distrib`	AS 'id_distrib',
		`distrib`.`nom`			AS 'nom distrib',
		`film`.`titre`			AS 'titre'
	FROM `db_ncoden`.`film`
	INNER JOIN `db_ncoden`.`genre` ON `film`.`id_genre` = `genre`.`id_genre`
	INNER JOIN `db_ncoden`.`distrib` ON `film`.`id_distrib` = `distrib`.`id_distrib`