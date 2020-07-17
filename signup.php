<?php
require_once 'php/autoload.php';
session_start();
if (isset($_SESSION['user']->id)) header('location: ./');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>Sign Up</title>
	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/validate_password.js"></script>
</head>

<body style="background-image: url('img/signup-form-background.jpg');">
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<div class="form-container signup-form-container">
			<div class="form-header">
				<img src="img/new-account.png" alt="image error" />
				<h2>Sign Up</h2>
			</div>

			<form name="signup" method="POST" action="php/actions/signup.php">
				<div id="sections-container">
					<div class="section">
						<h3>Mandatory:</h3>
						<input name="first_name" type="text" minlength="2" maxlength="155" placeholder="First Name" required />
						<input name="last_name" type="text" minlength="2" maxlength="155" placeholder="Last Name" required />
						<input name="email" type="email" maxlength="155" placeholder="Email" required />
						<input name="password" type="password" minlength="4" maxlength="155" placeholder="Password" required />
						<input name="password_conf" type="password" placeholder="Confirm Password" required />
					</div>
					<div class="splitter"></div>
					<div class="section">
						<h3>Optional:</h3>
						<input name="address" type="text" maxlength="155" placeholder="Address" />
						<input name="phone_number" type="text" maxlength="155" placeholder="Phone Number" />
						<br /><span>Birth Date</span>
						<input name="birth_date" type="date" min="1950-01-01" max="2002-01-01" />
					</div>
				</div>
				<button type="submit" onclick="validatePassword();">
					<img src="img/create.png" alt="image error" />
					<span>Sign Up</span>
				</button>
			</form>
			<span id="switch_span">Already an account? <a href="login.php">log in here</a></span>
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
