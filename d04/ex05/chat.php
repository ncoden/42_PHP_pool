<?php

class			DataBase {
	public		$autosave = TRUE;
	public		$src_dir = '';
	public		$src_file = '';
	public		$id = '';
	private		$rows = [];

	static function		hash($row)
	{
		return (hash('whirlpool', '@#$@#@ *(e D(44'.$row.'#@*$W#(@) #()'));
	}

	function		__construct($src_file, $src_dir, $id) 
	{
		$this->src_file = $src_file;
		$this->src_dir = $src_dir;
		$this->$id = $id;
		$this->read();
	}

	function		read()
	{
		if (file_exists($this->src_file)
			&& $fd = fopen($this->src_file, 'r'))
		{
			if (flock($fd, LOCK_SH))
			{
				$content = file_get_contents($this->src_file);
				fclose($fd);
				$this->rows = unserialize($content);
				return (TRUE);
			}
			fclose($fd);
		}
		return (FALSE);
	}

	function		save()
	{
		if (!file_exists($this->src_dir))
			mkdir($this->src_dir, 0777, TRUE);
		$datas = serialize($this->rows);
		if ($fd = fopen($this->src_file, 'w'))
		{
			if (flock($fd, LOCK_EX))
			{
				file_put_contents($this->src_file, $datas);
				flock($fd, LOCK_UN);
				fclose($fd);
				return (TRUE);
			}
			fclose($fd);
		}
		return (FALSE);
	}

	function		add_row($row) {
		if (isset($row[$this->id]) && $this->get_row($row[$this->id]))
			return (FALSE);
		$this->rows[] = $row;

		if ($this->autosave)
			return ($this->save());
	}

	function		get_rows() {
		return ($this->rows);
	}

	function		get_row($id) {
		foreach ($this->rows as $row)
		{
			if (isset($row[$this->id]) && $row[$this->id] == $id)
				return ($row);
		}
		return (FALSE);
	}

	function		get_row_index($id) {
		foreach ($this->rows as $index => $row)
		{
			if (isset($row[$this->id]) && $row[$this->id] == $id)
				return ($index);
		}
		return (-1);
	}

	function		get_row_field($id, $field) {
		foreach ($this->rows as $row)
		{
			if (isset($row[$this->id]) && $row[$this->id] == $id 
				&& isset($row[$field]))
				return ($row[$field]);
		}
		return (FALSE);
	}

	function		set_row_field($id, $field, $value) {
		if ($field != '' && ($index = $this->get_row_index($id)) != -1)
		{
			$this->rows[$index][$field] = $value;
			if ($this->autosave)
				return ($this->save());
			return (TRUE);
		}
		return (FALSE);
	}
}

date_default_timezone_set('Europe/Paris');
header('Content-Type: text/html; charset=utf-8');

$chat = new DataBase('../private/chat', '../private', 'login');
$messages = $chat->get_rows();

?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
		<style type = "text/css">
			html, body {
				margin: 0;
				padding: 0;
			}
			body {
				background-color: #FFF;
				font-size: 16px;
				font-family: sans-serif;
			}

			.chat {
				padding: 0 .5em;
			}

			.msg {
				padding: .25em .25em;
			}
			.msg-time {
				color: #888;
				font-size: .87em;
			}
			.msg-login {
				font-weight: bold;
			}

		</style>
	</head>
	<body>
		<div class = "chat">
<?php

foreach($messages as $m)
{
?>
	<div class = "msg">
		<span class = "msg-time"><?=date('H:i', $m['time']) ?></span>
		<span class = "msg-login"><?=$m['login'] ?></span>: 
		<?=$m['msg'] ?>
	</div>
<?php
}

?>
		</div>
	</body>
</html>