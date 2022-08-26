<?php
if($_POST['tokenId']) {
require_once('vendor/autoload.php');  //stripe secret key or revoke key
$stripeSecret = 'sk_test_51LaCWfSDChRBwbLfWBwRH8HZJ9rL4Cg6IIIclAri0CoxhlsPNszoiseqJYPoGjDVTXR6w7GhetNFUZPtWRgdmz6800wty03TEY';

\Stripe\Stripe::setApiKey($stripeSecret);
// Get the payment token ID submitted by the form:
$token = $_POST['tokenId'];
// Charge the user's card:
$charge = \Stripe\Charge::create(array(
"amount" => $_POST['amount'],
"currency" => "USD",
"description" => "stripe integration in PHP",
"source" => $token,
));
// after successfull payment, you can store payment related information into your database
$data = array('success' => true, 'data'=> $charge);
echo json_encode($data); 
}