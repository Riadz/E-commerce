<?php

namespace App;

class AdminArticle extends Article
{
	protected function thumbnailSrc($article_id)
	{
		$files = scandir("../img/article/$article_id");
		return "../img/article/$article_id/" . $files[count($files) - 1];
	}

	function deleteArticle($article_id)
	{
		$prepared = static::$db->prepare(
			"DELETE FROM `article` WHERE `article_id` = :article_id"
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
	function stockArticle($article_id, $stock)
	{
		$prepared = static::$db->prepare(
			"UPDATE `article`
			 SET `stock`= :stock
			 WHERE `article_id` = :article_id"
		);

		$result = $prepared->execute([
			':article_id' => $article_id,
			':stock' => $stock
		]);

		if ($result) {
			return (bool) $prepared->rowCount();
		} else {
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
		}
	}

	function createArticle($params)
	{
		$prepared = static::$db->prepare(
			"INSERT INTO `article`(`article_name`, `stock`, `price`, `brand`, `sub_category_id`, `discount`, `new`, `description`, `characteristics`)
			VALUES (
				:article_name, :stock, :price, :brand, :sub_category_id, :discount, :new, :description, :characteristics
			)"
		);

		$result = $prepared->execute($params);

		if ($result) {
			return static::$db->lastInsertId();
		} else {
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
		}
	}

	function updateArticle($params)
	{
		$prepared = static::$db->prepare(
			"UPDATE `article` SET
			`article_name`    = :article_name,
			`stock`           = :stock,
			`price`           = :price,
			`brand`           = :brand,
			`sub_category_id` = :sub_category_id,
			`discount`        = :discount,
			`new`             = :new,
			`description`     = :description,
			`characteristics` = :characteristics
			WHERE `article_id` = :article_id
			"
		);

		$result = $prepared->execute($params);

		if ($result) {
			return true;
		} else {
			die("SQL query fatal error 😕<br>" . $prepared->errorInfo()[2]);
		}
	}

	function getSubCategories()
	{
		$result = static::$db->query(
			"SELECT * FROM `sub_category`"
		);

		if ($result)
			return $result->fetchAll();
		else
			die("SQL query fatal error 😕<br>" . $result);
	}
}
