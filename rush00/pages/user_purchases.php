<?php

if (!$g_user)
	redirect('/login');

$purchases = db_exec(
	'SELECT * FROM orders
	WHERE user = ?
	ORDER BY date_order DESC',
	[$g_user['id']]
);

?>

<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Purchases</h2>
	</div>
</div>

<div class = "container">
<?php

if (!empty($purchases))
{
	foreach ($purchases as $purchase)
	{
		if ($articles = db_exec(
			'SELECT * FROM order_articles
			JOIN articles ON order_articles.article = articles.id
			WHERE order_articles.order = ?',
			[$purchase['id']]
		))
		{
?>
	<?=$purchase['date_order']?>
	<span class = "align-right"><?=$purchase['status']?></span>
	<hr/>
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
						<div class = "article-price"><?=$article['price']?> $ (<?=$article['count']?>)</div>
					</div>
				</div>
			</div>
		</div>
<?php	} ?>
	</div>
	<br/>
	<br/>
<?php
		}
	}
} else {
?>
	<div class = "zone zone-box zone-white">
		<center>
			You didn't purchased anything
			<a class = "button" href = "/">See the shop</a>
			<a class = "button button-blue" href = "/user/account">Back to account</a>
		</center>
	</div>
<?php } ?>
</div>
