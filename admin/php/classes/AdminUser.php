<?php

namespace App;

class AdminUser extends User
{
	static function getAllOrder()
	{
		static::init_db();

		$columns = '`cart_id`, `user_id`, `cart_date`, `status`';
		$result = static::$db->query(
			"SELECT $columns
			 FROM `order`
			 ORDER BY `cart_id` DESC"
		);

		if ($result) {
			$orders = $result->fetchAll();

			foreach ($orders as &$order) {
				//getting the cart's articles
				$result = static::$db->query(
					"SELECT `price`, `article_quantity`, `current_discount`
					 FROM `cart` JOIN `article`
					 ON `cart`.`article_id` = `article`.`article_id`
					 WHERE `cart`.`cart_id`= {$order['cart_id']}"
				);
				if (!$result) die("SQL query fatal error 😕 " . $result->errorInfo()[2]);

				$articles = $result->fetchAll();
				$order['articles_count'] = 0;
				$order['total_price'] = 0;

				foreach ($articles as &$article) {
					// calculating and discount price
					if ($article['current_discount'])
						$article_price = $article['price'] - ($article['price'] * $article['current_discount']);
					else
						$article_price = $article['price'];

					//total price of the same articles
					$order['total_price']
						+= $article_price * $article['article_quantity'];

					//total number of articles
					$order['articles_count']
						+= $article['article_quantity'];
				}
				//adding shipping fee to total price
				$order['total_price'] += static::$shipping_fee * $order['articles_count'];
				//formatting order's total price
				$order['total_price'] = Article::formatPrice($order['total_price']);

				//getting the user's name
				$result = static::$db->query(
					"SELECT `first_name`, `last_name`
					 FROM `user`
					 WHERE `user_id`= {$order['user_id']}"
				);
				if (!$result) die("SQL query fatal error 😕 " . $result->errorInfo()[2]);
				$user = $result->fetch();
				$order['user_full_name'] = "{$user['first_name']} {$user['last_name']}";
			}

			return $orders;
		} else {
			die("SQL query fatal error 😕 " . $result);
		}
	}

	static function orderExists($order_id)
	{
		static::init_db();

		$prepared = static::$db->prepare(
			"SELECT `cart_id` FROM `order` WHERE `cart_id`=:order_id"
		);

		$result = $prepared->execute(['order_id' => $order_id]);

		if ($result) {
			return (bool) $prepared->rowCount();
		} else {
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
		}
	}

	static function deleteOrder($order_id)
	{
		static::init_db();

		$prepared = static::$db->prepare(
			"DELETE FROM `order` WHERE `cart_id`=:order_id"
		);

		$result = $prepared->execute(['order_id' => $order_id]);

		if ($result) {
			return (bool) $prepared->rowCount();
		} else {
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
		}
	}

	static function getOrder($order_id)
	{
		static::init_db();

		$columns = '`cart_id`, `user_id`, `cart_date`, `payment_method`, `shipping_address`, `status`';
		$result = static::$db->query(
			"SELECT $columns
			 FROM `order`
			 WHERE `cart_id`= $order_id"
		);

		if ($result) {
			$order = $result->fetch();

			//getting the cart's articles
			$columns = '`cart`.`article_id`, `article_name`, `price`, `article_quantity`, `current_discount`';
			$result = static::$db->query(
				"SELECT $columns
					 FROM `cart` JOIN `article`
					 ON `cart`.`article_id` = `article`.`article_id`
					 WHERE `cart`.`cart_id`= {$order['cart_id']}"
			);
			if (!$result) die("SQL query fatal error 😕 " . $result->errorInfo()[2]);

			$articles = $result->fetchAll();
			$articles_count = 0;
			$order['cart_total_price'] = 0;

			foreach ($articles as &$article) {
				// calculating and discount price
				if ($article['current_discount']) {
					$new_price = $article['price'] - ($article['price'] * $article['current_discount']);
					$article['price'] = $new_price;

					$article['current_discount'] *= 100;
				}

				//total price of the same articles
				$article['article_total_price']
					= $article['price'] * $article['article_quantity'];

				//total number of articles
				$articles_count += $article['article_quantity'];

				//thumbnail image src
				$files = scandir('../img/article/' . $article['article_id']);
				$thumbnail_src = "../img/article/" . $article['article_id'] . "/" . $files[count($files) - 1];
				$article['thumbnail_src'] = $thumbnail_src;

				//adding to order's total price
				$order['cart_total_price'] += $article['article_total_price'];

				//formatting prices
				$article['price']
					= Article::formatPrice($article['price']);
				$article['article_total_price']
					= Article::formatPrice($article['article_total_price']);
			}

			//adding articles to the order
			$order['articles'] = $articles;
			$order['articles_count'] = $articles_count;

			//adding shipping fee to total price
			$order['cart_total_price'] += static::$shipping_fee * $order['articles_count'];

			//formatting order's total price
			$order['cart_total_price'] = Article::formatPrice($order['cart_total_price']);

			//getting the user's name
			$result = static::$db->query(
				"SELECT `first_name`, `last_name`
					 FROM `user`
					 WHERE `user_id`= {$order['user_id']}"
			);
			if (!$result) die("SQL query fatal error 😕 " . $result->errorInfo()[2]);
			$user = $result->fetch();
			$order['user_full_name'] = "{$user['first_name']} {$user['last_name']}";

			return $order;
		} else {
			die("SQL query fatal error 😕 " . $result);
		}
	}

	static function updateOrderStatus($order_id, $order_status)
	{
		static::init_db();

		$prepared = static::$db->prepare(
			"UPDATE `order` SET `status`=:order_status WHERE `cart_id`=:order_id"
		);

		$result = $prepared->execute([
			'order_id'     => $order_id,
			'order_status' => $order_status
		]);

		if ($result) {
			return true;
		} else {
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
		}
	}
}
