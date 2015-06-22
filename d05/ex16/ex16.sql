SELECT COUNT(`date`) as 'films'
	FROM `historique_membre`
	WHERE (`date` BETWEEN '03/10/2006' AND '27/07/2007')
	OR (EXTRACT(DAY FROM `date`) = 24 AND EXTRACT(MONTH FROM `date`) = 12)