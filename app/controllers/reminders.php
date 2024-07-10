<?php

class Reminders extends Controller {

  //Displays the logged in user specific reminders in a table
  public function index() {
    $userid = $_SESSION['userid'];
    $reminder = $this->model('Reminder');
    $list_of_reminders = $reminder->get_reminders_by_user($userid);
    $this->view('reminders/index', ['reminders' => $list_of_reminders]);
  }

  //goes to the create reminder page
  public function create() {
    $reminder = $this->model('Reminder');
    $this->view('reminders/create');
  }
  //creates a new reminder
  public function new_reminder() {
    
    $subject = $_REQUEST['subject'];
    $userid = $_SESSION['userid'];
    $reminder = $this->model('Reminder');
    $reminder->create_reminder($subject, $userid);
    header ('location: /reminders');
  }
  //deletes a reminder
  public function delete($reminder_id) {
    $reminder = $this->model('Reminder');
    $reminder->delete_reminders($reminder_id);
    header ('location: /reminders');
  }

  //Completes a reminder
  public function completed($reminder_id) {
    $reminder = $this->model('Reminder');
    $reminder->complete_reminder($reminder_id);
    header ('location: /reminders');
  }

  //goes to the update reminder page
  public function update($reminder_id) {
    $reminder = $this->model('Reminder');
    $this->view('reminders/update', ['reminder' => $reminder->get_reminder($reminder_id)]);
  }

  //updates a reminder by its reminder id
  public function update_reminder() {
    $subject = $_REQUEST['subject'];
    $reminder_id = $_REQUEST['reminder_id'];
    $reminder = $this->model('Reminder');
    $reminder->update_reminders($subject, $reminder_id);
    header ('location: /reminders');
  }
}
?>