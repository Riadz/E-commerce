<?php
require_once 'php/autoload.php';
session_start();
if (!isset($_SESSION['user']->id)) header('location: ./');

$orders = $_SESSION['user']->getOrders();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>RTECH For Tech Materials</title>

	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/aside.css">
	<link rel="stylesheet" href="css/article.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/orders.css">
</head>

<body>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<main>
		<div id="main-container">
			<aside>
				<?php include 'common/aside.php' ?>
			</aside>
			<div>
				<section style="min-height: 789px;">
					<?php if ($orders) : ?>
						<table id="order-table">
							<caption>
								<h1>Your orders</h1>
							</caption>
							<tr>
								<th>Order id</th>
								<th>Order date</th>
								<th>Payment method</th>
								<th>Total price</th>
								<th>Shipping address</th>
								<th>Action</th>
							</tr>
							<?php foreach ($orders as $order) : ?>
								<tr>
									<td><?= $order['cart_id'] ?></td>
									<td><?= $order['cart_date'] ?></td>
									<td><?= $order['payment_method'] ?></td>
									<td><?= $order['cart_total_price'] ?> DA</td>
									<td><?= $order['shipping_address'] ?></td>
									<td style="text-align: center;">
										<span class="display-link" data-target="#cart-info-<?= $order['cart_id'] ?>">View details</span>
									</td>
								</tr>
								<tr>
									<td class="order-info-container" colspan="6" style="padding: 0;">
										<table class="hidden-cart-table" id="cart-info-<?= $order['cart_id'] ?>">
											<caption>
												<ul>
													<li>Order status: <span class="order-status os-<?= $order['status'] ?>"><?= $order['status'] ?></li>
													<li>Number of articles: <span><?= $order['articles_count'] ?></span></li>
													<li>Expected receive date: <span><?= date("Y-m-d", strtotime("+7 Days", strtotime($order['cart_date']))) ?></span></li>
												</ul>
											</caption>
											<tr>
												<th>Id</th>
												<th>Image</th>
												<th>Name</th>
												<th>Price</th>
												<th>Discount</th>
												<th>Quantity</th>
												<th>Total price</th>
											</tr>
											<?php foreach ($order['articles'] as $article) : ?>
												<tr>
													<td><?= $article['article_id'] ?></td>
													<td><img src="<?= $article['thumbnail_src'] ?>" /></td>
													<td>
														<a href="article?article_id=<?= $article['article_id'] ?>" target="_blank">
															<?= $article['article_name'] ?>
														</a>
													</td>
													<td><?= $article['price'] ?> DA</td>
													<td><?= $article['current_discount'] ? "-{$article['current_discount']}%" : 'none' ?></td>
													<td><?= $article['article_quantity'] ?></td>
													<td><?= $article['article_total_price'] ?> DA</td>
												</tr>
											<?php endforeach ?>
											<tr>
												<td colspan="5" style="border: 0;"></td>
												<td>Shipping fee: </td>
												<td><?= $order['articles_count'] * 100 ?> DA</td>
											</tr>
											<tr>
												<td colspan="5" style="border: 0;"></td>
												<td>Total: </td>
												<td><?= $order['cart_total_price'] ?> DA</td>
											</tr>
											<tr>
												<td style="border: 0;">
													<button class="styled-btn" style="margin: 0; white-space: nowrap;">Print Order</button>
												</td>
												<td colspan="6" style="border: 0;"></td>
											</tr>
										</table>
									</td>
								</tr>
							<?php endforeach ?>
						</table>
					<?php else : ?>
						<style>
							.order-empty {
								display: flex;
								flex-direction: column;
								align-items: center;
								justify-content: center;
								height: 80vh;
								width: 100%;
								background-color: var(--color-1);
							}

							.order-empty h1 {
								font-size: 3rem;
								font-weight: 300;
								margin-bottom: 100px;
								text-align: center;
							}

							.order-empty a {
								width: 50%;
							}
						</style>
						<div class="order-empty">
							<h1>
								You don't have any orders
								<br>
								Go to the store and order some articles
							</h1>
							<p>
								this is a demo site you can order anything for testing,<br>
								you can leave a review on articles you bought before,<br>
								please don't post anything unethical, illegal, or immoral
							</p>
							<a href="./" class="styled-btn">
								Return To Store
							</a>
						</div>
					<?php endif ?>
				</section>
				<!-- galaxy s9 special offer -->
				<section id="s9-special-offer" class="special-offer">
					<div class="special-offer-img">
						<img src="img/special_offers/s9_special_offer.png" alt="">
					</div>
					<div class="special-offer-text">
						<h2>Galaxy S9</h2>
						<p>
							With a camera that works like your eye.
						</p>
						<a href="article?article_id=51" class="styled-btn">
							ORDER NOW
						</a>
					</div>
				</section>
				<!-- airpods special offer -->
				<section id="airpods-special-offer" class="special-offer">
					<div class="special-offer-text">
						<h2>AirPods Pro</h2>
						<p>
							AirPods deliver effortless, all-day audio on the go.
						</p>
						<a href="article?article_id=1" class="styled-btn">
							ORDER NOW
						</a>
					</div>
					<div class="special-offer-img">
						<img src="img/special_offers/airpods_special_offer.png" alt="">
					</div>
				</section>
			</div>
		</div>
	</main>
	<script>
		$('.display-link').on("click", function(e) {
			let target = e.target.dataset.target;
			$('.hidden-cart-table').hide();
			$(target).show();
		});
	</script>

	<!-- Footer -->
	<?php include('common/footer.php') ?>
</body>

</html>
