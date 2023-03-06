<?php
header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 0);
$tolken = "sk_2x2_e5a7fe08c2a8ac408d90247b373e1e78c26e196415dee7bced469f5fd95acc90";
$version = "2021-11";

$subid = $_POST["subid"];
$nxt = $_POST["nxt"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rechargeapps.com/charges?purchase_item_ids=$subid&status=queued&scheduled_at=$nxt",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
     "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$obj = json_decode($response, true);

$chargid = ($obj["charges"][0]["id"]);

$cid = ($obj["charges"][0]["line_items"]);

$total = count($cid);
$allpro = [];
for($i = 0; $i<=$total-1;$i++){
    $allpro[] = $obj["charges"][0]["line_items"][$i]["purchase_item_id"];
}

$linitms =  json_encode($allpro);


$curl2 = curl_init();

curl_setopt_array($curl2, array(
  CURLOPT_URL => "https://api.rechargeapps.com/charges/$chargid/skip",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"purchase_item_ids":'.$linitms.'}',
  CURLOPT_HTTPHEADER => array(
     "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
    "Content-Type: application/json",
  ),
));

$response2 = curl_exec($curl2);

curl_close($curl2);
echo $response2;





