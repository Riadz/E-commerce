<?php
require_once 'auth.php';
require_once '../autoload_actions.php';

use App\AdminArticle;

$Article = AdminArticle::make();

//mandatory data
$params = [
	'article_id'      => '',
	'article_name'    => '',
	'stock'           => '',
	'price'           => '',
	'brand'           => '',
	'sub_category_id' => '',
	'description'     => '',
	'characteristics' => ''
];
foreach ($params as $key => $__) {
	if (empty($_POST[$key]))
		return_to_add_article('red', "Article not created, missing input: $key");
	else
		$params[$key] = $_POST[$key];
}

//discount
$params['discount']
	= isset($_POST['on_discount_checkbox'])
	? $_POST['discount'] / 100
	: null;

//new
$params['new']
	= isset($_POST['new'])
	? '1'
	: '0';

//updating in database
$result = $Article->updateArticle($params);

//updating images
if ($result) {
	$article_dir = "../../../img/article/{$_POST['article_id']}/";
	$files = scandir($article_dir);

	//updating thumbnail
	if ($_FILES["thumbnail"]["name"] != '') {

		//deleting old thumbnail
		$old_thumbnail = $article_dir . $files[count($files) - 1];
		unlink($old_thumbnail);

		//uploading new thumbnail
		$image_uploaded = $article_dir . basename($_FILES["thumbnail"]["name"]);
		$image_type = strtolower(pathinfo($image_uploaded, PATHINFO_EXTENSION));

		$new_thumbnail = $article_dir . 'thumbnail.' . $image_type;
		move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $new_thumbnail);
	}

	//updating other images
	for ($i = 1; $i <= 6; $i++) {
		if (isset($_POST["delete_img_$i"])) {
			$img_to_delete = $article_dir . $i . '.*';
			array_map('unlink', glob($img_to_delete));
		} elseif (isset($_FILES["image_$i"]) && $_FILES["image_$i"]['name'] != '') {
			//deleting img if it already exists
			for ($j = 2; $j < count($files) - 1; $j++)
				if (substr($files[$j], 0, 1) == $i)
					unlink($article_dir . $files[$j]);

			//uploading new img
			$image_uploaded = $article_dir . basename($_FILES["image_$i"]['name']);
			$image_type = strtolower(pathinfo($image_uploaded, PATHINFO_EXTENSION));

			$image = $article_dir . $i . '.' . $image_type;

			move_uploaded_file($_FILES["image_$i"]['tmp_name'], $image);
		}
	}
	//renaming new imgs in order
	$files = scandir($article_dir);
	$i = 0;
	for ($j = 2; $j < count($files) - 1; $j++) {
		$i++;
		rename(
			$article_dir . $files[$j],
			$article_dir . $i . substr($files[$j], 1, strlen($files[$j]))
		);
	}

	header("location: ../../edit_article?article_id={$_POST['article_id']}&fn=green&fn_message=Article updated successfully");
	exit;
};

header("location: ../../edit_article?article_id={$_POST['article_id']}&fn=red&fn_message=Article not updated");

function return_to_add_article($flag, $message)
{
	header("location: location: ../../articles");
	exit;
}
