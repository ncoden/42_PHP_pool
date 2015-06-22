SELECT UPPER(`fiche_personne`.`nom`) AS 'NOM', 
	`fiche_personne`.`prenom`,
	`abonnement`.`prix`
	FROM `db_ncoden`.`membre`
	INNER JOIN `db_ncoden`.`fiche_personne` ON `membre`.`id_fiche_perso` = `fiche_personne`.`id_perso`
	INNER JOIN `db_ncoden`.`abonnement` ON `membre`.`id_abo` = `abonnement`.`id_abo`
	WHERE `abonnement`.`prix` > 42
	ORDER BY `fiche_personne`.`nom` ASC, `fiche_personne`.`prenom` ASC