INSERT INTO `db_ncoden`.`ft_table` (`login`, `groupe`, `date_de_creation`)
	SELECT `nom`, 'other', `date_naissance`
	FROM `db_ncoden`.`fiche_personne`
	WHERE `nom` LIKE '%a%' AND LENGTH(`nom`) < 9
	ORDER BY `nom` ASC
	LIMIT 10