<?php 
if ($_SESSION['permission'] != 2) {
    header('Location: /');
}

$dataMostReminders = array();
$dataTotalLogins = array();

require_once 'app/views/templates/header.php' 

?>
<style>
    body {
        background-image: url('https://i.imgur.com/EZQ0Pw0.jpeg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .nav-link {
        color: white;
    }
    .nav-link.active {
        color: black; 
    }

    .nav-link:hover {
        color: #ddd
    }

    .breadcrumb .breadcrumb-item a {
       color: white; 
       text-decoration: none; 
    }

     .breadcrumb .breadcrumb-item::before {
      color: white;
    }

    .breadcrumb .breadcrumb-item.active {
      color: #bbb; 
    }

     .breadcrumb .breadcrumb-item a:hover {
      color: #ddd; 
    } 
</style>
<script>

</script>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reports</li>
                  </ol>
                </nav>
                <div class="col-lg-12">
                  <br>
                <h1 style="color: white">Admin Reports</h1>
                
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">View all reminders</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Most reminders</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Total logins by username</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th>Reminder ID</th>
                  <th>User ID</th>
                  <th>Username</th>
                  <th>Reminder</th>
                  <th>Date Created</th>
                  <th>Completed</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $counter = 1;
                foreach ($data['reminders'] as $reminder) { ?>
                    <tr>
                        <td><?php echo $counter++ ?></td>
                        <td><?php echo $reminder['id']; ?></td>
                        <td><?php echo $reminder['user_id']; ?></td>
                        <td><?php echo $reminder['username']; ?></td>
                        <td><?php echo $reminder['subject']; ?></td>
                        <td><?php echo $reminder['created_at'] ?></td>
                        <td><?php echo $reminder['is_completed'] ?></td>
                    </tr>
                <?php } ?>
              </tbody>
            </table>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Reminders</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $counter = 1;
              foreach ($data['most_reminders'] as $most_reminder) { 
                $dataMostReminders[] = array(
                  "y" => $most_reminder['count'], 
                  "label" => $most_reminder['username']
                );
                ?>
                  <tr>
                      <td><?php echo $counter++ ?></td>
                      <td><?php echo $most_reminder['user_id']; ?></td>
                      <td><?php echo $most_reminder['username']; ?></td>
                      <td><?php echo $most_reminder['count']; ?></td>
                  </tr>
              <?php } ?>
            </tbody>
          </table>
        <div id="chartMostReminders" style="height: 370px; width: 100%;"></div>
        
      </div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th>Username</th>
                  <th>Successful Logins</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $counter = 1;
                foreach ($data['total_logins'] as $total_logins) { 
                  $dataTotalLogins[] = array(
                    "y" => $total_logins['count'], 
                    "label" => $total_logins['username']
                  );
                  ?>
                    <tr>
                        <td><?php echo $counter++ ?></td>
                        <td><?php echo $total_logins['username']; ?></td>
                        <td><?php echo $total_logins['count']; ?></td>
                    </tr>
                <?php } ?>
              </tbody>
            </table>
        <div id="chartTotalLogins" style="height: 370px; width: 100%;"></div>
        
        <div><br></div>
      </div>
    </div>
      <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function () {

        var chart = new CanvasJS.Chart("chartTotalLogins", {
          animationEnabled: true,
          theme: "light2",
          title:{
            text: "Total Logins by Username"
          },
          axisY: {
            title: "Successful Logins"
          },
          data: [{
            type: "column",
            yValueFormatString: "#,##0 logins",

            dataPoints: <?php echo json_encode($dataTotalLogins, JSON_NUMERIC_CHECK); ?>
          }]
        });
        chart.render();

          var chart2 = new CanvasJS.Chart("chartMostReminders", {
            animationEnabled: true,
            theme: "light2",
            title:{
              text: "Reminders by Username"
            },
            axisY: {
              title: "Reminders"
            },
            data: [{
              type: "column",
              yValueFormatString: "#,##0 reminders",

              dataPoints: <?php echo json_encode($dataMostReminders, JSON_NUMERIC_CHECK); ?>
            }]
          });
          chart2.render();
        });
      </script>
    <?php require_once 'app/views/templates/footer.php' ?>