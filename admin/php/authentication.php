<?php
require_once 'autoload.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
	header('location: ../');
	exit;
}
