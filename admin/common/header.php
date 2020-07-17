<?php
require_once  'php/autoload.php';

if (session_status() == PHP_SESSION_NONE)
	session_start();
?>

<header id="header">
	<div id="header-avatar">
		<img src="../img/connect.png">
		<span>
			<?= $_SESSION['user']->first_name ?> <?= $_SESSION['user']->last_name ?>
		</span>
	</div>
	<a id="header-return" href="../">
		Go back to store
	</a>
</header>

<style>
	#header {
		display: flex;
		justify-content: space-between;

		max-width: 1175px;
		min-width: 760px;
		margin: 15px auto 0;
		padding: 5px;

		background-color: #fff;
		border-radius: 4px;
	}

	#header-avatar {
		display: flex;
		align-items: center;
	}

	#header-avatar img {
		height: 38px;

		margin-right: 5px;
	}

	#header-avatar span {
		font-size: 2rem;
		font-weight: 300;
	}

	#header-return {
		padding: 0.25rem 0.5rem;
		margin: 5px;

		color: var(--color-2);
		border: 2px solid var(--color-2);
		border-radius: 4px;
		font-weight: 500;

		transition: background-color 0.3s ease;
	}

	#header-return:hover {
		color: #fff;
		background-color: var(--color-2);
	}
</style>
