<?php
// Singleton class
namespace App;

use App\Traits\DatabaseTrait;
use PDO;
use PDOException;
use Exception;

class Database
{
	use DatabaseTrait;
	private static $instance = null;
	private static $db;
	private function __construct()
	{
		$cred = $this->getCredentials();

		try {
			$db = new PDO(
				"mysql:dbname={$cred['database']};host={$cred['host']};charset=utf8",
				$cred['user'],
				$cred['password']
			);
		} catch (PDOException $e) {
			throw new Exception(
				"Database Error: {$e->getMessage()}"
			);
		} catch (Exception $e) {
			throw new Exception(
				"Unexpected Error: {$e->getMessage()}"
			);
		}

		$db->setAttribute($db::ATTR_DEFAULT_FETCH_MODE, $db::FETCH_ASSOC);
		static::$db = $db;
	}
	static function make(): PDO
	{
		if (static::$instance === null)
			try {
				static::$instance = new static();
			} catch (Exception $e) {
				die('Fatal Error 😕<br>' . $e->getMessage());
			}

		return static::$db;
	}
}
