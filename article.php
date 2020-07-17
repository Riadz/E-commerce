s<?php
require_once  'php/autoload.php';
session_start();

use App\Article;
use App\ArticleReview;

$Articles = Article::make();

if (isset($_GET['article_id']) && $Articles->articleExists($_GET['article_id'])) {
	// getting the article by its id
	$article = $Articles->getArticles(
		'articleById',
		['article_id' => $_GET['article_id']],
		1
	)[0];

	// getting its reviews/ratings
	$ArticleReviews = ArticleReview::make();
	$article_reviews = $ArticleReviews->getArticleReviews(
		['article_id' => $_GET['article_id']]
	);

	// if the user can write reviews about the article
	$user_review_eligible = false;
	if (isset($_SESSION['user']->id))
		$user_review_eligible
			= $ArticleReviews->isEligible(
				$_GET['article_id'],
				$_SESSION['user']->id
			);

	// getting its images base folder
	$files = scandir("img/article/{$article['article_id']}");
} else header('location: error/404');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title><?= $article['article_name'] ?></title>

	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/article.css" />
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/aside.css">
	<link rel="stylesheet" href="css/footer.css">

	<script defer src="js/article.js"></script>
</head>

<body>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<aside>
			<?php include 'common/aside.php'; ?>
		</aside>
		<main>
			<section id="main-section">
				<div id="slideshow-container">
					<div id="slideshow-image-container">
						<img onclick="openZoomModal(event)" src="img/article/<?= $article['article_id'] ?>/<?= $files[count($files) - 1] ?>" alt="article image" />
					</div>

					<div id="slideshow-buttons-container">
						<label onclick="slideshowChangeImage(event);">
							<img class="slideshow-img" id="active-slideshow-button" src="img/article/<?= $article['article_id'] ?>/<?= $files[count($files) - 1] ?>" alt="error" />
						</label>

						<?php for ($i = 2; $i < count($files) - 1; $i++) : ?>
							<label onclick="slideshowChangeImage(event);">
								<img class="slideshow-img" src="img/article/<?= $article['article_id'] ?>/<?= $files[$i] ?>" />
							</label>
						<?php endfor ?>
					</div>
				</div>

				<div id="buy-container">
					<h1 id="article-title">
						<?= $article['article_name'] ?>
					</h1>

					<div class="buy-field" id="article-brand">
						<span class="label">brand:</span>
						<img src="<?= $article['brand_src'] ?>" />
						<span><?= $article['brand'] ?></span>
					</div>

					<?php if ($article['discount']) : ?>
						<div class="buy-field">
							<span class="label">discount:</span>
							<span id="on-discount-per-span">
								-<?= $article['discount'] ?>%
							</span>
						</div>
					<?php elseif ($article['new']) : ?>
						<div class="buy-field">
							<span id="new-span">NEW</span>
						</div>
					<?php endif ?>

					<div class="buy-field" id="article-price">
						<span class="label">price:</span>

						<?php if ($article['discount']) : ?>
							<span><?= $article['new_price'] ?> DA</span>
							<span id="old-price"><?= $article['price'] ?> DA</span>
						<?php else : ?>
							<span><?= $article['price'] ?> DA</span>
						<?php endif ?>

					</div>

					<div class="buy-field" id="article-stock-<?= ($article['stock'] ? 'yes' : 'no') ?>">
						<span class="label">
							<?=
								$article['stock']
									? "In Stock -  {$article['stock']}  remaining"
									: 'Out Of Stock'
							?>
						</span>
					</div>

					<div class="buy-field" id="article-rating">
						<span class="label">Reviews:</span>
						<div class="article-rating-container">
							<span class="article-back-stars">☆☆☆☆☆</span>
							<span class="article-front-stars" style="width:<?= $article['rating_percentage'] ?>%">★★★★★</span>
						</div>
						<span>(<?= $article['rating_percentage'] ?>% - <?= $article['rating_number'] ?> ratings)</span>
					</div>

					<div id=" add-to-cart-container">
						<div class="buy-field">
							<span class="label">Quantity:</span>
							<input type="number" id="add-to-cart-input" value="1" min="1" max="<?= $article['stock'] ?>">
						</div>

						<button article_id="<?= $article['article_id'] ?>" id="add-to-cart-button" <?= $article['stock'] ? '' : 'disabled' ?>>
							<img src="img/shopping-cart.png" />
							<span>add cart</span>
						</button>
					</div>
				</div>
			</section>
			<section class="detail-section">
				<h2>Description</h2>
				<p>
					<?= $article['description'] ?>
				</p>
			</section>
			<section class="detail-section">
				<h2>Characteristics</h2>
				<p>
					<?= $article['characteristics'] ?>
				</p>
			</section>
			<section class="detail-section">
				<h2>Reviews & Ratings</h2>
				<!-- users reviews -->
				<div class="reviews-container">
					<?php if (!empty($article_reviews)) : ?>
						<?php foreach ($article_reviews as $article_review) : ?>
							<div class="review">
								<div class="review-row">
									<img class="review-avatar" src="img/connect.png" alt="avatar">
									<h3 class="review-name">
										<?= "{$article_review['first_name']} {$article_review['last_name']}" ?>
									</h3>
									<div class="rating-container">
										<span class="back-stars">☆☆☆☆☆</span>
										<span class="front-stars" style="
										width:<?= $article_review['article_review_rating'] * 100 / 5 ?>%
										">★★★★★</span>
									</div>
								</div>
								<span>
									written on <?= $article_review['article_review_date'] ?>
								</span>
								<h4 class="review-title">
									<?= $article_review['article_review_title'] ?>
								</h4>
								<p>
									<?= $article_review['article_review_body'] ?>
								</p>
							</div>
						<?php endforeach ?>
					<?php else : ?>
						<h3>This article doesn't have any reviews</h3>
					<?php endif ?>
				</div>
				<!-- loged user review -->
				<?php if ($user_review_eligible) : ?>
					<div class="review-write-container">
						<h3>You bought this article before, you're eligible to review it</h3>
						<form action="php/actions/write_review.php" method="POST">
							<input hidden name="article_id" value="<?= $article['article_id'] ?>">
							<label class="review-write-label">Rating:</label>
							<div class="review-write-star-input">
								<label>
									<input type="radio" name="article_review_rating" value="1" required />
									<span class="icon">★</span>
								</label>
								<label>
									<input type="radio" name="article_review_rating" value="2" required />
									<span class="icon">★</span>
									<span class="icon">★</span>
								</label>
								<label>
									<input type="radio" name="article_review_rating" value="3" required />
									<span class="icon">★</span>
									<span class="icon">★</span>
									<span class="icon">★</span>
								</label>
								<label>
									<input type="radio" name="article_review_rating" value="4" required />
									<span class="icon">★</span>
									<span class="icon">★</span>
									<span class="icon">★</span>
									<span class="icon">★</span>
								</label>
								<label>
									<input type="radio" name="article_review_rating" value="5" required />
									<span class="icon">★</span>
									<span class="icon">★</span>
									<span class="icon">★</span>
									<span class="icon">★</span>
									<span class="icon">★</span>
								</label>
							</div>

							<label class="review-write-label">Title:</label>
							<input type="text" name="article_review_title" class="review-write-input" required>

							<label class="review-write-label">Your review:</label>
							<textarea name="article_review_body" class="review-write-input" required></textarea>

							<button type="submit" class="review-write-submit styled-btn">
								Submit
							</button>
						</form>
					</div>
				<?php endif ?>
			</section>
			<!-- galaxy s9 special offer -->
			<section id="s9-special-offer" class="special-offer">
				<div class="special-offer-img">
					<img src="img/special_offers/s9_special_offer.png" alt="">
				</div>
				<div class="special-offer-text">
					<h2>Galaxy S9</h2>
					<p>
						With a camera that works like your eye.
					</p>
					<a href="article?article_id=51" class="styled-btn">
						ORDER NOW
					</a>
				</div>
			</section>
			<!-- suggestions -->
			<section style="flex-direction: column;">
				<div class="section-header">
					<h1 class="specific-section-header">
						You may also like
					</h1>
				</div>
				<div>
					<?php
					$articles = $Articles->getArticles(
						'articlesByBrandName',
						['brand' => $article['brand']],
						4
					);

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
		</main>
	</div>

	<div id="zoom-modal" onclick="closeZoomModal(event)">
		<div id="zoom-modal-container">
			<img id="zoom-modal-img" src="" alt="image error">

			<button class="zoom-btn" id="zoom-close-btn">X</button>
			<button class="zoom-btn" id="zoom-next-btn" onclick="switchZoomImg(+1)">❯</button>
			<button class="zoom-btn" id="zoom-previous-btn" onclick="switchZoomImg(-1)">❮</button>
		</div>
	</div>

	<!-- Footer -->
	<?php include('common/footer.php') ?>
</body>

</html>
