SELECT `titre`, `resum` FROM `db_ncoden`.`film`
	WHERE UPPER(`resum`) LIKE UPPER('%vincent%')
	ORDER BY `id_film` ASC