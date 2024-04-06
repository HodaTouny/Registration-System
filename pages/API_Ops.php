<?php

$curls = array();
$responses = array();
$actors_names = array();

$curl_multi_handle = curl_multi_init();

$ids_url = "https://imdb8.p.rapidapi.com/actors/v2/get-born-today?today=05-15";

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $ids_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-RapidAPI-Host: imdb8.p.rapidapi.com", "X-RapidAPI-Key: 8e7f459ccfmsha4b3e9d7a4b4df1p1b6b4ejsncd1a5429c758"]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
$decoded_response = json_decode($response, true);

curl_close($curl);

// print_r($decoded_response);

foreach ($decoded_response["data"]["bornToday"]["edges"] as $edge) {
    $id = $edge["node"]["id"];
    $url = "https://imdb8.p.rapidapi.com/actors/v2/get-bio?nconst=$id";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-RapidAPI-Host: imdb8.p.rapidapi.com", "X-RapidAPI-Key: 8e7f459ccfmsha4b3e9d7a4b4df1p1b6b4ejsncd1a5429c758"]);
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
    $actors_names[] = $decoded_response["data"]["name"]["nameText"]["text"];
}

curl_multi_close($curl_multi_handle);

print_r($decoded_response);



/*
$curls = [];
$responses = [];
$actors_names = [];



$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://imdb8.p.rapidapi.com/actors/v2/get-born-today?today=05-15");
curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-RapidAPI-Host: imdb8.p.rapidapi.com", "X-RapidAPI-Key: 8e7f459ccfmsha4b3e9d7a4b4df1p1b6b4ejsncd1a5429c758"]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

curl_close($curl);


$decoded_response = json_decode($response, true);
// echo $decoded_response; 

$actors_ids = [];

// echo $response->data;   
foreach($decoded_response["data"]["bornToday"]["edges"] as $edge){
    $actors_ids[] = $edge["node"]["id"];    
}

// print_r($actors_ids);
$actors_names = [];

foreach($actors_ids as $id){
    $curl = curl_init();

   curl_setopt($curl, CURLOPT_URL, "https://imdb8.p.rapidapi.com/actors/v2/get-bio?nconst=$id");
   curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-RapidAPI-Host: imdb8.p.rapidapi.com", "X-RapidAPI-Key: 8e7f459ccfmsha4b3e9d7a4b4df1p1b6b4ejsncd1a5429c758"]);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curl);
  $decoded_response = json_decode($response,true);
  $actors_names[] =  $decoded_response["data"]["name"]["nameText"]["text"]; 

  curl_close($curl);
}

print_r($actors_names);
*/
?>

