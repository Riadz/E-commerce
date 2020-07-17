<?php
if (isset($_POST['article_id'])) {
	require 'database.php';
	session_start();

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}

	$article_id = mysqli_real_escape_string($sql, $_POST['article_id']);

	$result = $sql->query(
		"SELECT `article_name`,`price`,`discount`,`stock`
		 FROM `article`
		 WHERE `article_id` =" . $article_id
	) or die($sql->error);

	if ($data = mysqli_fetch_row($result)) {
		for ($i = 0; $i < count($_SESSION['cart']); $i++) {
			if ($_SESSION['cart'][$i]['article_id'] == $article_id) {
				$_SESSION['cart'][$i]['article_quantity'] += $_POST['article_quantity'];
				if ($_SESSION['cart'][$i]['article_quantity'] > $data[3]) $_SESSION['cart'][$i]['article_quantity'] = $data[3];
				return;
			}
		}

		//image
		$files = scandir('../img/article/' . $article_id);
		$thumbnail_src = "img/article/" . $article_id . "/" . $files[count($files) - 1];

		//price
		$price;
		if ($data[2] != '') {
			$price = $data[1] - ($data[1] * $data[2]);
		} else $price = $data[1];

		$article_quantity = ($_POST['article_quantity'] < $data[3] ? $_POST['article_quantity'] : $data[3]);

		array_push(
			$_SESSION['cart'],
			array(
				'article_id'           => $article_id,
				'article_name'         => $data[0],
				'price'                => $price,
				'article_quantity'     => $article_quantity,
				'thumbnail_src'        => $thumbnail_src,
				'article_max_quantity' => $data[3]
			)
		);
	} else echo 'false';
} else echo 'false';
