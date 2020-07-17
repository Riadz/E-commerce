<?php
require_once  '../autoload.php';

session_start();

$params = [
	'shipping_address' => htmlspecialchars($_POST['shipping_address'], ENT_QUOTES, 'UTF-8'),
	'payment_method'   => $_POST['payment_method']
];

$articles = [];
foreach ($_SESSION['cart'] as $article) {
	array_push($articles, [
		'article_id'       => $article['article_id'],
		'article_quantity' => $article['article_quantity']
	]);
}

$result = $_SESSION['user']->checkout($params, $articles);

//emptying the cart
$_SESSION['cart'] = [];

header("location: ../../checkout_thankyou?result=$result");
