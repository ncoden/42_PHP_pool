SELECT `titre` AS 'Titre', `resum` AS 'Resume', `annee_prod`
	FROM `db_ncoden`.`film`
	INNER JOIN `db_ncoden`.`genre` ON `film`.`id_genre` = `genre`.`id_genre`
	WHERE `genre`.`nom` = 'erotic'