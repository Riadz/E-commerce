<?php
require_once 'php/autoload.php';
require 'php/authentication.php';

use App\AdminArticle;

if (!isset($_GET['article_id'])) {
	header('location: dashboard');
	exit;
}

$Articles = AdminArticle::make();

$categories = $Articles->getCategories();
$sub_categories = $Articles->getSubCategories();

$article = $Articles->getArticles('articleById', ['article_id' => $_GET['article_id']])[0];
$images_folder = "../img/article/{$article['article_id']}";
$images = scandir($images_folder);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="../favicon.png" />
	<title>Edit Article</title>

	<link rel="stylesheet" href="../css/general.css" />
	<link rel="stylesheet" href="../css/form.css" />
	<link rel="stylesheet" href="css/admin.css" />
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/jquery/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.3.0/tinymce.min.js" integrity="sha256-OOm3ayaYfM+pxMHXAjRvg1sYwQ/7SMjzZ3hincjUM+c=" crossorigin="anonymous"></script>
	<script src="js/add_article.js"></script>
</head>

<body>
	<header></header>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<!-- Aside -->
		<?php include('common/aside.php') ?>

		<section>
			<div class="edit-form form-container">
				<!-- info -->
				<form method="POST" enctype="multipart/form-data" action="php/actions/edit_article.php">
					<input type="hidden" name="article_id" value="<?= $article['article_id'] ?>">
					<div class="form-header">
						<h2>Edit: <?= $article['article_name'] ?></h2>
					</div>
					<div id="sections-container">
						<div class="section">
							<span>Article name</span>
							<input name="article_name" minlength="4" value="<?= $article['article_name'] ?>" required>
							<span>Article brand</span>
							<input name="brand" minlength="4" value="<?= $article['brand'] ?>" required>
							<span>Category</span>
							<select name="category_id" required>
								<?php foreach ($categories as $category) : ?>
									<option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
								<?php endforeach ?>
							</select>
							<span>Sub-category</span>
							<select name="sub_category_id" required>
								<?php foreach ($sub_categories as $sub_category) : ?>
									<option value="<?= $sub_category['sub_category_id'] ?>" data-category-id="<?= $sub_category['category_id'] ?>"><?= $sub_category['sub_category_name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="splitter"></div>
						<div class="section">
							<span>Stock</span>
							<input name="stock" type="number" min="0" max="10000" value="<?= $article['stock'] ?>">
							<span>Price (DA)</span>
							<input name="price" type="number" min="1" max="10000000" value="<?= str_replace(' ', '', $article['price'])  ?>">
							<span>Discount (%)</span>
							<div class="check-input">
								<?php if ($article['discount']) : ?>
									<input name="on_discount_checkbox" type="checkbox" checked>
									<input name="discount" type="number" min="1" max="100" class="check-input-grow" value="<?= $article['discount'] ?>" />
								<?php else : ?>
									<input name="on_discount_checkbox" type="checkbox">
									<input name="discount" type="number" min="1" max="100" class="check-input-grow" disabled />
								<?php endif ?>
							</div>
							<span>New</span>
							<div class="check-input">
								<input name="new" type="checkbox" <?= $article['new'] ? 'checked' : '' ?> />
							</div>
						</div>
					</div>

					<hr style="margin: 2rem 0; width: 100%">

					<div class="form-header">
						<h2>Images</h2>
					</div>
					<div class="section" style="width: 85%">
						<span style="margin-bottom: 10px;">Thumbnail image</span>
						<div style="display: flex; width: 75%">
							<img src="<?= $article['thumbnail_src'] ?>" style="height: 42px; width:72px; object-fit: scale-down; margin-right: 5px;">
							<input name="thumbnail" type="file" accept="image/x-png,image/gif,image/jpeg" />
						</div>

						<?php for ($i = 2; $i < count($images) - 1; $i++) : ?>
							<span style="margin-bottom: 10px;">image <?= $i - 1 ?></span>
							<div style="display: flex; width: 75%">
								<img src="<?= "$images_folder/{$images[$i]}" ?>" style="height: 42px; width:72px; object-fit: scale-down; margin-right: 5px;">
								<input name="image_<?= $i - 1 ?>" type="file" accept="image/x-png,image/gif,image/jpeg" />
								<input name="delete_img_<?= $i - 1 ?>" type="checkbox" class="delete-checkbox">
							</div>
						<?php endfor ?>

						<button id="add-img-input-btn" type="button" class="styled-btn">
							<img src="img/add.png">
						</button>
					</div>

					<hr style="margin: 2rem 0; width: 100%">

					<div class="form-header">
						<h2>Description</h2>
					</div>
					<textarea class="mce-textarea" name="description">
						<?= $article['description'] ?>
					</textarea>
					<div class="form-header" style="margin-top: 2rem">
						<h2>Characteristics</h2>
					</div>
					<textarea class="mce-textarea" name="characteristics">
						<?= $article['characteristics'] ?>
					</textarea>

					<button type="submit" class="styled-btn sb-green">
						<span>Update Article</span>
					</button>

				</form>
		</section>
	</div>
	<script>
		tinymce.init({
			selector: '.mce-textarea'
		});
	</script>

	<!-- feedback notification -->
	<?php if (isset($_GET['fn'])) : ?>
		<div id="feedback_notification" class="fn-<?= $_GET['fn'] ?>">
			<span><?= $_GET['fn_message'] ?></span>
			<button id="fn-close">X</button>
		</div>
		<script>
			document
				.getElementById('fn-close')
				.addEventListener('click', () => document
					.getElementById('feedback_notification').remove()
				)
		</script>
	<?php endif ?>

	<script>
		//setting how many images u can add
		setImgInputCount(<?= count($images) - 3 ?>);
		checkImgInputCount();
	</script>
</body>

</html>
