<?php
require_once 'php/authentication.php';
require_once 'php/autoload.php';

use App\AdminUser;

$orders = AdminUser::getAllOrder();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="../favicon.png" />
	<title>Orders</title>

	<link rel="stylesheet" href="../css/general.css" />
	<link rel="stylesheet" href="css/admin.css" />
	<link rel="stylesheet" href="css/table.css" />
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/jquery/jquery-3.3.1.min.js"></script>
	<script src="js/modal.js"></script>
</head>

<body>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<!-- Aside -->
		<?php include('common/aside.php') ?>

		<section>
			<table class="list-table">
				<tr>
					<th>Order Id</th>
					<th>Client Id</th>
					<th>Client Name</th>
					<th>Oder Date</th>
					<th>Articles Count</th>
					<th>Total Price</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
				<?php foreach ($orders as $order) : ?>
					<tr>
						<td><?= $order['cart_id'] ?></td>
						<td><?= $order['user_id'] ?></td>
						<td><?= $order['user_full_name'] ?></td>
						<td><?= $order['cart_date'] ?></td>
						<td><?= $order['articles_count'] ?></td>
						<td><?= $order['total_price'] ?> Da</td>
						<td class="order-status os-<?= $order['status'] ?>"><?= $order['status'] ?></td>
						<td class="list-table-action">
							<a title="View" href="view_order?order_id=<?= $order['cart_id'] ?>" class="styled-btn">
								<img src="img/actions/eye.png">
							</a>
							<button title="Delete" data-id="<?= $order['cart_id'] ?>" data-name="Order N:<?= $order['cart_id'] ?>" class="delete-order styled-btn sb-red">
								<img src="img/actions/delete.png">
							</button>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		</section>
	</div>

	<!-- delete modal -->
	<div id="delete-modal" class="modal">
		<div class="modal-container">
			<button type="button" id="delete-modal-close-btn" class="modal-close-btn">X</button>
			<h2>Are you sure you want to delete this order</h2>
			<h3 id="delete-modal-name"></h3>
			<a id="delete-modal-link" class="styled-btn sb-red">
				Delete
			</a>
		</div>
	</div>

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
</body>

</html>
