<?php

if (!isset($g_user)
	|| !$g_user
	|| $g_user['type'] != 'admin')
	redirect('/');

// GET ARTICLE
if (isset($g_path)
	&& isset($g_path[3]))
{
	if ($results = db_select('articles', ['id' => (int)$g_path[3]]))
	{
		if (isset($results[0]))
			$article = $results[0];
	}
}

if (!$article)
	redirect('/');


if (isset($_POST['action'])
	&& $_POST['action'] == 'article_edit')
{
	if (isset($_POST['article_name'])
		&& isset($_POST['article_price'])
		&& isset($_POST['article_description'])
		&& isset($_POST['article_stock']))
	{
		db_update('articles', $article['id'], [
			'name' => $_POST['article_name'],
			'price' => $_POST['article_price'],
			'description' => $_POST['article_description'],
			'stock' => $_POST['article_stock'],
		]);
		redirect('/admin/articles');
	}
}

?>
<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Admin Panel / Edit article <?=$article['name']?></h2>
		<span class = "align-right">
			<a class = "button" href = "/admin/articles">Back to the articles admin panel</a>
			<a class = "button button-blue" href = "/logout">Logout</a>
		</span>
	</div>

	<div class = "zone zone-box zone-white">
		<form action = "/admin/edit/article/<?=$article['id']?>" method = "POST">
			Name: <input type = "text" name = "article_name" value = "<?=$article['name']?>"/><br/>
			Price: <input type = "text" name = "article_price" value = "<?=$article['price']?>"/><br/>
			Stock: <input type = "text" name = "article_stock" value = "<?=$article['stock']?>"/><br/>
			Description: <br/><textarea name = "article_description"><?=$article['description']?></textarea><br/>
			<br/>
			<input type = "hidden" name = "action" value = "article_edit"/>
			<input class = "button button-blue" type = "submit" value = "Valid"/>
		</form>
	</div>
</div>
