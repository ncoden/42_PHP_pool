SELECT DATEDIFF(MAX(`date`), MIN(`date`)) AS 'uptime'
	FROM `db_ncoden`.`historique_membre`
	GROUP BY `id_film`