<?php

$article = NULL;
$article_bought = FALSE;

// GET ARTICLE
if (isset($g_path)
	&& isset($g_path[1]))
{
	if ($results = db_select('articles', ['id' => (int)$g_path[1]]))
	{
		if (isset($results[0]))
			$article = $results[0];
	}
}

if (!$article)
	redirect('/');


// GET CATEGORIES
$categories = db_exec(
	'SELECT * FROM articles_categories
	JOIN categories ON articles_categories.category = categories.id
	WHERE articles_categories.article = ?',
	[$article['id']]
);

// BUY FORM
if (isset($_POST)
	&& isset($_POST['action'])
	&& $_POST['action'] == 'buy')
{
	if (!isset($_SESSION['cart']))
		$_SESSION['cart'] = [];
	if (!isset($_SESSION['cart'][$article['id']]))
	{
		$_SESSION['cart'][$article['id']] = [
			'count' => 1,
			'article' => $article
		];
	}
	else
		$_SESSION['cart'][$article['id']]['count']++;
	$article_bought = TRUE;
}

?>
<div class = "zone zone-white">
	<div class = "container">
		<div class = "title title-h2">
			<h2 class = "title-text"><?=$article['name']?></h2>
<?php foreach ($categories as $category) { ?>
	<a class = "tag" href = "/category/<?=$category['id']?>"><?=$category['name']?></a>
<?php } ?>
			<div class = "align-right">
<?php if ($article_bought) { ?>
				Article added to cart <a class = "button" href = "/user/cart">View my cart</a>
<?php } ?>
<?php if ($article['stock'] > 0) { ?>
				<form class = "form-inline" action = "/article/<?=$article['id']?>" method = "POST">
					<input type = "hidden" name = "action" value = "buy"/>
					<input class = "button button-blue" type = "submit" value = "Buy"/>
				</form>
<?php } else { ?>
				Out of stock
<?php } ?>
			</div>
			<hr/>
		</div>
		<div class = "row">
			<div class = "col4">
				<img class = "article-picture" src = "/resources/articles/picture.jpeg"/>
			</div>
			<div class = "col8">
				<div class = "title title-h3">
					<h3 class = "title-text">About</h3>
				</div>
				<?=$article['description']?>
			</div>
		</div>
	</div>
</div>
