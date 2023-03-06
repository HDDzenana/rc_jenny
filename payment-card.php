<?php
header('Access-Control-Allow-Origin: *');

$tolken = "sk_2x2_e5a7fe08c2a8ac408d90247b373e1e78c26e196415dee7bced469f5fd95acc90";
$version = "2021-11";
$email = $_POST["email"];

$request = curl_init();
curl_setopt_array($request, array(
  CURLOPT_URL => "https://api.rechargeapps.com/customers?email=$email",
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
