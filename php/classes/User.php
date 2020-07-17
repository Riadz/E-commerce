<?php

namespace App;

use App\Database;

class User
{
	//Shipping fee par article
	protected static $shipping_fee = 100;
	// database
	protected static $db;
	//user information
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $address;
	public $phone_number;
	public $birth_date;

	function __construct($user_id)
	{
		static::init_db();

		$columns = "`first_name`, `last_name`, `email`, `address`, `phone_number`, `birth_date`";
		$prepared = static::$db->prepare(
			"SELECT $columns FROM `user`
			 WHERE `user_id` = :id
			 LIMIT 1"
		);

		$result = $prepared->execute(['id' => $user_id]);
		if ($result) {
			$user_data = $prepared->fetch();

			foreach ($user_data as $key => $value) {
				$this->$key = $value;
			}

			$this->id = $user_id;
		} else {
			die("SQL query fatal error 😕 " . $prepared->errorInfo()[2]);
		}
	}
	static function auth(string $email, string $password)
	{
		static::init_db();

		$prepared = static::$db->prepare(
			"SELECT `user_id`, `password` FROM `user`
			 WHERE `email` = :email
			 LIMIT 1"
		);
		$result = $prepared->execute(['email' => $email]);

		if ($result) {
			if ($prepared->rowCount()) {

				$data = $prepared->fetch();
				$hashed_password = $data['password'];
				$user_id = $data['user_id'];

				if (password_verify($password, $hashed_password))
					return new static($user_id);
			}
			return false;
		} else {
			die("SQL query fatal error 😕 " . $prepared->errorInfo()[2]);
		}
	}
	static function create($params)
	{
		static::init_db();

		//hashing the password
		$params['password'] = password_hash($params['password'], PASSWORD_BCRYPT);

		$prepared = static::$db->prepare(
			"INSERT INTO `user`
			 (`first_name`, `last_name`, `email`, `password`, `address`, `phone_number`, `birth_date`)
			 VALUES
			 (:first_name,:last_name,:email,:password,:address,:phone_number,:birth_date)"
		);
		$result = $prepared->execute($params);

		if ($result) {
			$user_id = static::$db->lastInsertId();
			return new static($user_id);
		} else {
			die("SQL query fatal error 😕 " . $prepared->errorInfo()[2]);
		}
	}

	static function exists(int $id): bool
	{
		static::init_db();

		$prepared = static::$db->prepare(
			"SELECT `user_id` FROM `user`
			 WHERE `user_id` = :id
			 LIMIT 1"
		);

		$result = $prepared->execute(['id' => $id]);
		if ($result) {
			return (bool) $prepared->rowCount();
		} else {
			die("SQL query fatal error 😕" . $prepared->errorInfo()[2]);
		}
	}
	static function emailExists(String $email): bool
	{
		static::init_db();

		$prepared = static::$db->prepare(
			"SELECT `user_id` FROM `user`
			 WHERE `email` = :email
			 LIMIT 1"
		);

		$result = $prepared->execute(['email' => $email]);
		if ($result) {
			return (bool) $prepared->rowCount();
		} else {
			die("SQL query fatal error 😕 " . $prepared->errorInfo()[2]);
		}
	}

	public function getOrders()
	{
		static::init_db();

		$columns = '`cart_id`, `cart_date`, `payment_method`, `shipping_address`, `status`';
		$result = static::$db->query(
			"SELECT $columns
			 FROM `order`
			 WHERE `user_id`= $this->id
			 ORDER BY `cart_id` DESC"
		);

		if ($result) {
			$orders = $result->fetchAll();

			foreach ($orders as &$order) {
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
					$files = scandir('./img/article/' . $article['article_id']);
					$thumbnail_src = "img/article/" . $article['article_id'] . "/" . $files[count($files) - 1];
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
			}

			return $orders;
		} else {
			die("SQL query fatal error 😕 " . $result);
		}
	}
	public function checkout($params, $articles)
	{
		static::init_db();

		$prepared = static::$db->prepare(
			"INSERT INTO `order`
			 (`user_id`, `cart_date`, `shipping_address`, `payment_method`)
			 VALUES
			 ($this->id, CURDATE(), :shipping_address, :payment_method)"
		);
		$result = $prepared->execute($params);

		if ($result) {
			$cart_id = static::$db->lastInsertId();

			foreach ($articles as $article) {
				$discount = static::$db->query(
					"SELECT `discount` FROM `article`
					 WHERE `article`.`article_id` = {$article['article_id']}"
				)->fetch()['discount'];

				$discount = $discount ?? 'NULL';

				//adding article to cart
				static::$db->exec(
					"INSERT INTO `cart`(`cart_id`, `article_id`, `article_quantity`, `current_discount`)
					 VALUES (
						 $cart_id,
						 {$article['article_id']},
						 {$article['article_quantity']},
						 $discount
					 )"
				);

				//decrementing stock, and incrementing sold count
				static::$db->exec(
					"UPDATE `article` SET
					 `stock` = `stock` - {$article['article_quantity']},
					 `sold_count` = `sold_count` + {$article['article_quantity']}
					 WHERE `article_id`= {$article['article_id']}"
				);
			}

			return true;
		} else {
			die("SQL query fatal error 😕 " . $prepared->errorInfo()[2]);
		}
	}

	public function updateInformation($params)
	{
		static::init_db();

		$prepared = static::$db->prepare(
			"UPDATE `user` SET

			`first_name`   = :first_name,
			`last_name`    = :last_name,
			`email`        = :email,
			`address`      = :address,
			`phone_number` = :phone_number,
			`birth_date`   = :birth_date

			WHERE `user_id`=  $this->id"
		);

		return (bool) $prepared->execute($params);
	}
	public function updatePassword($old_password, $new_password)
	{
		static::init_db();

		$password_database = static::$db->query(
			"SELECT `password` FROM `user`
			 WHERE `user_id`= $this->id"
		);

		$password_database = $password_database->fetch()['password'];

		if (!password_verify($old_password, $password_database))
			return false;

		$prepared = static::$db->prepare(
			"UPDATE `user` SET

			`password`   = :password

			WHERE `user_id`=  $this->id"
		);

		//hashing the password
		$new_password = password_hash($new_password, PASSWORD_BCRYPT);

		return (bool) $prepared->execute(['password' => $new_password]);
	}

	public function isAdmin()
	{
		static::init_db();

		$result = static::$db->query(
			"SELECT `admin_id` FROM `admin`
			 WHERE `user_id`= $this->id"
		);

		return $result->rowCount();
	}

	protected static function init_db(): void
	{
		if (static::$db === null)
			static::$db = Database::make();
	}
}
