<!--
=========================================================
* Material Dashboard Dark Edition - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard-dark
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
require ('../../database/database.php');
$conn = openDatabase();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
  	Npontu-Events
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Npontu Events
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item" id="active">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_event.html">
              <i class="material-icons">addition</i>
              <p>Add Event</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_conference.html">
              <i class="material-icons">addition</i>
              <p>Add Conference</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="view_conferences.php">
              <i class="material-icons">content_paste</i>
              <p>Conference Attendees</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
            <div class="float-right">
              <a class="navbar-brand" href="../../index.php"><i class="material-icons">home</i></a>
            </div>   
            <div class="float-right">
              <a class="navbar-brand" href="../../index.php"><i class="material-icons">home</i></a>
            </div>  
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../../index.php">
                  <i class="material-icons">logout</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
      
          </div>
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">events</i>
                  </div>
                  <p class="card-category">Events</p>
                  <h3 class="card-title">
                  <?php
                  $sql = "SELECT COUNT(*) FROM event;";
                  $count = $conn->query($sql);
                  if($count){
                  $results = mysqli_fetch_assoc($count);
                  echo $results['COUNT(*)'];   
                  }               
                  ?>
                  </h3>

                </div>

              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">events</i>
                  </div>
                  <p class="card-category">Conferences</p>
                  <h3 class="card-title">
                  <?php
                  $sql = "SELECT COUNT(*) FROM conference;";
                  $count = $conn->query($sql);
                  if($count){
                  $results = mysqli_fetch_assoc($count);
                  echo $results['COUNT(*)'];   
                  }               
                  ?>
                  </h3>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Current Events</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <th class="text-warning"> Event Name</th>
                      <th class="text-warning">Ticket Price</th>
                      <th class="text-warning">Tickets Left</th>
                    </thead>
                    <tbody>

                  <?php
                  $sql = "SELECT * FROM event";
                  $results = $conn->query($sql);
                  if($results){
                    foreach($results as $result){
                      echo "<tr>";
                      echo "<td>".$result['event_name']."</td>"; 
                      echo "<td>".$result['event_price']."</td>";   
                      echo "<td>".$result['tickets_left']."</td>"; 
                      echo "</tr>";
                  }       
                }        
                  ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Current Conferences</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th class="text-warning">Conference name</th>
                      <th class="text-warning">Seats available</th>
                      <th class="text-warning"> Seats left</th>
                    </thead>
                    <tbody style="align-center"> 
                    <?php
                  $sql = "SELECT * FROM conference";
                  $results = $conn->query($sql);
                  if($results){
                    foreach($results as $result){
                      echo "<tr>";
                      echo "<td>".$result['conf_name']."</td>"; 
                      echo "<td>".$result['conf_seats_available']."</td>";   
                      echo "<td>".$result['conf_seats_left']."</td>"; 
                      echo "</tr>";
                  }       
                }        
                  ?>
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
     
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
             
            </ul>
          </nav>
          <div class="copyright float-right" id="date">
            , made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
      <script>
        const x = new Date().getFullYear();
        let date = document.getElementById('date');
        date.innerHTML = '&copy; ' + x + date.innerHTML;
      </script>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script src="../assets/js/system.js"></script>
  <script src="../assets/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


</body>

</html>