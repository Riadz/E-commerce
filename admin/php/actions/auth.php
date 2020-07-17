<?php
require_once '../autoload_actions.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
	header('location: ../../../');
	exit;
}
