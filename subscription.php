<?php
header('Access-Control-Allow-Origin: *');
$address_id = $_POST["address_id"];
$variant_id = $_POST["variant_id"];
$date = $_POST["date"];
$frequency=$_POST["frequency"];
$unit=$_POST["unit"];
$price = $_POST["price"];
$title = $_POST["title"];
$tolken = "sk_2x2_e5a7fe08c2a8ac408d90247b373e1e78c26e196415dee7bced469f5fd95acc90";
$version = "2021-11";


$curl = curl_init();
$data = [
    "address_id" =>$address_id ,
    "charge_interval_frequency"=>$frequency,
    "next_charge_scheduled_at"=>$date,
    "order_interval_frequency"=>$frequency,
    "order_interval_unit"=>$unit,
    "external_variant_id" => ["ecommerce" =>$variant_id ],
    "quantity"=>1,
];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.rechargeapps.com/subscriptions',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    'X-Recharge-Access-Token: sk_2x2_e5a7fe08c2a8ac408d90247b373e1e78c26e196415dee7bced469f5fd95acc90',
    'X-Recharge-Version: 2021-11',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;




?>


