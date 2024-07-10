<?php

class Movie extends Controller {

  public function index() {
    $api = $this->model('Api');

    $movie_title = "the matrix";
    $movie = $api->getMovie($movie_title);
    $this->view('movie/index' , ['movie' => $movie]);
  }

  public function search() {
    // if (!isset($_REQUEST['movie'])) {
    //   //redirect to /movie
    //   header('location: /');
    // }

    $api = $this->model('Api');

    $movie_title = "the matrix";
    $movie = $api->getMovie($movie_title);

    

    $this->view('movie/results', ['movie' => $movie]);
    header('location: /movie/results');
  }

  public function review($rating = '') {
    //if rating blah blah
  } 

  
}