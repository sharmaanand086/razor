<?php 
session_start();
require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

use Razorpay\Api\Api;
$keySecret = 'ks7jbICyQ6odsfsfsfsfMHBGpv';
$keyId ='rzp_live_XsdfsfsfsdfJJfj';
$api = new Api($keyId, $keySecret);

include("isdk.php");

$name 		= 	$_POST['name'];
$email		= 	$_POST['email'];
$phone 		= 	$_POST['phone'];
$total      = 	$_POST['total'];

$app = new iSDK;
if ($app->cfgCon("connectionName")) 
{
    $contactId = $app->addWithDupCheck(array('FirstName' => $name, 'Email' => $email,'Phone1' => $phone), 'Email');
    $groupId = 762323202; 					// Registration sdfsfs.com/payment/
	$result = $app->grpAssign($contactId, $groupId);
	
	$orderData = [
    'receipt'         => $contactId,
    'amount'          => $total * 100, // 2000 rupees in paise
    'currency'        => 'USD',
    'payment_capture' => 1 // auto capture
    ];
    
    $razorpayOrder = $api->order->create($orderData);
    // do not change any parameter regards orderdata
    
    $razorpayOrderId = $razorpayOrder['id'];
     
    //echo $razorpayOrderId;
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
	echo $razorpayOrderId."-".$contactId;
}

?>
