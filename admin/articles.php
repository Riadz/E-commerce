<?php
require_once 'php/authentication.php';
require_once 'php/autoload.php';

use App\AdminArticle;

$Article = AdminArticle::make();
$articles = $Article->getArticles('articles', [], 0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="../favicon.png" />
	<title>Articles</title>

	<link rel="stylesheet" href="../css/general.css" />
	<link rel="stylesheet" href="css/admin.css" />
	<link rel="stylesheet" href="css/table.css" />
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/jquery/jquery-3.3.1.min.js"></script>
	<script src="js/modal.js"></script>
</head>

<body>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<!-- Aside -->
		<?php include('common/aside.php') ?>

		<section>
			<table class="list-table">
				<tr>
					<th>Id</th>
					<th>Image</th>
					<th>Name</th>
					<th>Stock</th>
					<th>Sold Count</th>
					<th>Price</th>
					<th>Action</th>
				</tr>
				<?php foreach ($articles as $article) : ?>
					<tr>
						<td><?= $article['article_id'] ?></td>
						<td><img src="<?= $article['thumbnail_src'] ?>" /></td>
						<td>
							<a href="../article?article_id=<?= $article['article_id'] ?>" target="_blank">
								<?= $article['article_name'] ?>
							</a>
						</td>
						<td><?= $article['stock'] ?></td>
						<td><?= $article['sold_count'] ?></td>
						<td><?= $article['price'] ?> DA</td>
						<td class="list-table-action">
							<button title="Stock" data-id="<?= $article['article_id'] ?>" data-name="<?= $article['article_name'] ?>" data-img-src="<?= $article['thumbnail_src'] ?>" data-stock="<?= $article['stock'] ?>" class="stock-article styled-btn">
								<img src="img/actions/stock.png">
							</button>
							<a title="Edit" href="edit_article?article_id=<?= $article['article_id'] ?>" class="styled-btn sb-green">
								<img src="img/actions/modify.png">
							</a>
							<button title="Delete" data-id="<?= $article['article_id'] ?>" data-name="<?= $article['article_name'] ?>" data-img-src="<?= $article['thumbnail_src'] ?>" class="delete-article styled-btn sb-red">
								<img src="img/actions/delete.png">
							</button>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		</section>
	</div>

	<!-- delete modal -->
	<div id="delete-modal" class="modal">
		<div class="modal-container">
			<button type="button" id="delete-modal-close-btn" class="modal-close-btn">X</button>
			<h2>Are you sure you want to delete this article</h2>
			<h3 id="delete-modal-name"></h3>
			<img id="delete-modal-img" class="modal-img">
			<a id="delete-modal-link" class="styled-btn sb-red">
				Delete
			</a>
		</div>
	</div>

	<!-- stock modal -->
	<div id="stock-modal" class="modal">
		<div class="modal-container">
			<button type="button" id="stock-modal-close-btn" class="modal-close-btn">X</button>
			<h2>Update Stock</h2>
			<h3 id="stock-modal-name"></h3>
			<img id="stock-modal-img" class="modal-img">
			<form action="php/actions/stock_article.php">
				<input name="article_id" id="stock-modal-id" type="hidden" />
				<input name="stock" id="stock-modal-value" type="number" required />
				<button type="submit" name="stocker" class="styled-btn">
					Stocker
				</button>
			</form>
		</div>
	</div>

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
</body>

</html>
