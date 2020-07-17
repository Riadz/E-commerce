<?php
require_once 'php/autoload.php';
require 'php/authentication.php';
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
		.main {
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.main h1 {
			font-size: 3.2rem;
		}

		.main p {
			font-size: 2rem;
		}

		.main a {
			color: var(--color-2);
		}

		.main a:hover {
			color: var(--color-3);
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

		<section class="main">
			<div>
				<h1>Sorry i never got to finish this part ✋</h1>
				<br>
				<p>want to see more of my work ? <a target="_blank" href="https://rebrand.ly/riad-hachemane-portfolio">you can find me here</a></p>
			</div>
		</section>
	</div>
</body>

</html>
