<?php

define("API_HOST", "imdb8.p.rapidapi.com");
define("API_KEY", "a8818b1e0amsh4812456ddbb8ad9p183bd1jsnf0f931d70abb");
define("BASE_URL", "https://" . API_HOST);


$date = $_REQUEST["today"];

$endpoint = "/actors/v2/get-born-today?today=$date";
$url = BASE_URL . $endpoint;

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-RapidAPI-Host: " . API_HOST, "X-RapidAPI-Key: " . API_KEY]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
$decoded_response = json_decode($response, true);


curl_close($curl);

$curls = array();
$responses = array();
$actors_names = array();

$curl_multi_handle = curl_multi_init();

foreach ($decoded_response["data"]["bornToday"]["edges"] as $edge) {
    $id = $edge["node"]["id"];
    $endpoint = "/actors/v2/get-bio?nconst=$id";
    $url = BASE_URL . $endpoint;


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-RapidAPI-Host: " . API_HOST, "X-RapidAPI-Key: " . API_KEY]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_multi_add_handle($curl_multi_handle, $curl);
    $curls[$id] = $curl;
}


$running = null;
do {
    curl_multi_exec($curl_multi_handle, $running);
} while ($running > 0);


foreach ($curls as $id => $curl) {
    $response = curl_multi_getcontent($curl);
    curl_multi_remove_handle($curl_multi_handle, $curl);
    curl_close($curl);

    $decoded_response = json_decode($response, true);

    if (isset($decoded_response["data"]["name"]["nameText"]["text"]))
        $actors_names[] = $decoded_response["data"]["name"]["nameText"]["text"];
}

curl_multi_close($curl_multi_handle);

echo json_encode($actors_names) ;

?>

