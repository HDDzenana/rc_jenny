<?php


header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 0);
$subid = $_POST["subid"];
$tolken = "sk_2x2_e5a7fe08c2a8ac408d90247b373e1e78c26e196415dee7bced469f5fd95acc90";
$version = "2021-11";

echo $subid;

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rechargeapps.com/subscriptions/$subid/activate",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
    "Content-Type: application/json",
  ),
));

$response = curl_exec($curl);


curl_close($curl);
echo $response;