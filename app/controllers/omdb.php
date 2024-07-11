<?php

class Omdb extends Controller {
  public function index() {
    
    $query_url = "http://www.omdbapi.com/?apikey=".$_ENV['OMDB_KEY']."&t=the+matrix&y=1999";
    $json = file_get_contents($query_url);
    $phpObj = json_decode($json);
    $movie =  (array) $phpObj;
    
    echo "<pre>";
    print_r ($movie);

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=".$_ENV['GEMINI'];

    $numbers = [2,4,6,8,10];
    for ($x = 0; $x <= 5; $x++) {
    $data = array(
      "contents" => array(
        array(
          "role" => "user",
          "parts" => array(
            array(
              "text" => 'Write the numbers 1 to '.$numbers[$x].' in reverse order',
              
            )
          )
        )
      )
    );

    $json_data = json_encode($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
      echo 'Curl error: ' . curl_error($ch);
    }

    // echo "<pre>";
    // echo $response;
    $phpObj = json_decode($response,true);
    $review = $phpObj['candidates'][0]['content']['parts'][0]['text'];
    echo "<pre>";
    echo $review;
    }
    die;

  }
}