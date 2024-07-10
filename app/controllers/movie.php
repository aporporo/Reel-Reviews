<?php

class Movie extends Controller {

  public function index() {
    $this->view('movie/index');
  }

  public function search() {
    if (!isset($_REQUEST['movie'])) {
      //redirect to /movie
    }

    $api = this->model('Api');

    $movie_title = $_REQUEST['movie'];
    $movie = $api->getMovie($movie_title);

    echo "<pre>";
    print_r($movie);

    $this->view('movie/results', ['movie' => $movie]);
  }

  public function review($rating = '') {
    //if rating blah blah
  } 

  
}