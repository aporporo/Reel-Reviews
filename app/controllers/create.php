<?php

class Create extends Controller {

    public function index() {		
      if (isset($_SESSION['userid'])) {
          header('location: /');
      }
	    $this->view('create/index');
    }

  public function verify() {
    session_unset();
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $password2 = $_REQUEST['password2'];
    $user = $this->model('User');
  
    //check username exists in database
    if ($user->check_user_exists($username)) {
      $_SESSION['username_error'] = 1;
      header ('location: /create');
    //check passwords match
    } else if ($password != $password2) {
      $_SESSION['password_match_error'] = 1;
      header ('location: /create');
    //check password length
    } else if (strlen($password) < 8) {
      $_SESSION['password_length_error'] = 1;
      header ('location: /create');
    //check password for at least one digit, one lowercase, one uppercase, and one special character
    } else if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,}$/', $password)) {
      $_SESSION['password_special_error'] = $password;
      header ('location: /create');
    //if all checks pass, create user
    } else {
      $user->create_user($username, $password);
      header ('location: /login');
    }
  }
}
