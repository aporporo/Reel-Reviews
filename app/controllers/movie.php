<?php

class Movie extends Controller {

  public function index() {
    $api = $this->model('Api');

    $movie_title = "the matrix";
    $movie = $api->getMovie($movie_title);
    $review = $api->getReview($movie_title);
    $data = [
      'movie' => $movie,
      'review' => $review
    ];
    $this->view('movie/index' , $data);
  }

  public function find($movie_title) {
    $api = $this->model('Api');
    $this->view('movie/results/', $movie_title);
  }

  public function search() {
    // if (!isset($_REQUEST['movie'])) {
    //   //redirect to /movie
    //   header('location: /');
    // }

    $api = $this->model('Api');

    $movie_title = $_REQUEST['search'];
    echo $movie_title;
    $movie = $api->getMovie($movie_title);
    // $review = $api->getReview($movie_title);
    

    $data = [
      'movie' => $movie,
      // 'review' => $review,
     
    ];

    

    $this->view('movie/results', $data);
    header('location: /movie/results');
  }

  public function searchByTitle($movie_title) {
    

    $api = $this->model('Api');

    $movie_title = "the matrix";
    $movie = $api->getMovie($movie_title);
    $review = $api->getReview($movie_title);
    

    $data = [
      'movie' => $movie,
      'review' => $review,
      
    ];



    $this->view('movie/results', $data);
    header('location: /movie/results');
  }

  public function review($rating = '') {
    //if rating blah blah
  } 

  
}