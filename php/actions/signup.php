<?php
require_once  '../autoload.php';

use App\User;

session_start();

if (
	!isset($_SESSION['user']->id)
	||
	!isset($_POST['email'])
) header('location: ../../');

if ($_POST['password'] !== $_POST['password_conf'])
	return_to_signup('red', 'Passwords don\'t match');

if (User::emailExists($_POST['email']))
	return_to_signup('red', 'Account with this email already exist');

$params = [
	'first_name' => '',
	'last_name'  => '',
	'email'      => '',
	'password'   => ''
];

// check if all mandatory data is passed and assigning to params
foreach ($params as $key => $__) {
	if (empty($_POST[$key]))
		return_to_signup('red', 'Mandatory data missing');
	else
		$params[$key] = $_POST[$key];
}

//adding optional data
$optional = [
	'address',
	'phone_number',
	'birth_date'
];
foreach ($optional as $val)
	$params[$val] = empty($_POST[$val]) ? null : $_POST[$val];

//escaping input (prevent XSS)
foreach ($params as &$param)
	if ($param !== null)
		$param = htmlspecialchars($param, ENT_QUOTES, 'UTF-8');

//creating user
$_SESSION['user'] = User::create($params);

header('location: ../../');

function return_to_signup($flag, $message)
{
	header("location: ../../signup?fn=$flag&fn_message=$message");
	exit;
}
