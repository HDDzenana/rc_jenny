<?php

// Allow any origin to access our API
header("Access-Control-Allow-Origin: *"); 

// Allow only these HTTP methods to be used on our API
header("Access-Control-Allow-Methods: POST, PUT, GET, DELETE");

// Allow the following headers in requests made to our API
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$tolken = "sk_test_1x1_4d6291727cece28a966025aaefa1503b6853a2698b6be6d0707c1192dcae45dd";
$version = "2021-11";




$postData = file_get_contents("php://input");
$request = json_decode($postData, true);
$id = $_POST['id'];

// VARS
$processor_name = $_POST["processor_name"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$city = $_POST["city"];
$company = $_POST["company"];
$country_code = $_POST["country_code"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$phone = $_POST["phone"];
$province = $_POST["province"];
$zip = $_POST["zip"];
  
$data = [ 
    'adress1' => $address1,
    'adress2' => $address2,
    'city' => $city,
    'company' => $company,
    'country_code' => $country_code,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'phone' => $phone,
    'province' => $province,
    'zip' => $zip,
];



$request = curl_init();

curl_setopt_array($request, array(
    CURLOPT_URL => "https://api.rechargeapps.com/payment_methods/$id",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "X-Recharge-Version: $version",
        "X-Recharge-Access-Token: $tolken"
    ),
));

$response = curl_exec($request);

if (!$response) {
    echo json_encode(['error' => curl_error($request)]);
} else {
    // Send response as JSON
    header('Content-Type: application/json');
    echo $response;
}

curl_close($request);

?>