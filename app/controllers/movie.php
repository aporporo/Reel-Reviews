<?php

class Movie extends Controller {

  public function index() {
    $api = $this->model('Api');

    //Pulls 3 random movies which users have successfully searched and returns them to view on this page
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

  //Search function which takes in a movie title and returns the movie to view on the results page
  public function search() {
    //If user has unsuccessfully search a movie, they will be redirected to this page
    unset($_SESSION['search_error']);
    if (!isset($_REQUEST['search']) || $_REQUEST['search'] == '') {
      
      header('location: /movie');
    }
    $user = $this->model('User');
    $user_id = $_SESSION['userid'];
    $api = $this->model('Api');
    $movie_title = $_REQUEST['search'];

    //Pulls movie from OMDb API and returns it to view
    $movie = $api->getMovie($movie_title);
    //If movie is found, it will be added to the ratings table, reviews will be generated, and the user will be redirected to the result page
    if ($movie != false ) {
      $movie_title = $movie['Title'];
      $movie_id = $api->getMovieIdByTitle($movie_title);
      $_SESSION['movie_id'] = $movie_id;
      
      $review = $api->getReview($movie_title);
      $rating = $api->getRating($user_id, $movie_id);

      $usernames = $user->get_random_users();
      

      $data = [
        'movie' => $movie,
        'rating' => $rating,
        'review' => $review,
        'usernames' => $usernames
      ];

      $this->view('movie/results', $data);
      header('location: /movie/results');
      //If movie is not found, the user will be redirected to the movie page with an error message
    } else {
      $_SESSION['search_error'] = 'Movie not found';
      $this->index();
    } 
  }

  //Function to rate a movie and store in database based on rating, userid, movie_id
   public function rating() {

     // if user is not logged in or incorrectly tries to access, redirect to login page
    if (!isset( $_SESSION['userid']) || $_REQUEST['rating'] == '') {
      header('location: /login');
    }
     
    $rating = $_REQUEST['rating']; //user selected rating
    $user_id = $_SESSION['userid']; //logged in user
    $movie_id = $_SESSION['movie_id']; //movie id from the results page
    
    $api = $this->model('Api');
    $movie_title = $api->getMovieById($movie_id);
    $movie = $api->getMovie($movie_title);

     // creates new rating or updates existing user specific rating, also returns the rating
    $api->rating($rating, $user_id, $movie_id);
    $rating = $api->getRating($user_id, $movie_id);

    $data = [
      'movie' => $movie,
      'rating' => $rating
    ];

    $this->view('movie/results', $data);
    header('location: /movie/results');
    
  } 

  
}