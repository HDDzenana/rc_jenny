<?php
header('Access-Control-Allow-Origin: *');

$tolken = "sk_test_1x1_4d6291727cece28a966025aaefa1503b6853a2698b6be6d0707c1192dcae45dd";
$version = "2021-11";
$cid = $_POST["cid"];

$cid = intval($_POST["cid"]); 
$request = curl_init();
curl_setopt_array($request, array(
  CURLOPT_URL => "https://api.rechargeapps.com/payment_methods?customer_id=$cid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version"
  ), 
));

$response = curl_exec($request);

if (!$response) {
    echo json_encode(['error' => curl_error($request)]);
} else {
    // Send customer details as JSON
    header('Content-Type: application/json');
    echo $response;
}

curl_close($request);
?>
