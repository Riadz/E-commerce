<?php
require_once 'auth.php';
require_once '../autoload_actions.php';

use App\AdminArticle;

$Article = AdminArticle::make();


if (!isset($_GET['article_id']))
	return_to_articles('red', 'Article not deleted, missing input');
elseif (!is_numeric($_GET['article_id']))
	return_to_articles('red', 'Article not deleted, invalid input');
elseif (!$Article->articleExists($_GET['article_id']))
	return_to_articles('red', 'Article not deleted, this article dose not exist!');

//deleting the article in the database
$result = $Article->deleteArticle($_GET['article_id']);

//if deleted in database, deleting article images
if ($result) {
	delete_files("../../../img/article/{$_GET['article_id']}");
	return_to_articles('green', 'Article deleted successfully');
} else
	return_to_articles('green', 'Article not deleted, unexpected error');


function return_to_articles($flag, $message)
{
	header("location: ../../articles?fn=$flag&fn_message=$message");
	exit;
}
//php delete function that deals with directories recursively
function delete_files($target)
{
	if (is_dir($target)) {
		$files = glob($target . '*', GLOB_MARK);

		foreach ($files as $file) {
			delete_files($file);
		}

		rmdir($target);
	} elseif (is_file($target)) {
		unlink($target);
	}
}
