<?php

if (!isset($g_user)
	|| !$g_user
	|| $g_user['type'] != 'admin')
	redirect('/');

if (isset($_POST['action'])
	&& $_POST['action'] == 'article_remove')
{
	if (isset($_POST['article_index']))
	{
		$article_id = (int)$_POST['article_index'];
		db_exec('DELETE FROM articles WHERE id = ?', [$article_id]);
	}
}

if (isset($_POST['action'])
	&& $_POST['action'] == 'article_add')
{
	if (isset($_POST['article_name'])
		&& isset($_POST['article_price'])
		&& isset($_POST['article_description'])
		&& isset($_POST['article_stock']))
	{
		db_insert('articles', [
			'name' => $_POST['article_name'],
			'price' => $_POST['article_price'],
			'description' => $_POST['article_description'],
			'stock' => $_POST['article_stock'],
		]);
	}
}

$articles = db_select('articles');

?>
<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Admin Panel / Articles</h2>
		<span class = "align-right">
			<a class = "button" href = "/admin">Back to the admin panel</a>
			<a class = "button button-blue" href = "/logout">Logout</a>
		</span>
	</div>

	<div class = "zone zone-box zone-white">
		<div class = "title title-h3">
			<h3 class = "title-text">Articles</h3>
		</div>
		<div class = "row">
<?php foreach ($articles as $article) { ?>
			<div class = "col6 sm-col4 md-col3">
				<div class = "article">
					<a href = "/article/<?=$article['id']?>">
						<img class = "article-picture" src = "/resources/articles/picture.jpeg"/>
					</a>
					<div class = "article-about">
						<div class = "align-middle">
							<a class = "article-name" href = "/article/<?=$article['id']?>"><?=$article['name']?></a>
							<div class = "article-price"><?=$article['price']?> $</div>
							<div class = "txt-sub"><?=$article['stock']?> in stock</div>
						</div>
						<center>
							<form class = "form-inline" action = "/admin" method = "POST">
								<input type = "hidden" name = "action" value = "article_remove"/>
								<input type = "hidden" name = "article_index" value = "<?=$article['id']?>"/>
								<input class = "button" type = "submit" value = "Remove"/>
							</form>
							<a class = "button" href = "/admin/edit/article/<?=$article['id']?>">Edit</a>
						</center>
					</div>
				</div>
			</div>
<?php } ?>
		</div>
	</div>

	<div class = "zone zone-box zone-white">
		<div class = "title title-h3">
			<h3 class = "title-text">Add an article</h3>
		</div>
		<form action = "/admin" method = "POST">
			Name: <input type = "text" name = "article_name"/><br/>
			Price: <input type = "text" name = "article_price"/><br/>
			Stock: <input type = "text" name = "article_stock"/><br/>
			Description: <br/><textarea name = "article_description"></textarea><br/>
			<br/>
			<input type = "hidden" name = "action" value = "article_add"/>
			<input class = "button" type = "submit" value = "Add"/>
		</form>
	</div>
</div>
