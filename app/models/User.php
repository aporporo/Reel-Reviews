<?php
session_start();


class User {

    public $username;
    public $password;
    public $auth = false;
    public $userid;
    

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function authenticate($username, $password) {
        /*
         * if username and password good then
         * $this->auth = true;
         */
		  $username = strtolower($username);
		  $db = db_connect();
      $statement = $db->prepare("select * from users WHERE username = :name;");
      $statement->bindValue(':name', $username);
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      //prepare log database to insert login attempts
      $logStatement = $db->prepare("INSERT INTO log (username, attempt, time) VALUES (:username, :attempt, now())");
      $logStatement->bindValue(':username', $username);
      //prepare log database to retrieve attempts
      $logFetch = $db->prepare("select * from log ORDER BY id DESC LIMIT 1");
      $logFetch->execute();
      $logRows = $logFetch->fetch(PDO::FETCH_ASSOC);
      $logTime = strtotime($logRows['time']);
      //If 3 or more failed attempts, lock out user for 60 seconds
      if ($_SESSION['failedAuth'] >= 3 && $logTime > (time() - 60)) {
        header('Location: /login');
        die;
        //Else continue to verify password
      } else {
    		if (password_verify($password, $rows['password'])) {
          $_SESSION['userid'] = $rows['id'];
          $_SESSION['auth'] = 1;
    			$_SESSION['username'] = ucwords($username);
          $_SESSION['permission'] = $rows['permission'];
          
          
    			unset($_SESSION['failedAuth']);
          // Sends successful login attempt to log database, 1 = success
          $logStatement->bindValue(':attempt', 1);
          $logStatement->execute();
    			header('Location: /home');
    			die;
    		} else {
    			if(isset($_SESSION['failedAuth'])) {
    				$_SESSION['failedAuth'] ++; //increment
            // Sends unsuccessful login attempt to log database, 0 = failure
            $logStatement->bindValue(':attempt', 0);
            $logStatement->execute();
          } else {
    				$_SESSION['failedAuth'] = 1;
            // Sends unsuccessful login attempt to log database, 0 = failure
            $logStatement->bindValue(':attempt', 0);
            $logStatement->execute();
    			}
    			header('Location: /login');
    			die;
    		}
      }
    }
    

  //create user and insert into user table
  public function create_user ($username, $password) {
    $db = db_connect();
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $statement = $db->prepare("INSERT INTO users (username, password) VALUES ('$username', '$hash')");
    $statement->execute();
    header('Location: /login');
    die;
  }

  //check if username exists in user table
  public function check_user_exists ($username) {
    $db = db_connect();
    $statement = $db->prepare("SELECT * FROM users WHERE username = '$username'");
    $statement->execute();
    $rows = $statement->fetch(PDO::FETCH_ASSOC);
    if (isset($rows['username'])) {
      return true;
    } else {
      return false;
    }

  }

  //gets all the login attempts from the log table, groups by username, and returns the count
  public function get_total_logins() {
    $db = db_connect();
    $statement = $db->prepare("select username, count(attempt) as count from log where attempt = 1 group by username order by count desc");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  //gets 3 random usernames not including the currently logged in user
  public function get_random_users() {
    $db = db_connect();
    $statement = $db->prepare("select username from users where username != :username order by rand() limit 3");
    $statement->bindValue(':username', $_SESSION['username']);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

}
