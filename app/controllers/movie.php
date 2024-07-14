<?php

class Movie extends Controller {

  public function index() {
    $api = $this->model('Api');

    $movies = $api->getThreeRandomMovies();
    
    $movie1 = $api->getMovie($movies[0]['movie_title']);
    $movie2 = $api->getMovie($movies[1]['movie_title']);
    $movie3 = $api->getMovie($movies[2]['movie_title']);
    
    $data = [
      'movie1' => $movie1,
      'movie2' => $movie2,
      'movie3' => $movie3
    ];
    $this->view('movie/index' , $data);
  }

  public function find($movie_title) {
    $api = $this->model('Api');
    $this->view('movie/results/', $movie_title);
  }

  public function search() {
    unset($_SESSION['search_error']);
    if (!isset($_REQUEST['search']) || $_REQUEST['search'] == '') {
      
      header('location: /movie');
    }
    $user_id = $_SESSION['userid'];
    $api = $this->model('Api');

    $movie_title = $_REQUEST['search'];
    
    $movie = $api->getMovie($movie_title);
    if ($movie != false ) {
      $movie_title = $movie['Title'];
      $movie_id = $api->getMovieIdByTitle($movie_title);
      $_SESSION['movie_id'] = $movie_id;
      echo $movie_id;
      // $review = $api->getReview($movie_title);
      $rating = $api->getRating($user_id, $movie_id);

      $data = [
        'movie' => $movie,
        'rating' => $rating
        // 'review' => $review,
      ];

      $this->view('movie/results', $data);
      header('location: /movie/results');
    } else {
      $_SESSION['search_error'] = 'Movie not found';
      $this->index();
    }
    // echo print_r($movie);
    
    
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
    $movie_title = $api->getMovieById($movie_id);
    $movie = $api->getMovie($movie_title);
    
    $api->rating($rating, $user_id, $movie_id);
    $rating = $api->getRating($user_id, $movie_id);

    $data = [
      'movie' => $movie,
      'rating' => $rating
    ];

    $this->view('movie/results', $data);
    header('location: /movie/results');
    
    
    // header('location: /movie/results');
  } 

  
}