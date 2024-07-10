<?php

class Reminder {

    public $subject;
    public $userid;
  
    public function __construct() {
    }

    //Selects all reminders from the database and returns them
    public function get_all_reminders () {
      $db = db_connect();
      $statement = $db->prepare("select * from reminders, users where reminders.user_id = users.id;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    //Selects reminders from specific user logged in
    public function get_reminders_by_user($userid) {
      $db = db_connect();
      $statement = $db->prepare("select * from reminders where user_id = '$userid';");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    //Selects a reminder from the database by its ID and returns it
    public function get_reminder($reminder_id) {
      $db = db_connect();
      $statement = $db->prepare("select * from reminders where id = '$reminder_id';");
      $statement->execute();
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      return $row;
    }

    //Gets all reminders and counters reminders per user, and username from users table
    public function get_most_reminders_by_user() {
      $db = db_connect();
      
      $statement = $db->prepare("select users.username, reminders.user_id, count(reminders.id) as count from users, reminders where users.id = reminders.user_id group by users.username order by count desc;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    
    //Updates a reminders subject in the database by its reminder ID
    public function update_reminders ($subject, $reminder_id) {
      $db = db_connect();
      $statement = $db->prepare("UPDATE reminders SET subject = ('$subject') WHERE id = '$reminder_id'");
      $statement->execute();
      header('Location: /reminders');
      die;
    }

    //Creates a new reminder in the database
    public function create_reminder ($subject, $userid) {
        
      $db = db_connect();
      $statement = $db->prepare("INSERT INTO reminders (subject, user_id) VALUES ('$subject', '$userid')");
      $statement->execute();
      header('Location: /reminders');
      die;
    }

    //Deletes a reminder from the database by its reminder ID
    public function delete_reminders ($reminder_id) {
      $db = db_connect();
      $statement = $db->prepare("DELETE FROM reminders WHERE id = '$reminder_id'");
      $statement->execute();
      header('Location: /reminders');
      die;
    }

    //Sets a reminders completed flag (1 or 0) in the database by its reminder ID
    public function complete_reminder ($reminder_id) {
      $db = db_connect();
      
      $fetch = $db->prepare("SELECT is_completed FROM reminders WHERE id = '$reminder_id'");
      
      $fetch->execute();
      $reminder = $fetch->fetch(PDO::FETCH_ASSOC);
      $reminder_completed = $reminder['is_completed'];
      if ($reminder_completed == 0) {
        $statement = $db->prepare("UPDATE reminders SET is_completed = 1 WHERE id = '$reminder_id'");
        $statement->execute();
      } else {
        $statement = $db->prepare("UPDATE reminders SET is_completed = 0 WHERE id = '$reminder_id'");
        $statement->execute();
      }
      header('Location: /reminders');
      die;
    }
}
?>