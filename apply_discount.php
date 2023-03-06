<?php

header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 0);
$discode = $_POST["discode"];
$nxsh = $_POST["nxsh"];
$cid = $_POST["cid"];
$tolken = "sk_2x2_e5a7fe08c2a8ac408d90247b373e1e78c26e196415dee7bced469f5fd95acc90";
$version = "2021-11";

$curlchk = curl_init();

curl_setopt_array($curlchk, array(
  CURLOPT_URL => "https://api.rechargeapps.com/discounts?discount_code=$discode",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'X-Recharge-Access-Token: sk_2x2_e5a7fe08c2a8ac408d90247b373e1e78c26e196415dee7bced469f5fd95acc90',
    'X-Recharge-Version: 2021-11',
  ),
));

$responsechk = curl_exec($curlchk);

curl_close($curlchk);
$objchk = json_decode($responsechk, true);
$res =  (count($objchk["discounts"])); 

if($res == 0){
    echo "No such discount available";
}else{
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rechargeapps.com/charges?status=queued&customer_id=$cid&scheduled_at=$nxsh",
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

$response = curl_exec($curl);


curl_close($curl);
$obj = json_decode($response, true);
$chargeid = ($obj["charges"][0]["id"]);


$curl2 = curl_init();

curl_setopt_array($curl2, array(
  CURLOPT_URL => "https://api.rechargeapps.com/charges/$chargeid/apply_discount",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"discount_code": "'.$discode.'"}',
  CURLOPT_HTTPHEADER => array(
    "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
    "Content-Type: application/json",
  ),
));

$response2 = curl_exec($curl2);

curl_close($cur2l);
 echo "Discount applied";
}
