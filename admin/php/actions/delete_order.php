<?php
require_once 'auth.php';
require_once '../autoload_actions.php';

use App\AdminUser;



if (!isset($_GET['order_id']))
	return_to_orders('red', 'Order not deleted, missing input');
elseif (!is_numeric($_GET['order_id']))
	return_to_orders('red', 'Order not deleted, invalid input');
elseif (!AdminUser::orderExists($_GET['order_id']))
	return_to_orders('red', 'Order not deleted, this order dose not exist!');


//deleting in the database
$result = AdminUser::deleteOrder($_GET['order_id']);

if ($result)
	return_to_orders('green', 'Order deleted successfully');
else
	return_to_orders('red', 'Order not deleted, unexpected error');

function return_to_orders($flag, $message)
{
	header("location: ../../orders?fn=$flag&fn_message=$message");
	exit;
}
