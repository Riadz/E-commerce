<?php
require_once '../autoload.php';

use App\User;

session_start();

if (
	!isset($_SESSION['user']->id)
	||
	!isset($_POST['email'])
) header('location: ../../');

if (
	$_SESSION['user']->email !== $_POST['email']
	&&
	User::emailExists($_POST['email'])
)
	return_to_account('red', 'Account with this email already exist');

// check if all mandatory data is passed and assigning to params
$params = [
	'first_name' => '',
	'last_name'  => '',
	'email'      => ''
];
foreach ($params as $key => $__) {
	if (empty($_POST[$key]))
		return_to_account('red', 'Mandatory data missing');
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

//updating information in database
$result = $_SESSION['user']->updateInformation($params);

if (!$result) {
	return_to_account('red', 'unexpected error, information not saved');
} else {

	//updating session variable
	foreach ($params as $key => $param) {
		$_SESSION['user']->$key = $param;
	}

	return_to_account('green', 'Information updated successfully!');
}

function return_to_account($flag, $message)
{
	header("location: ../../account?fn=$flag&fn_message=$message");
	exit;
}
