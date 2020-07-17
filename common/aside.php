<?php
require_once  'php/autoload.php';

use App\Article;

$Articles = Article::make();
?>
<!-- script -->
<script defer src="js/category.js"></script>

<!-- categories -->
<section id="category-container">
	<h2>Categories</h2>
	<div id="category-buttons-container">
		<?php
		$categories = $Articles->getCategories();
		foreach ($categories as $category) : ?>
			<a href="search?cat_input=<?= $category['category_id'] ?>" data-category-id="<?= $category['category_id'] ?>" class="category-button">
				<img src="img/categories/<?= $category['category_id'] ?>.png" alt="category icon" />
				<span><?= $category['category_name'] ?></span>
			</a>
			<div id="category-content-<?= $category['category_id'] ?>" class="category-content">
				<div class="category-content-section">
					<h5>Type</h5>
					<?php
						$sub_categories
							= $Articles->getCategories(
								'subCategoriesByCategoryId',
								['category_id' => $category['category_id']],
								0
							); ?>
					<?php foreach ($sub_categories as $sub_category) : ?>
						<a href="search?sub_cat_input=<?= $sub_category['sub_category_id'] ?>">
							<?= $sub_category['sub_category_name'] ?>
						</a>
					<?php endforeach ?>
				</div>

				<div class="category-content-section">
					<h5>Brand</h5>
					<?php
						$brands
							= $Articles->getBrands(
								'brandsByCategoryId',
								['category_id' => $category['category_id']]
							); ?>
					<?php foreach ($brands as $brand) : ?>
						<a href="
							search?brand_input=<?= $brand['brand'] ?>
							&brand_cat_input=<?= $category['category_id'] ?>">
							<?= $brand['brand'] ?>
						</a>
					<?php endforeach ?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</section>
<!-- iphone special offer -->
<section class="aside-special-offer">
	<div class="aside-special-offer-text">
		<h2>Fast.</h2>
		<h2>Robust.</h2>
		<h2>Gorgeous.</h2>
		<h3>iPhone 11 Pro Max</h3>

		<a href="article?article_id=52" class="styled-btn">
			Order Now
		</a>
	</div>
	<div class="aside-special-offer-img">
		<img src="img/article/52/2.jpg" alt="iPhone 11 Pro" loading="lazy">
		<img src="img/article/52/3.jpg" alt="iPhone 11 Pro" loading="lazy">
		<img src="img/article/52/1.jpg" alt="iPhone 11 Pro" loading="lazy">
	</div>
</section>
<!-- under 30000 articles -->
<section class="aside-articles aside-sticky">
	<h3>Under 30 000 DA</h3>
	<div class="aside-articles-container">
		<?php
		$aside_articles
			= $Articles->getArticles(
				'articlesByPriceUnder',
				['max_price' => 30000],
				3
			);
		foreach ($aside_articles as $aside_article) : ?>
			<div class="aside-article article">
				<a href="article?article_id=<?= $aside_article['article_id'] ?>">

					<?php if ($aside_article['discount']) { ?>
						<span class="discount-span">-<?= $aside_article['discount'] ?>%</span>
					<?php } elseif ($aside_article['new']) { ?>
						<span class="new-span">NEW</span>
					<?php } ?>

					<img class="article-img" src="<?= $aside_article['thumbnail_src'] ?>" />

					<div class="article-brand">
						<img src="<?= $aside_article['brand_src'] ?>" />
						<span><?= $aside_article['brand'] ?></span>
					</div>

					<?php if (!$aside_article['discount']) { ?>
						<span class="article-price"><?= $aside_article['price'] ?> DA</span>
					<?php } else { ?>
						<span class="article-price"><?= $aside_article['new_price'] ?> DA
							<span class="article-old-price"><?= $aside_article['price'] ?> DA</span>
						</span>
					<?php } ?>
				</a>
			</div>
		<?php endforeach ?>
	</div>
</section>
