SELECT `etage_salle` as 'etage', SUM(`nbr_siege`) as 'sieges'
	FROM `db_ncoden`.`salle`
	GROUP BY `etage_salle`
	ORDER BY `sieges` DESC