<?php
$db_config = require('../config/db_config.php');

$sql = mysqli_connect(
	$db_config['host'],
	$db_config['user'],
	$db_config['password'],
	$db_config['database']
);

$sql->set_charset("utf8");
