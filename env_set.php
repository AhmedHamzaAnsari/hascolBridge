<?php
$api_url = "http://151.106.17.246:8080/hascolbridgeApis/";
$api_url_files = "http://151.106.17.246:8080/hascolBridge_files/";



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '' . $api_url . '/get/get_settings.php?key=03201232927',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
)
);

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response, true);

// Access elements using array notation
$name = $data['name'];
$logo = $data['logo'];



?>