<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;
$keySecret = '54353453jo5lj3o4i5j';
$keyId ='sfdsfsrer80wr80w8r90';
$api = new Api($keyId, $keySecret);

include("isdk.php");

$name 		= 	$_POST['name'];
$email		= 	$_POST['email'];
$phone 		= 	$_POST['phone'];
$add		=	$_POST['address'];
$pin		=	$_POST['pin'];
$city		=	$_POST['city'];
$state		=	$_POST['state'];
$total 		= 	$_POST['price'];

$_SESSION['total']= $total;

$app = new iSDK;
if ($app->cfgCon("connectionName")) 
{
	
	$contactId = $app->addWithDupCheck(array('FirstName' => $name, 'Email' => $email,'Phone1' => $phone), 'Email');
	$_SESSION["contactId"]	= 	$contactId;
	$_SESSION["name"]	=	$name;
	$_SESSION["email"]	=	$email;
	$_SESSION["phone"]	=	$phone;
	$_SESSION["address"]	=	$add;
	$_SESSION["pin"]	=	$pin;
	$_SESSION["city"]	=	$city;
	$_SESSION["state"]	=	$state;
	
	$groupId = 19199; 					// Registration speaktofortune.com/payment/
	$result = $app->grpAssign($contactId, $groupId);
   	
   	$grp = array('StreetAddress1'  => $add, 'PostalCode' => $pin , 'City' => $city ,'State' => $state);
	$query = $app->dsUpdate("Contact", $contactId, $grp);
 
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => $_SESSION["contactId"],
    'amount'          => $total * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);
// do not change any parameter regards orderdata

$razorpayOrderId = $razorpayOrder['id'];
 
//echo $razorpayOrderId;
$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

//$checkout = 'manual';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $name,
     "image"             => "https://domain.com/razorpay1/my_logo.png",
    "prefill"           => [
    "name"              => $name,
    "email"             => $email,
    "contact"           => $phone,
    "contact_id"         =>$contact_id,
    ],
    "notes"             => [
    "address"           => $add,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
    "contactid"         =>$contactId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");
}
?>
<script>
    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
</script>

