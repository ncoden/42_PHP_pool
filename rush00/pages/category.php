<?php

$category = NULL;

// GET CATEGORY
if (isset($g_path)
	&& isset($g_path[1]))
{
	if ($results = db_select('categories', ['id' => (int)$g_path[1]]))
	{
		if (isset($results[0]))
			$category = $results[0];
	}
}

if (!$category)
	redirect('/404');


// GET ARTICLES
$articles = db_exec(
	'SELECT * FROM articles_categories
	JOIN articles ON articles_categories.article = articles.id
	WHERE articles_categories.category = ?',
	[$category['id']]
);

?>
<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">
			Category
			<a class = "tag" href = "/category/<?=$category['id']?>"><?=$category['name']?></a>
		</h2>
		<hr/>
	</div>
<?php if (!empty($articles)) { ?>
	<div class = "row">
<?php
	foreach ($articles as $article)
	{
?>
		<div class = "col6 sm-col4 md-col3">
			<div class = "article">
				<a href = "/article/<?=$article['id']?>">
					<img class = "article-picture" src = "/resources/articles/picture.jpeg"/>
				</a>
				<div class = "article-about">
					<div class = "align-middle">
						<a class = "article-name" href = "/article/<?=$article['id']?>"><?=$article['name']?></a>
						<div class = "article-price"><?=$article['price']?> $</div>
					</div>
<?php if ($article['stock'] > 0) { ?>
					<a class = "button button-blue align-right" href = "/article/<?=$article['id']?>">Buy</a>
<?php } else { ?>
					<span class = "align-right txt-sub">Out of stock</span>
<?php } ?>
				</div>
			</div>
		</div>
<?php } ?>
	</div>
<?php } else { ?>
	<div class = "zone zone-box zone-white">
		<center>
			There is no articles in this category
			<a class = "button button-blue" href = "/">Back to the shop</a>
		<center>
	</div>
<?php } ?>
</div>
