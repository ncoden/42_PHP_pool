<?php

class			DataBase {
	public		$autosave = TRUE;
	public		$src_dir = '';
	public		$src_file = '';
	public		$id = '';
	private		$rows = [];

	static function		hash($row)
	{
		return (hash('md5', '@#$@#@ *(e D(44'.$row.'#@*$W#(@) #()'));
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

session_start();
date_default_timezone_set('Europe/Paris');
header('Content-Type: text/html; charset=utf-8');

$msg_added = FALSE;

if ($_SESSION['loggued_on_user'] != '')
{
	if (isset($_POST['msg']) && $_POST['msg'] != '')
	{
		$chat = new DataBase('../private/chat', '../private', 'login');
		$msg_added = $chat->add_row([
			'login' => $_SESSION['loggued_on_user'],
			'time' => time(),
			'msg' => $_POST['msg']
		]);
	}
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
				background-color: #F8F8F8;
				font-size: 16px;
				font-family: sans-serif;
			}

			.input {
				vertical-align: middle;
				margin: .25em 0;
				padding: .5em .75em;

				border: 1px solid #BBB;
				box-shadow: 0 1px .25em rgba(0,0,0,.2) inset;
				border-radius: .25em;
			}
			.input:focus {
				outline: 0;
				border: 1px solid #888;
			}
			.button {
				vertical-align: middle;
				margin: .25em 0;
				padding: .5em .75em;

				border: 1px solid #3079ed;
				background-color: #4d90fe;
				box-shadow: 0 1px .25em rgba(0,0,0,.2);
				border-radius: .25em;

				color: white;
				cursor: pointer;
			}
			.button:focus {
				outline: 0;
			}
			.button:hover {
				background-color: #4f9ffe;
				border: 1px solid #2069dd;
			}
			.button:active {
				background-color: #3d80ee;
				border: 1px solid #2069dd;
				box-shadow: 0 1px .25em rgba(0,0,0,.3) inset;
			}

			.txt-center {
				text-align: center;
			}
			.paddings-v {
				padding: .5em 2em;
			}
		</style>
<?php if ($msg_added) { ?>
		<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
<?php } ?>
	</head>
	<body>
		<div class = "paddings-v">
			<form action = "speak.php" method = "POST">
				<input class = "input" type = "text" name = "msg" autofocus = "true" size = "100%"/>
				<input class = "button" type = "submit" value = "OK"/>
			</form>
		</div>
	</body>
</html>

<?php
}
else
	echo("ERROR\n");

?>