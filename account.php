<?php
require_once 'php/autoload.php';
session_start();
if (!isset($_SESSION['user']->id)) header('location: ./');

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
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/validate_password.js"></script>

	<style>
		.form-container {
			box-shadow: none;
			width: 100%;
			margin: 0;
			padding: 0;
		}

		.form-container button[type='submit'] {
			width: 50%;
			margin-top: 2rem;
		}
	</style>
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
					<div class="form-container">
						<!-- info -->
						<form method="POST" action="php/actions/update_info.php">
							<div class="form-header">
								<img src="img/account.png" alt="image error" />
								<h2>My Information</h2>
							</div>
							<div id="sections-container">
								<div class="section">
									<br /><span>First name</span>
									<input value="<?= $_SESSION['user']->first_name ?>" name="first_name" type="text" minlength="2" maxlength="155" required />
									<br /><span>Last name</span>
									<input value="<?= $_SESSION['user']->last_name ?>" name="last_name" type="text" minlength="2" maxlength="155" required />
									<br /><span>Email</span>
									<input style="height: 42px;" value="<?= $_SESSION['user']->email ?>" name="email" type="email" maxlength="155" required />
								</div>
								<div class="splitter"></div>
								<div class="section">
									<br /><span>Address</span>
									<input value="<?= $_SESSION['user']->address ?>" name="address" type="text" maxlength="155" />
									<br /><span>Phone number</span>
									<input value="<?= $_SESSION['user']->phone_number ?>" name="phone_number" type="text" maxlength="155" />
									<br /><span>Birth date</span>
									<input value="<?= $_SESSION['user']->birth_date ?>" name="birth_date" type="date" min="1950-01-01" max="2002-01-01" />
								</div>
							</div>
							<button type="submit" class="styled-btn">
								<span>Update Information</span>
							</button>
						</form>
						<hr>
						<!-- password -->
						<form method="POST" action="php/actions/update_password.php">
							<div class="form-header">
								<h2>My Password</h2>
							</div>
							<div id="sections-container" style="width: 50%;">
								<div class="section" style="width: 100%;">
									<br /><span>Old password</span>
									<input name="old_password" type="password" minlength="4" maxlength="155" required />
									<br /><span>New password</span>
									<input name="password" type="password" minlength="4" maxlength="155" required />
									<br /><span>Re-enter new password</span>
									<input name="password_conf" type="password" required />
								</div>
							</div>
							<button type="submit" class="styled-btn" onclick="validatePassword();">
								<span>Change password</span>
							</button>
						</form>
					</div>
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

	<!-- Footer -->
	<?php include('common/footer.php') ?>
</body>

</html>
