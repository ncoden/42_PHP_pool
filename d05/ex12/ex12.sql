SELECT `nom`, `prenom`
	FROM `db_ncoden`.`fiche_personne`
	WHERE `nom` LIKE '%-%' OR `prenom` LIKE '%-%'
	ORDER BY `nom`, `prenom`