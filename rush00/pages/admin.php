<?php

if (!isset($g_user)
	|| !$g_user
	|| $g_user['type'] != 'admin')
	redirect('/');

$orders = db_exec(
	'SELECT * FROM orders
	WHERE user = ?
	AND status = "PENDING"
	ORDER BY date_order DESC',
	[$g_user['id']]
);

?>
<div class = "container">
	<div class = "title title-h2">
		<h2 class = "title-text">Admin Panel</h2>
		<span class = "align-right">
			<a class = "button button-blue" href = "/logout">Logout</a>
		</span>
	</div>

	<div class = "zone zone-box zone-white">
		<div class = "title title-h3">
			<h3 class = "title-text">Pending orders (<?=count($orders)?>)</h3>
		</div>
		<div class = "table strip">
			<table>
				<thead>
					<th>Date</th>
					<th>Articles</th>
					<th>Count</th>
					<th>Amount</th>
					<th>Action</th>
				</thead>
				<tbody>
<?php

foreach ($orders as $order)
{
	if ($articles = db_exec(
		'SELECT * FROM order_articles
		JOIN articles ON order_articles.article = articles.id
		WHERE order_articles.order = ?',
		[$order['id']]
	))
	{
		$amount = 0;
		foreach ($articles as $article)
			$amount += $article['amount'];
?>
					<tr>
						<td><?=$order['date_order']?></td>
						<td>
<?php foreach ($articles as $article) { ?>
							<?=$article['name']?><br/>
<?php } ?>
						</td>
						<td>
<?php foreach ($articles as $article) { ?>
							<?=$article['count']?><br/>
<?php } ?>
						</td>
						<td><?=$amount?> $</td>
						<td><a class = "button">Done</a></td>
					</tr>
<?php
	}
}
?>
				</tbody>
			</table>
		</div>
	</div>

	<div class = "zone zone-box zone-white">
		<div class = "title title-h3">
			<h3 class = "title-text">Articles</h3>
<?php
	if ($result = db_exec('SELECT COUNT(id) FROM articles WHERE stock = 0'))
	{
		if (isset($result[0]))
		{
			$out_of_stock = $result[0]['COUNT(id)'];
?>
			<span class = "align-right"><?=$out_of_stock?> articles are out of stock</span>
<?php
		}
	}
?>
		</div>
		<center>
			<a class = "button button-blue" href = "/admin/articles">Manage articles</a>
		</center>
	</div>
</div>