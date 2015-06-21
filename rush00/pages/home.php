<?php
	$articles = db_select('articles');
?>

<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Products</h2>
		<hr/>
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
</div>
