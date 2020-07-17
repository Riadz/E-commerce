<?php
$user = "root";
$password = "";
$host = "localhost";
$database = "e-commerce";

$sql = mysqli_connect($host, $user, $password, $database);

$sql->set_charset("utf8");
