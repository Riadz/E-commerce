<?php
spl_autoload_register(function ($classnames) {
	$namespace = 'App\\';
	if (strpos($classnames, $namespace) === 0) {
		$noNamespace = str_replace($namespace, '', $classnames);
		$ds = DIRECTORY_SEPARATOR;
		$normalizedClassnames = str_replace('\\', $ds, $noNamespace);
		$fullPath =
			__DIR__ . $ds . 'classes' . $ds . $normalizedClassnames . '.php';

		$realpath = realpath($fullPath);
		if ($realpath !== false) {
			require_once($realpath);
		}
	}
});

require '../../../php/autoload.php';
