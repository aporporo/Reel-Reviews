<?php

class Reports extends Controller {

  //Displays the logged in user specific reminders in a table
  public function index() {
    $reminder = $this->model('Reminder');
    $user = $this->model('User');
    $list_of_reminders = $reminder->get_all_reminders();
    $list_of_most_reminders = $reminder->get_most_reminders_by_user();
    $list_of_total_logins = $user->get_total_logins();
    $data = [
      'reminders' => $list_of_reminders,
      'most_reminders' => $list_of_most_reminders,
      'total_logins' => $list_of_total_logins
    ];
    $this->view('reports/index', $data);
  }

  
}
?>