<?php
require_once  'php/autoload.php';

use App\Article;

$Articles = Article::make();

if (isset($_GET['research_input'])) {
	$articles = $Articles->getArticles('articlesSearch', ['search_key' => "%{$_GET['research_input']}%"]);

	$header_text = htmlspecialchars("Search: " . $_GET['research_input']);
} elseif (isset($_GET['sub_cat_input']) && is_numeric($_GET['sub_cat_input'])) {
	$articles = $Articles->getArticles('articlesBySubCategoryId', ['sub_category_id' => $_GET['sub_cat_input']]);

	$header_text = isset($articles[0]['sub_category_name']) ? $articles[0]['sub_category_name'] : '';
} elseif (isset($_GET['cat_input']) && is_numeric($_GET['cat_input'])) {
	$articles = $Articles->getArticles('articlesByCategoryId', ['category_id' => $_GET['cat_input']]);

	$header_text = isset($articles[0]['category_name']) ? $articles[0]['category_name'] : '';
} elseif (isset($_GET['brand_input']) && isset($_GET['brand_cat_input']) && is_numeric($_GET['brand_cat_input'])) {
	$articles = $Articles->getArticles(
		'articlesByBrandNameAndCategoryId',
		[
			'brand' => $_GET['brand_input'],
			'category_id' => $_GET['brand_cat_input']
		]
	);

	$header_text
		= isset($articles[0]['brand'])
		? "{$articles[0]['brand']} {$articles[0]['category_name']}"
		: '';
} else header('location: index.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>RTECH For Tech Materials</title>

	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/aside.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/index.css" />

	<script src="js/index.js"></script>
</head>

<body>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<main>
		<div id="main-container">
			<aside>
				<?php include 'common/aside.php' ?>
			</aside>
			<div id="main-content">
				<section style="min-height: 789px;">
					<div class="section-header">
						<h1 class="specific-section-header">
							<?= $header_text ?>
						</h1>
					</div>
					<div>
						<?php
						foreach ($articles as $article) { ?>
							<div class="article">
								<a href="article?article_id=<?= $article['article_id'] ?>">

									<?php if ($article['discount']) { ?>
										<span class="discount-span">-<?= $article['discount'] ?>%</span>
									<?php } elseif ($article['new']) { ?>
										<span class="new-span">NEW</span>
									<?php } ?>

									<img src="<?= $article['thumbnail_src'] ?>" />

									<div class="article-brand">
										<img src="<?= $article['brand_src'] ?>" />
										<span><?= $article['brand'] ?></span>
									</div>

									<span class="article-title">
										<?= $article['article_name'] ?>
									</span>

									<?php if (!$article['discount']) { ?>
										<span class="article-price"><?= $article['price'] ?> DA</span>
									<?php } else { ?>
										<span class="article-price"><?= $article['new_price'] ?> DA
											<span class="article-old-price"><?= $article['price'] ?> DA</span>
										</span>
									<?php } ?>

									<div class="rating-container">
										<span class="back-stars">☆☆☆☆☆</span>
										<span class="front-stars" <?= 'style="width:' . $article['rating_percentage'] . '%"' ?>>★★★★★</span>
									</div>
								</a>
								<?php if ($article['stock']) { ?>
									<button article_id="<?= $article['article_id'] ?>" class="article-add-to-cart-btn">
										<span>Add to cart</span>
										<img src="img/shopping-cart.png" />
									</button>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</section>
				<!-- galaxy s9 special offer -->
				<section id="s9-special-offer" class="special-offer">
					<div class="special-offer-img">
						<img src="img/special_offers/s9_special_offer.png" alt="">
					</div>
					<div class="special-offer-text">
						<h1>Galaxy S9</h1>
						<p>
							With a camera that works like your eye.
						</p>
						<a href="article?article_id=51" class="styled-btn">
							ORDER NOW
						</a>
					</div>
				</section>
				<!-- airpods special offer -->
				<section id="airpods-special-offer" class="special-offer">
					<div class="special-offer-text">
						<h1>AirPods Pro</h1>
						<p>
							AirPods deliver effortless, all-day audio on the go.
						</p>
						<a href="article?article_id=1" class="styled-btn">
							ORDER NOW
						</a>
					</div>
					<div class="special-offer-img">
						<img src="img/special_offers/airpods_special_offer.png" alt="">
					</div>
				</section>
			</div>
		</div>
	</main>

	<!-- Footer -->
	<?php include('common/footer.php') ?>
</body>

</html>
