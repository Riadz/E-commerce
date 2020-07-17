<?php
require_once  'php/autoload.php';

if (session_status() == PHP_SESSION_NONE)
	session_start();
?>

<head>
	<link rel="stylesheet" href="css/header.css" />
	<script src="js/jquery/jquery-3.3.1.min.js"></script>
	<script src="js/cart.js"></script>
</head>

<body>
	<header>
		<nav>
			<div id="logo">
				<a href="./">
					<img src="img/logo.png" alt="error" />
				</a>
			</div>

			<form method="GET" action="search" id="research">
				<input type="search" name="research_input" minlength="4" placeholder="ex: Keyboard, Headset ..." required />
				<button type="submit">
					<img src="img/search.png" alt="error" />
					<span>Search</span>
				</button>
			</form>

			<ul id="navigation">
				<?php if (!isset($_SESSION['user']->id)) : ?>
					<li class="navigation-item">
						<img src="img/connect.png" alt="image error" />
						<span>Authentication</span>

						<div class="nav-hover-tab" id="connect-nht">
							<a href="login" class="nht-login-button">
								<img src="img/account.png" alt="image error" />
								<span>Log In</span>
							</a>

							<span class="splitter"></span>

							<a href="signup" class="nht-login-button">
								<img src="img/new-account.png" alt="image error" />
								<span>Sign Up</span>
							</a>
						</div>
					</li>
				<?php else : ?>
					<li class="navigation-item">
						<img src="img/connect.png" alt="image error" />
						<span>My Account</span>

						<div class="nav-hover-tab" id="connect-nht">
							<?php if (isset($_SESSION['admin_id'])) : ?>
								<a href="./admin/dashboard" class="nht-login-button" style="margin-bottom: 8px">
									<img src="img/admin.png" alt="image error" />
									<span>Admin Dashboard</span>
								</a>
							<?php endif ?>

							<a href="account" class="nht-login-button" style="margin-bottom: 8px">
								<img src="img/information.png" alt="image error" />
								<span>My Information</span>
							</a>

							<a href="orders" class="nht-login-button">
								<img src="img/shopping-cart.png" alt="image error" />
								<span>My Orders</span>
							</a>

							<span class="splitter"></span>

							<a href="php/actions/logout" class="nht-login-button">
								<img src="img/logout.png" alt="image error" />
								<span>Log Out</span>
							</a>
						</div>
					</li>
				<?php endif ?>
				<li class="navigation-item">
					<img src="img/contact-us.png" alt="image error" />
					<a href="contact-us">
						<span>Contact Us</span>
					</a>
				</li>

				<li class="navigation-item">
					<img src="img/help.png" alt="image error" />
					<a href="about-us">
						<span>About</span>
					</a>
					<div class="nav-hover-tab" id="about-nht">
						<div id="call-us-div">
							<span>
								<img src="img/call-us.png" alt="image error" />
								Call Us
							</span>
							<p>0354879637</p>
						</div>

						<span class="splitter"></span>

						<a href="about-us#de-nous" class="nht-about-button">
							<img src="img/about-us.png" alt="image error" />
							<span>About Us</span>
						</a>
						<a href="about-us#de-la-livrison" class="nht-about-button">
							<img src="img/shipping.png" alt="image error" />
							<span>About Shipping</span>
						</a>
						<a href="about-us#de-du-payment" class="nht-about-button">
							<img src="img/payment.png" alt="image error" />
							<span>About Payment</span>
						</a>

						<span class="splitter"></span>

						<a href="about-us#aide" class="nht-about-button">
							<img src="img/question-mark.png" alt="image error" />
							<span>Help</span>
						</a>
					</div>
				</li>
			</ul>

			<div id="cart-container">
				<button id="cart-button">
					<img src="img/shopping-cart.png" alt="image error" />
				</button>
				<div id="cart">
					<div id="cart-items-container"></div>
					<div id="cart-pay-section"></div>
					<a href="checkout"><button id="pay-button" class="styled-btn">Checkout</button></a>
				</div>
			</div>
		</nav>
	</header>
</body>
