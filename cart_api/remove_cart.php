<?php
if (isset($_POST['article_id'])) {
	session_start();
	for ($i = 0; $i < count($_SESSION['cart']); $i++)
		if ($_SESSION['cart'][$i]['article_id'] == $_POST['article_id']) {
			\array_splice($_SESSION['cart'], $i, 1);
			return;
		}
} else echo 'false';
