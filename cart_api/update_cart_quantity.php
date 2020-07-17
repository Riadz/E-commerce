<?php
session_start();

if (isset($_SESSION['cart'])) {
	require 'database.php';

	$article_id = mysqli_real_escape_string($sql, $_POST['article_id']);
	$article_quantity = mysqli_real_escape_string($sql, $_POST['article_quantity']);

	$result =
		$sql->query(
			"SELECT `stock` FROM `article`
			 WHERE `article_id` =" . $article_id
		) or die($sql->error);
	$data = mysqli_fetch_row($result);

	for ($i = 0; $i < count($_SESSION['cart']); $i++)
		if ($_SESSION['cart'][$i]['article_id'] == $article_id) {

			if ($article_quantity <= $data[0])
				$_SESSION['cart'][$i]['article_quantity'] = $article_quantity;

			return;
		}
}
