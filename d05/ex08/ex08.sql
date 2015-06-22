SELECT `nom`, `prenom`, CAST(`date_naissance` AS date) AS 'date de naissance'
	FROM `db_ncoden`.`fiche_personne`
	WHERE EXTRACT(YEAR FROM `date_naissance`) = '1989'
	ORDER BY `name` ASC