<?php

namespace App\Traits;

trait DatabaseTrait
{
	private function getCredentials()
	{
		$path = realpath(__DIR__ . "/../../../config/db_config.php");

		if ($path !== false)
			return require($path);
		else
			throw new \Exception('cant find config/db_config.php file');
	}
}
