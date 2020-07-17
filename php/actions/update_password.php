<?php
require_once  '../autoload.php';

session_start();

if (
	!isset($_SESSION['user']->id)
	||
	!isset($_POST['password'])
) header('location: ../../');

if ($_POST['password'] !== $_POST['password_conf'])
	return_to_account('red', 'Passwords don\'t match');

//updating password in database
$result = $_SESSION['user']->updatePassword($_POST['old_password'], $_POST['password']);

if ($result) return_to_account('green', 'Password updated successfully!');
else return_to_account('red', 'The old password you entered is wrong');

function return_to_account($flag, $message)
{
	header("location: ../../account?fn=$flag&fn_message=$message");
	exit;
}
