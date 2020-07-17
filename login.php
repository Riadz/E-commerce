<?php
require_once 'php/autoload.php';
session_start();
if (isset($_SESSION['user']->id)) header('location: ./')
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>Log In</title>
	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/form.css" />
</head>

<body style="background-image: url('img/login-form-background.jpg');">
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<div class="form-container login-form-container">
			<div class="form-header">
				<img src="img/account.png" alt="image error" />
				<h2>Log In</h2>
			</div>

			<form name="login" method="POST" action="php/actions/login.php">
				<input name="email" type="text" placeholder="Email" required />
				<input name="password" type="password" placeholder="Password" required />
				<button type="submit">
					<img src="img/login.png" alt="image error" />
					<span>Log In</span>
				</button>
			</form>
			<span id="switch_span">No account ? <a href="signup.php">create one here</a></span>
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
