<?php
// Singleton class
namespace App;

use App\Database;

class ArticleReview
{
	private static $instance = null;
	private static $db;
	private static $queries = [];
	private static $privateQueries = [];

	private function __construct()
	{
		static::$db = Database::make();
		$this->prepareQueries();
	}
	static function make(): ArticleReview
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
		/* Reviews */
		// reviews by article id
		static::$queries['byArticleId']
			= "SELECT
				 `article_review`.*,
				 `user`.`first_name`,
				 `user`.`last_name`
				 FROM `article_review`,`user`
				 WHERE `article_review`.`user_id`=`user`.`user_id`

				 AND `article_id`=  :article_id";
		// create a new review
		static::$queries['create']
			= "INSERT INTO `article_review`
				 (`article_id`,
				  `user_id`,
					`article_review_title`,
					`article_review_body`,
					`article_review_rating`,
					`article_review_date`)

				 VALUES
					(:article_id,
					:user_id,
					:article_review_title,
					:article_review_body,
					:article_review_rating,
					CURDATE())";

		/* Others */
		// if user is eligible to review
		static::$privateQueries['eligible']
			= "SELECT DISTINCT `user_id`
				 FROM `order`,`cart`
				 WHERE `order`.`cart_id`=`cart`.`cart_id`

				 AND `order`.`user_id` = :user_id
				 AND `cart`.`article_id` = :article_id";

		// updating the article's rating info
		static::$privateQueries['updateArticle']
			= "UPDATE `article` SET
				 `rating_number`= `rating_number`+1,

				 `rating_percentage` = IF(
				 	 `rating_percentage`=0,
					 :added_rating_percentage,
					 (`rating_percentage` + :added_rating_percentage) / 2
				 )

				 WHERE `article_id`= :article_id";
	}

	function getArticleReviews(
		array $params,
		String $index = 'byArticleId',
		int $limit = null,
		String $order_by = 'article_review_date'
	) {
		$query = static::$queries[$index];

		if (!empty($order_by) || !empty($limit)) {
			$order_by_and_limit = '';
			if (!empty($order_by)) {
				//adding table name before order_by
				$order_by = "`article_review`.`$order_by`";

				$order_by_and_limit = "ORDER BY $order_by DESC";
			}
			if (!empty($limit)) {
				$order_by_and_limit .= " LIMIT $limit";
			}
		}

		$prepared = static::$db->prepare($query);

		$result = $prepared->execute($params);

		if ($result)
			return $prepared->fetchAll();
		else
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
	}

	function createArticleReview(array $params)
	{
		/* creating the review */
		$prepared = static::$db->prepare(
			static::$queries['create']
		);

		$result = $prepared->execute($params);

		/* updating the article's rating info */
		$added_rating_percentage
			= ((int) $params['article_review_rating'] / 5) * 100;

		$prepared = static::$db->prepare(
			static::$privateQueries['updateArticle']
		);
		$result = $prepared->execute([
			'added_rating_percentage' => $added_rating_percentage,
			'article_id' => $params['article_id']
		]);

		/* returning the result of the first query */
		return $result;
	}

	function isEligible(int $article_id, int $user_id): bool
	{
		$params = [
			':article_id' => $article_id,
			':user_id' => $user_id
		];

		$prepared = static::$db->prepare(
			static::$privateQueries['eligible']
		);

		if ($prepared->execute($params))
			return (bool) $prepared->rowCount();
		else
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
	}
}
