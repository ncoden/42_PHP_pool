<?php

function		get_hash($data)
{
	return (hash('whirlpool', 'dfxI#()Dd#d'.$data.')(Rqb4)_(*&^#'));
}

function		path_to_page($path, &$match)
{
	global		$g_pages;

	foreach ($g_pages as $name => $page)
	{
		if (fnmatch($page[0], $path))
		{
			$match = array_filter(explode('/', $path));
			return ($name);
		}
	}
	return (FALSE);
}

function		redirect($path)
{
	header('Location: '.$path);
	exit(0);
}

function		db_connect()
{
	static		$db = NULL;
	global		$db_server;
	global		$db_username;
	global		$db_password;
	global		$db_name;

	if (!$db)
	{
		$db = mysqli_connect(
			$db_server,
			$db_username,
			$db_password,
			$db_name
		);
	}
	return ($db);
}

function		db_exec($req, $datas = NULL)
{
	if ($req == '' || !($db = db_connect()))
		return (FALSE);
	if (!($stmt = mysqli_prepare($db, $req)))
		return (FALSE);

	if (is_array($datas) && !empty($datas))
	{
		$types = '';
		$params = [$stmt, &$types];

		foreach ($datas as $index => $data)
		{
			if (is_integer($data))
				$types .= 'i';
			else if (is_float($data))
				$types .= 'd';
			else if (is_string($data))
				$types .= 's';
			$params[] = &$datas[$index];
		}
		call_user_func_array("mysqli_stmt_bind_param", $params);
	}

	if (mysqli_stmt_execute($stmt))
	{
		$return = [];
		if ($res = mysqli_stmt_get_result($stmt))
		{
			while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
				$return[] = $row;
			return ($return);
		}
		return (TRUE);
	}
	return (FALSE);
}

function		db_select($table, $value1 = [], $value2 = NULL)
{
	if (!$table || !($db = db_connect()))
		return (FALSE);

	$req = db_get_select_req($table, $value1, $value2, $datas);
	return (db_exec($req, $datas));
}

function		db_update($table, $id, $values)
{
	if (is_array($values)
	&& $db = db_connect())
	{
		// build the req
		$sql = 'UPDATE '.$table.' SET ';
		foreach ($values as $field => $value)
			$sql .= $field.' = ?,';
		$sql = substr($sql, 0, -1);
		$sql .= ' WHERE id = ?';
		// add the id in the argument list
		array_push($values, $id);
		// request !
		return (db_exec($sql, array_values($values)));
	}
	return (FALSE);
}

function		db_insert($table, $datas)
{
	if (!$table || !($db = db_connect()))
		return (FALSE);

	$req = db_get_insert_req($table, $datas);
	return (db_exec($req, $datas));
}

function		getLastEntry($table)
{
	$return = db_exec('SELECT id FROM '.$table.' ORDER BY id DESC LIMIT 1');
	if (isset($return[0]))
		return (intval($return[0]['id']));
	return (FALSE);
}

function		db_get_select_req($table, $value1 = [], $value2 = NULL, &$datas)
{
	$req = 'SELECT * FROM '.$table;
	$datas = [];

	if (!is_array($value1) && $value2 != NULL)
		$value1 = [$value1 => $value2];

	if (!empty($value1))
	{
		$req .= ' WHERE';
		foreach ($value1 as $index => $value)
		{
			$req .= ' `'.$index.'` = ?';
			$datas[] = $value;
		}
	}
	return ($req);
}

function		db_get_insert_req($table, $datas)
{
	if (!empty($datas))
	{
		$req = 'INSERT INTO '.$table.' (`'.implode(array_keys($datas), '`,`').'`) VALUES (?';

		$count = count($datas) - 1;
		for ($i = 0; $i < $count; $i++)
			$req .= ',?';
		$req .= ')';

		return ($req);
	}
	return (FALSE);
}

?>