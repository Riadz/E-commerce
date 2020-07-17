<?php
require_once 'php/autoload.php';
session_start();
if (!isset($_SESSION['user']->id)) header('location: ./');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>Checkout</title>
	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/checkout.css">
	<link rel="stylesheet" href="css/header.css" />
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/jquery/jquery-3.3.1.min.js"></script>
	<script src="js/cart.js"></script>
	<script>
		$(function() {
			var currentTab = 'cart-checkout';

			$('.nav-button').click(function() {
				nextTab = $(this).attr('val');

				if ($(this).attr('multiNav') == '1')
					nextTab += '-' + $('input[name="payment_cb"]:checked').attr('value');

				$('#' + currentTab).slideUp('medium', function() {
					$('#' + nextTab).slideDown('medium');
				});

				currentTab = nextTab;
			});
		});
	</script>
</head>

<body style="background-image: url('img/checkout-form-background.jpg');">

	<div id="main-container">
		<div class="form-container">
			<div class="form-header">
				<img src="img/payment.png" alt="image error" />
				<h2>Checkout</h2>
			</div>
			<div id="cart-checkout">
				<h1>Cart Content</h1>

				<div id="cart-items-container"></div>
				<div id="cart-pay-section"></div>
				<button val="payment-method" class="nav-button styled-btn sb-green">Continue</button>
			</div>

			<div id="payment-method" style="display: none;">
				<h1>Payment Method</h1>

				<div class="payment-method-tab">
					<div class="payment-method-tab-check">
						<input type="radio" name="payment_cb" value="CC" checked>
						<img src="img/credit-card.png">
						<h2>Credit Cart</h2>
					</div>
					<p>Pay using your credit card like Visa card or Master card</p>
				</div>
				<div class="payment-method-tab">
					<div class="payment-method-tab-check">
						<input type="radio" name="payment_cb" value="CCP">
						<img src="img/paypal-card.png">
						<h2>PayPal</h2>
					</div>
					<p>Pay using your PayPal account</p>
				</div>
				<div class="payment-method-tab" style="border: 0;">
					<div class="payment-method-tab-check">
						<input type="radio" name="payment_cb" value="LIV">
						<img src="img/shipping.png">
						<h2>Payment on delivery</h2>
					</div>
					<p>Pay hand-to-hand with our agent on delivery</p>
				</div>

				<div class="double-button-container">
					<button val="cart-checkout" class="nav-button styled-btn sb-red">Back</button>
					<button val="payment-method" multiNav="1" class="nav-button styled-btn sb-green">Continue</button>
				</div>
			</div>

			<!-- Payment methods -->
			<div id="payment-method-CC" style="display: none;">
				<form class="payment-method-form" action="php/actions/checkout.php" method="post">
					<span>Card number</span>
					<input type="text" placeholder="XXXXXXXXX" minlength="5" maxlength="10">

					<span>Expiration date</span>
					<input type="text" placeholder="MM/YY" pattern="[0-9]{1,2}/[0-9]{1,2}">

					<span>CVC code</span>
					<input type="text" placeholder="XXXX" size="4" minlength="4" maxlength="4">

					<span>Shipping address</span>
					<input name="shipping_address" value="<?= $_SESSION['user']->address ?>" type="text" minlength="5" required>

					<div class="double-button-container">
						<button type="button" val="payment-method" class="nav-button styled-btn sb-red">Back</button>
						<button type="submit" name="payment_method" value="credit_card" class="styled-btn sb-green">Continue</button>
					</div>
					<div class="notice-div">
						Payment gets handled here.<br><br>
						This is just a demo site don't enter any real data,
						the payment will succeed no mater the input<br><br>
						This site was made by<br> <a href="https://rebrand.ly/riad-hachemane-portfolio" target="_blank">Riad Hachemane</a>
					</div>
				</form>
			</div>
			<div id="payment-method-CCP" style="display: none;">
				<form class="payment-method-form" action="php/actions/checkout.php" method="post">
					<span>PayPal payment gets handled here ...</span><br>
					<span>Shipping address</span>
					<input name="shipping_address" type="text" value="<?= $_SESSION['user']->address ?>" minlength="5" required>

					<div class="double-button-container">
						<button type="button" val="payment-method" class="nav-button styled-btn sb-red">Back</button>
						<button type="submit" name="payment_method" value="paypal" class="styled-btn sb-green">Continue</button>
					</div>

					<div class="notice-div">
						Payment gets handled here.<br><br>
						This is just a demo site don't enter any real data,
						the payment will succeed no mater the input<br><br>
						This site was made by<br> <a href="https://rebrand.ly/riad-hachemane-portfolio" target="_blank">Riad Hachemane</a>
					</div>
				</form>
			</div>
			<div id="payment-method-LIV" style="display: none;">
				<form class="payment-method-form" action="php/actions/checkout.php" method="post">
					<span>Shipping address</span>
					<input name="shipping_address" type="text" value="<?= $_SESSION['user']->address ?>" minlength="5" required>

					<div class="double-button-container">
						<button type="button" val="payment-method" class="nav-button styled-btn sb-red">Back</button>
						<button type="submit" name="payment_method" value="on_delivery" class="styled-btn sb-green">Continue</button>
					</div>

					<div class="notice-div">
						Payment gets handled here.<br><br>
						This is just a demo site don't enter any real data,
						the payment will succeed no mater the input<br><br>
						This site was made by<br> <a href="https://rebrand.ly/riad-hachemane-portfolio" target="_blank">Riad Hachemane</a>
					</div>
				</form>
			</div>

			<div id="payment-end" style="display: none;">
				<h2>Payment Effectuer Avec Success ! </h2>
				<br>
				<a href="index.php"><button style="width: 100%" class="nav-button styled-btn">Back au store</button></a>
			</div>
			<span id="switch_span"><a href="index.php">Go back to store</a></span>
		</div>
	</div>

	<footer></footer>
</body>

</html>
