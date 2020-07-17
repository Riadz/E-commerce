<?php
require_once  '../autoload.php';

use App\User;

session_start();

if (
	isset($_SESSION['user']->id)
	||
	!isset($_POST['email'])
) header('location: ../../');

if ($user = User::auth($_POST['email'], $_POST['password'])) {
	$_SESSION['user'] = $user;

	if ($admin_id = $user->isAdmin())
		$_SESSION['admin_id'] = $admin_id;

	header('location: ../../');
}

return_to_login('red', 'Wrong email or password.');

function return_to_login($flag, $message)
{
	header("location: ../../login?fn=$flag&fn_message=$message");
	exit;
}
