<?php
require_once 'php/authentication.php';
require_once 'php/autoload.php';

use App\Admin;

[$months, $revenue] = Admin::getYearRevenueArray();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="../favicon.png" />
	<title>Dashboard</title>

	<link rel="stylesheet" href="../css/general.css" />
	<link rel="stylesheet" href="css/admin.css" />

	<!-- Chart.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</head>

<body>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<!-- Aside -->
		<?php include('common/aside.php') ?>

		<section id="dashboard">
			<div id="dashboard-icons">
				<div class="dashboard-icon di-red">
					<div class="dashboard-icon-img">
						<img src="img/icons/account.png">
					</div>
					<div class="dashboard-icon-content">
						<span class="dashboard-icon-title">Users</span>
						<span class="dashboard-icon-value"><?= Admin::getUsersCount() ?></span>
					</div>
				</div>
				<div class="dashboard-icon di-green">
					<div class="dashboard-icon-img">
						<img src="img/icons/shopping-cart.png">
					</div>
					<div class="dashboard-icon-content">
						<span class="dashboard-icon-title">Orders</span>
						<span class="dashboard-icon-value"><?= Admin::getUsersOrdersCount() ?></span>
					</div>
				</div>
				<div class="dashboard-icon di-blue">
					<div class="dashboard-icon-img">
						<img src="img/icons/money.png">
					</div>
					<div class="dashboard-icon-content">
						<span class="dashboard-icon-title">Total</span>
						<span class="dashboard-icon-value" style="font-size: 1rem;margin-top:20px">
							<?= Admin::getTotalRevenue() ?> DA
						</span>
					</div>
				</div>
			</div>
			<div id="dashboard-chart">
				<canvas id="dashboard-chart-canvas"></canvas>
				<script>
					let dChart = document.getElementById('dashboard-chart-canvas').getContext('2d');

					let chartOptions = {
						type: 'line',
						data: {
							labels: [<?= implode(',', $months) ?>],
							datasets: [{
								data: [<?= implode(',', $revenue) ?>],
								backgroundColor: '#22a7f033',
							}]
						},
						options: {
							title: {
								display: true,
								text: 'This Year\'s Revenue (DA)',
								fontSize: 25
							},
							legend: {
								display: false
							},
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					}

					let lineChart = new Chart(dChart, chartOptions);
				</script>
			</div>
		</section>
	</div>
</body>

</html>
