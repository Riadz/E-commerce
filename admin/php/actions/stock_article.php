<?php
require_once 'auth.php';
require_once '../autoload_actions.php';

use App\AdminArticle;

$Article = AdminArticle::make();

if (!isset($_GET['article_id']) || !isset($_GET['stock']))
	return_to_articles('red', 'Stock not updated, missing input');
elseif (!is_numeric($_GET['article_id']) || !is_numeric($_GET['stock']))
	return_to_articles('red', 'Stock not updated, invalid input');
elseif (!$Article->articleExists($_GET['article_id']))
	return_to_articles('red', 'Stock not updated, article dose not exist!');

//updating in database
$result = $Article->stockArticle($_GET['article_id'], $_GET['stock']);

if ($result)
	return_to_articles('green', 'Stock updated successfully');
else
	return_to_articles('red', 'Stock not updated, unexpected error');

function return_to_articles($flag, $message)
{
	header("location: ../../articles?fn=$flag&fn_message=$message");
	exit;
}
