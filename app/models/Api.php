<?php

class Api {

    

  public function __construct() {
  }

   public function getMovie($movie_title) {
      $omdb_title = str_replace(' ', '+', $movie_title);
      $query_url = "http://www.omdbapi.com/?apikey=".$_ENV['OMDB_KEY']."&t=$omdb_title";
      $json = file_get_contents($query_url);
      $phpObj = json_decode($json);
      $movie =  (array) $phpObj;
      return $movie;
  }

  public function getReview($movie_title) {
    $reviews_array = [];
    $random_ratings = [rand(1, 5), rand(1, 5), rand(1, 5), rand(1, 5)];
    $review_emotion = ['terrible', 'bad', 'average', 'good', 'great'];
    for ($x = 0; $x < 4; $x++) {
      $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=".$_ENV['GEMINI'];
  
      $data = array(
        "contents" => array(
          array(
            "role" => "user",
            "parts" => array(
              array(
                "text" => 'Write a '.$review_emotion[$random_ratings[$x] - 1].' short witty review for the movie '.$movie_title.' in the style of a letterboxd review. no *, include a few emojis, do not put the movie title at the beginning, do not include a number rating.'
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
  
      $phpObj = json_decode($response, true);
      $review = $phpObj['candidates'][0]['content']['parts'][0]['text'];
      $reviews_array[$x] = $review;
      // $reviews_array[$x][0] = $random_ratings[$x];
      
    }
    $reviews_ratings_array = [$random_ratings, $reviews_array];
    print_r($random_ratings);
    echo 'Write a '.$review_emotion[$random_ratings[0]].' short witty review for the movie '.$movie_title.' in the style of a letterboxd review. no *, include a few emojis, do not put the movie title at the beginning.';
    echo $review_emotion[$random_ratings[0]];
    return $reviews_ratings_array;
  }
  
}
?>