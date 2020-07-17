<?php
require_once 'auth.php';
require_once '../autoload_actions.php';

use App\AdminUser;



if (!isset($_GET['order_id']) || !isset($_GET['order_status']))
	return_to_orders('red', 'Order status not updated, missing input');
elseif (!is_numeric($_GET['order_id']))
	return_to_orders('red', 'Order status not updated, invalid input');
elseif (!AdminUser::orderExists($_GET['order_id']))
	return_to_orders('red', 'Order status not updated, this order dose not exist!');

//deleting in the database
$result = AdminUser::updateOrderStatus($_GET['order_id'], $_GET['order_status']);

if ($result)
	return_to_orders('green', 'Order status updated successfully');
else
	return_to_orders('red', 'Order status not updated, unexpected error');

function return_to_orders($flag, $message)
{
	header("location: ../../view_order?order_id={$_GET['order_id']}&fn=$flag&fn_message=$message");
	exit;
}
