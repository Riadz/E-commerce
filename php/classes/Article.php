<?php
// Singleton class
namespace App;

use App\Database;

class Article
{
	protected static $instance = null;
	protected static $db;
	protected static $queries = [];

	private function __construct()
	{
		static::$db = Database::make();
		$this->prepareQueries();
	}
	static function make(): Article
	{
		if (static::$instance === null)
			try {
				static::$instance = new static();
				return static::$instance;
			} catch (Exception $e) {
				die('Fatal Error 😕<br>' . $e->getMessage());
			}

		return static::$instance;
	}

	private function prepareQueries()
	{
		/* Articles */
		//article by id
		static::$queries['articleById']
			= "SELECT * FROM `article` WHERE `article_id`= :article_id";
		//articles what so ever
		static::$queries['articles']
			= "SELECT * FROM `article`";

		//articles on discount
		static::$queries['articlesOnDiscount']
			= "SELECT * FROM `article` WHERE `discount` > 0";

		//articles that are new
		static::$queries['articlesNew']
			= "SELECT * FROM `article` WHERE `new` = 1";

		//articles by sub-category
		static::$queries['articlesBySubCategoryId']
			= "SELECT * FROM `article`, `sub_category`
				 WHERE `article`.`sub_category_id` = `sub_category`.`sub_category_id`

				 AND `article`.`sub_category_id` = :sub_category_id";

		//articles by category
		static::$queries['articlesByCategoryId']
			= "SELECT * FROM `article`, `sub_category`, `category`
				 WHERE `article`.`sub_category_id` = `sub_category`.`sub_category_id`
				 AND `sub_category`.`category_id` = `category`.`category_id`

				 AND `category`.`category_id` = :category_id";

		//articles by brand
		static::$queries['articlesByBrandName']
			= "SELECT * FROM `article`
				 WHERE `brand` = :brand";

		//articles by brand and category
		static::$queries['articlesByBrandNameAndCategoryId']
			= "SELECT * FROM `article`, `sub_category`, `category`
				 WHERE `article`.`sub_category_id` = `sub_category`.`sub_category_id`
				 AND `sub_category`.`category_id` = `category`.`category_id`

				 AND `article`.`brand` = :brand
				 AND `category`.`category_id` = :category_id";

		//articles what so ever
		static::$queries['articlesByPriceUnder']
			= "SELECT * FROM `article`
				 WHERE `price` < :max_price";

		//articles general search (name, brand or sub-category)
		static::$queries['articlesSearch']
			= "SELECT * FROM `article`,`sub_category`
				 WHERE `article_name` LIKE :search_key
				 OR `brand` LIKE :search_key
				 OR (
					 article.`sub_category_id` = sub_category.`sub_category_id`
					 AND `sub_category_name` LIKE :search_key
				 )
				 GROUP BY `article_id`";

		/* Categories */
		//categories
		static::$queries['categories']
			= "SELECT * FROM `category`";

		//sub-categories with category id
		static::$queries['subCategoriesByCategoryId']
			= "SELECT `sub_category_id`, `sub_category_name`
				 FROM `sub_category` WHERE `category_id`= :category_id";

		/* Brands */
		//brands by categories
		static::$queries['brandsByCategoryId']
			= "SELECT DISTINCT `brand`
				 FROM `article`,`sub_category`
				 WHERE `article`.`sub_category_id` = `sub_category`.`sub_category_id`

				 AND `sub_category`.`category_id` = :category_id";
	}

	// Articles
	public function getArticles(
		String $index = 'articles',
		array $params = [],
		int $limit = 8,
		String $order_by = 'sold_count'
	) {

		$query = static::$queries[$index];
		if ($limit != 0) {
			//adding table name before order_by
			$order_by = "`article`.`$order_by`";

			$order_by_and_limit = "ORDER BY $order_by DESC LIMIT $limit";
			$query = "$query $order_by_and_limit";
		}

		$prepared = static::$db->prepare($query);

		$result = $prepared->execute($params);

		//formatting variables
		if ($result) {
			$articles = $prepared->fetchAll();

			$articles = $this->formatArticles($articles);

			return $articles;
		} else {
			die("SQL query fatal error 😕" . $prepared->errorInfo()[2]);
		}
	}
	// Categories
	public function getCategories(
		String $index = 'categories',
		array $params = []
	) {

		$query = static::$queries[$index];
		$prepared = static::$db->prepare($query);
		$result = $prepared->execute($params);

		if ($result) {
			return $prepared->fetchAll();
		} else {
			die("SQL query fatal error 😕" . $prepared->errorInfo()[2]);
		}
	}
	// Brands
	public function getBrands(
		String $index,
		array $params
	) {

		$query = static::$queries[$index];
		$prepared = static::$db->prepare($query);
		$result = $prepared->execute($params);

		if ($result) {
			return $prepared->fetchAll();
		} else {
			die("SQL query fatal error 😕" . $prepared->errorInfo()[2]);
		}
	}

	public function articleExists(
		int $article_id
	) {
		$prepared = static::$db->prepare(
			static::$queries['articleById']
		);

		$result = $prepared->execute(
			[':article_id' => $article_id]
		);

		if ($result) {
			return (bool) $prepared->rowCount();
		} else {
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
		}
	}

	// other functions
	private function formatArticles($articles)
	{
		foreach ($articles as &$article) {
			// calculating and formatting discount price
			if ($article['discount']) {
				$new_price = $article['price'] - ($article['price'] * $article['discount']);
				$article['new_price'] = $this->formatPrice($new_price);

				$article['discount'] *= 100;
			}

			// formatting normal price
			$article['price'] = $this->formatPrice($article['price']);

			// thumbnail image src
			$article['thumbnail_src']
				= $this->thumbnailSrc($article['article_id']);

			// brand icon src
			$path = "img/brand/";
			$brand_src_results = glob($path . $article['brand'] . '.*');
			if (isset($brand_src_results[0]))
				$article['brand_src'] = $brand_src_results[0];
			else
				$article['brand_src'] = "";
		}

		return $articles;
	}
	protected function thumbnailSrc($article_id)
	{
		$files = scandir("./img/article/$article_id");
		return "img/article/$article_id/" . $files[count($files) - 1];
	}

	public static function formatPrice($old_price)
	{
		return number_format($old_price, 0, '.', ' ');
	}
}
