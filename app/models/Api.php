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
}
?>