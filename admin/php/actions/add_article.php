<?php
require_once 'auth.php';
require_once '../autoload_actions.php';

use App\AdminArticle;

$Article = AdminArticle::make();

//mandatory data
$params = [
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
	? true
	: false;

//adding in database
$result = $Article->createArticle($params);
if ($result) {
	//creating image folder
	$articleDir = "../../../img/article/$result/";
	mkdir($articleDir);

	//adding thumbnail
	$imageUploaded = $articleDir . basename($_FILES['thumbnail']['name']);
	$imageFileType = strtolower(pathinfo($imageUploaded, PATHINFO_EXTENSION));

	$thumbnail = $articleDir . 'thumbnail.' . $imageFileType;
	move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail);


	//adding other images if there is
	for ($i = 1; $i <= 6; $i++)
		if (isset($_FILES["image_$i"])) {
			$imageUploaded = $articleDir . basename($_FILES["image_$i"]['name']);
			$imageFileType = strtolower(pathinfo($imageUploaded, PATHINFO_EXTENSION));

			$image = $articleDir . $i . '.' . $imageFileType;

			move_uploaded_file($_FILES["image_$i"]['tmp_name'], $image);
		} else break;

	return_to_add_article('green', 'Article created successfully');
}

return_to_add_article('red', 'Article not created, unexpected error');

function return_to_add_article($flag, $message)
{
	header("location: ../../add_article?fn=$flag&fn_message=$message");
	exit;
}
