UPDATE `db_ncoden`.`ft_table`
	SET `date_de_creation` = DATE_ADD(`date_de_creation`, interval 20 year)
	WHERE `id` > 5