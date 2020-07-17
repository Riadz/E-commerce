<?php

namespace App;

require_once  '../autoload.php';

use App\ArticleReview;
use App\Article;

$Article = Article::make();
$ArticleReview = ArticleReview::make();

session_start();
if (!isset($_SESSION['user']->id)) return_to_index();

$params = [
	'article_id'            => '',
	'article_review_rating' => '',
	'article_review_title'  => '',
	'article_review_body'   => ''
];

// check if everything is passed and assigning to params
foreach ($params as $key => $__) {
	if (!isset($_POST[$key])) return_to_index();
	else $params[$key] = $_POST[$key];
}

// validate input
foreach ($params as $param) {
	if (empty($param)) return_to_index();
}
if (
	$params['article_review_rating'] > 5
	|| $params['article_review_rating'] < 0
) return_to_index();

// check if the article exists
if (!is_numeric($params['article_id']))
	return_to_index();
$article_exists = $Article->articleExists(
	(int) $params['article_id']
);

//escaping input (prevent XSS)
$to_escape = [
	'article_review_title',
	'article_review_body'
];
foreach ($to_escape as $value)
	$params[$value] = htmlspecialchars($params[$value], ENT_QUOTES, 'UTF-8');

//create review if article exits
if ($article_exists) {
	$params['user_id'] = $_SESSION['user']->id;

	$result = $ArticleReview->createArticleReview(
		$params
	);

	goToThankYouPage($result, $params['article_id']);
} else
	return_to_index();

function return_to_index()
{
	header('location: ../../');
}
function goToThankYouPage($result, $article_id)
{
	header("location: ../../article_review_thankyou?result=$result&article_id=$article_id");
}
