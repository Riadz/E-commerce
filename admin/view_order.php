<?php
require_once 'php/autoload.php';
require 'php/authentication.php';

use App\AdminUser;

function return_to_orders($flag, $message)
{
	header("location: orders?fn=$flag&fn_message=$message");
	exit;
}
if (!isset($_GET['order_id']))
	return_to_orders('red', 'Order missing input');
elseif (!is_numeric($_GET['order_id']))
	return_to_orders('red', 'Order invalid input');
elseif (!AdminUser::orderExists($_GET['order_id']))
	return_to_orders('red', 'This order dose not exist!');

$order = AdminUser::getOrder($_GET['order_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="../favicon.png" />
	<title>View order</title>

	<link rel="stylesheet" href="../css/general.css" />
	<link rel="stylesheet" href="../css/form.css" />
	<link rel="stylesheet" href="../css/orders.css" />
	<link rel="stylesheet" href="css/admin.css" />
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/jquery/jquery-3.3.1.min.js"></script>
	<style>
		.hidden-cart-table {
			display: block;
		}

		.order-status-form-container,
		.order-status-form {
			display: flex;
			flex-direction: row !important;
			align-items: center;
		}

		.order-status-form>select {
			margin: 0 10px 0 10px !important;
		}

		.order-status-form>button {
			margin: 0 0 0 10px !important;
			padding: 0.5rem 0.8rem !important;
		}
	</style>
</head>

<body>
	<header></header>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<!-- Aside -->
		<?php include('common/aside.php') ?>

		<section>
			<div class="edit-form form-container">
				<!-- info -->
				<div class="order-info-container" colspan="6" style="padding: 0;">
					<table class="hidden-cart-table" id="order-table">
						<caption>
							<h2>Information: </h2>

							<ul>
								<li>Order id: <?= $order['cart_id'] ?></li>
								<li class="order-status-form-container">
									<span>Order status: </span>
									<form action="php/actions/edit_order_status.php" class="order-status-form">
										<input type="hidden" name="order_id" value="<?= $order['cart_id'] ?>">
										<select name="order_status">
											<option value="<?= $order['status'] ?>" selected><?= $order['status'] ?></option>
											<?php
											$status = ['shipping', 'canceled', 'undefined', 'shipped', 'pending'];
											$key = array_search($order['status'], $status);
											unset($status[$key]);
											foreach ($status as $stat) : ?>
												<option value="<?= $stat ?>"><?= $stat ?></option>
											<?php endforeach ?>
										</select>
										<button>Update</button>
									</form>
								</li>
								<li>Order date: <?= $order['cart_date'] ?></li>
								<li>Shipping address: <?= $order['shipping_address'] ?></li>
								<li>Payment method: <?= $order['payment_method'] ?></li>
								<li>Client full name: <?= $order['user_full_name'] ?></li>
								<li>Number of articles: <span><?= $order['articles_count'] ?></span></li>
								<li>Total price: <span><?= $order['cart_total_price'] ?> Da</span></li>
							</ul>
							<h2>Articles: </h2>
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
									<a href="../article?article_id=<?= $article['article_id'] ?>" target="_blank">
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
				</div>
		</section>
	</div>
	<script>
		tinymce.init({
			selector: '.mce-textarea'
		});
	</script>

	<!-- feedback notification -->
	<?php if (isset($_GET['fn'])) : ?>
		<div id="feedback_notification" class="fn-<?= $_GET['fn'] ?>">
			<span><?= $_GET['fn_message'] ?></span>
			<button id="fn-close">X</button>
		</div>
		<script>
			document
				.getElementById('fn-close')
				.addEventListener('click', () => document
					.getElementById('feedback_notification').remove()
				)
		</script>
	<?php endif ?>

	<script>
		//setting how many images u can add
		setImgInputCount(<?= count($images) - 3 ?>);
		checkImgInputCount();
	</script>
</body>

</html>
