<?php

namespace App;

use App\Database;
use App\Article;

class Admin
{
	// database
	private static $db;

	static function getUsersCount()
	{
		static::init_db();

		$result = static::$db->query(
			"SELECT COUNT(*) AS `count` FROM `user`"
		);
		return $result->fetch()['count'];
	}

	static function getUsersOrdersCount()
	{
		static::init_db();

		$result = static::$db->query(
			"SELECT COUNT(*) AS `count` FROM `order`"
		);
		return $result->fetch()['count'];
	}

	static function getTotalRevenue()
	{
		static::init_db();

		$result = static::$db->query(
			"SELECT SUM(IF(
				`current_discount` != NULL,
				`price` - (`price` * `current_discount`),
				`price`
			)) AS `sum`
			FROM `cart` INNER JOIN `article`
			ON `cart`.`article_id` = `article`.`article_id`"
		);
		return Article::formatPrice($result->fetch()['sum']);
	}

	static function getMonthRevenue(int $month)
	{
		static::init_db();

		$result = static::$db->query(
			"SELECT SUM(IF(
				`current_discount` != NULL,
				`price` - (`price` * `current_discount`),
				`price`
			)) AS `sum`
			from `order` INNER JOIN `cart` ON `order`.`cart_id` = `cart`.`cart_id`
			INNER JOIN `article` ON `cart`.`article_id` = `article`.`article_id`

			WHERE MONTH(`order`.`cart_date`) = $month"
		);
		return $result->fetch()['sum'];
	}

	static function getYearRevenueArray()
	{
		static::init_db();

		$result = static::$db->query(
			"SELECT
			MONTH(`order`.`cart_date`) AS `month`,
			SUM(IF(
				`current_discount` != NULL,
				`price` - (`price` * `current_discount`),
				`price`
			)) AS `sum`
			from `order` INNER JOIN `cart` ON `order`.`cart_id` = `cart`.`cart_id`
			INNER JOIN `article` ON `cart`.`article_id` = `article`.`article_id`

			GROUP BY `month`"
		)->fetchAll(\PDO::FETCH_KEY_PAIR);

		$current_month = (int) date('m');

		//values
		$revenue = array_fill_keys(range(1, $current_month), 0);
		foreach ($result as $key => $value)
			$revenue[$key] = $value;

		//months
		$months = [];
		for ($i = 1; $i <= $current_month; $i++) {
			array_push($months, "'" . date('F', mktime(0, 0, 0, $i)) . "'");
		}

		return [$months, $revenue];
	}

	private static function init_db(): void
	{
		if (static::$db === null)
			static::$db = Database::make();
	}
}
