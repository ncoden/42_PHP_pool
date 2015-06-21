<?php

// REMOVE FORM
if (isset($_POST['action'])
	&& $_POST['action'] == 'cart_remove')
{
	if (isset($_POST['cart_index']))
	{
		$cart_index = (int)$_POST['cart_index'];
		if (isset($_SESSION['cart'][$cart_index]))
		{
			if ($_SESSION['cart'][$cart_index]['count'] > 1)
				$_SESSION['cart'][$cart_index]['count']--;
			else
				unset($_SESSION['cart'][$cart_index]);
		}
	}
}

// CART AMMOUNT
$cart_ammount = 0;
if (isset($_SESSION['cart']))
{
	foreach ($_SESSION['cart'] as $articles)
		$cart_ammount += $articles['count'] * (int)$articles['article']['price'];
}

// CHECKOUT FORM
$cart_checkout = FALSE;
if (isset($_POST['action'])
	&& $_POST['action'] == 'cart_checkout')
{
	if (!$g_user)
		redirect('/login');

	db_insert('orders', [
		'user' => $g_user['id'],
		'status' => 'PENDING',
	]);
	$order_id = getLastEntry('orders');

	foreach ($_SESSION['cart'] as $articles)
	{
		db_insert('order_articles', [
			'order' => $order_id,
			'article' => $articles['article']['id'],
			'count' => $articles['count'],
			'amount' => $articles['count'] * $articles['article']['price']
		]);
	}

	$_SESSION['cart'] = [];
	$cart_ammount = 0;
	$cart_checkout = TRUE;
}

$cart = NULL;
if (isset($_SESSION['cart'])
	&& is_array($_SESSION['cart'])
	&& !empty($_SESSION['cart']))
	$cart = $_SESSION['cart'];

?>

<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Cart</h2>
		<span class = "align-right">
			<div class = "align-middle">
				Total:
				<span class = "article-price"><?=$cart_ammount?> $ </span>
			</div>
<?php if ($cart) { ?>
			<form class = "align-middle form-inline" action = "/user/cart" method = "POST">
				<input type = "hidden" name = "action" value = "cart_checkout"/>
				<input class = "button button-blue" type = "submit" value = "Checkout"/>
			</form>
<?php } ?>
		</span>
	</div>
</div>
<?php if ($cart) { ?>
<div class = "zone zone-white zone-paddings">
	<div class = "container">
		<div class = "row">
<?php
	foreach ($cart as $articles)
	{
		$article = $articles['article'];
?>
			<div class = "col6 sm-col4 md-col3">
				<div class = "article">
					<a href = "/article/<?=$article['id']?>">
						<img class = "article-picture" src = "/resources/articles/picture.jpeg"/>
					</a>
					<div class = "article-about">
						<div class = "align-middle">
							<a class = "article-name" href = "/article/<?=$article['id']?>"><?=$article['name']?></a>
							<div class = "article-price"><?=$article['price']?> $ (<?=$articles['count']?>)</div>
						</div>
						<form class = "form-inline align-right" action = "/user/cart" method = "POST">
							<input type = "hidden" name = "action" value = "cart_remove"/>
							<input type = "hidden" name = "cart_index" value = "<?=$article['id']?>"/>
							<input class = "button" type = "submit" value = "Remove"/>
						</form>
					</div>
				</div>
			</div>
<?php } ?>
		</div>
	</div>
</div>
<?php } else { ?>
<div class = "container">
	<div class = "zone zone-box zone-white">
		<center>
<?php if ($cart_checkout) { ?>
			Successful purchase<br/>
			<br/>
			<a class = "button" href = "/">Return to shop</a>
			<a class = "button button-blue" href = "/user/purchases">View my purchases</a>
<?php } else { ?>
			There is no articles in your cart
			<a class = "button button-blue" href = "/">See the shop</a>
<?php } ?>
		<center>
	</div>
</div>
<?php } ?>
