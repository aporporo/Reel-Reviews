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

  public function search() {
    // if (!isset($_REQUEST['movie'])) {
    //   //redirect to /movie
    //   header('location: /');
    // }

    $api = $this->model('Api');

    $movie_title = "the matrix";
    $movie = $api->getMovie($movie_title);
    $review = $api->getReview($movie_title);
    // $review2 = $api->getReview($movie_title);
    // $review3 = $api->getReview($movie_title);
    // $review4 = $api->getReview($movie_title);

    $data = [
      'movie' => $movie,
      'review' => $review,
      // 'review2' => $review,
      // 'review3' => $review,
      // 'review4' => $review
    ];

    

    $this->view('movie/results', $data);
    header('location: /movie/results');
  }

  public function review($rating = '') {
    //if rating blah blah
  } 

  
}