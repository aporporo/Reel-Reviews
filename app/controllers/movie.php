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
    $user_id = $_SESSION['userid'];
    $api = $this->model('Api');

    $movie_title = $_REQUEST['search'];
    echo $movie_title;
    $movie = $api->getMovie($movie_title);
    // echo print_r($movie);
    
    $movie_title = $movie['Title'];
    $movie_id = $api->getMovieIdByTitle($movie_title);
    $_SESSION['movie_id'] = $movie_id;
    echo $movie_id;
    // $review = $api->getReview($movie_title);
    $rating = $api->getRating($user_id, $movie_id);
    

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

  public function rating() {
    $rating = $_REQUEST['rating'];
    $user_id = $_SESSION['userid'];
    $movie_id = $_SESSION['movie_id'];
    $api = $this->model('Api');
    $api->rating($rating, $user_id, $movie_id);
    header('location: /movie/results');
  } 

  
}