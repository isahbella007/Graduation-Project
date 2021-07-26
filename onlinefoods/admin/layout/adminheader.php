<?php

$r = "SELECT name FROM restaurant";
$rr = $conn->prepare($r);
$rr->execute();
$result = $rr->fetchAll(PDO::FETCH_ASSOC);

// Get the number of pending restaurants
$pendingRestaurant = "SELECT COUNT(FLAG) FROM restaurant WHERE FLAG = 'PENDING'";
$pendingRestaurantStat = $conn->prepare($pendingRestaurant);
$pendingRestaurantStat->execute();
$pendingRestaurantResult = $pendingRestaurantStat->fetchAll(PDO::FETCH_ASSOC);

// Get the number of confirmed restaurnats
$confirmedRestaurant = "SELECT COUNT(FLAG) FROM restaurant WHERE FLAG = 'CONFIRMED'";
$confirmedRestaurantStat = $conn->prepare($confirmedRestaurant);
$confirmedRestaurantStat->execute();
$confirmedRestaurantResult = $confirmedRestaurantStat->fetchAll(PDO::FETCH_ASSOC);

// Get the number of suspended restaurants
$suspendedRestaurant = "SELECT COUNT(FLAG) FROM restaurant WHERE FLAG = 'SUSPENDED'";
$suspendedRestaurantStat = $conn->prepare($suspendedRestaurant);
$suspendedRestaurantStat->execute();
$suspendedRestaurantResult = $suspendedRestaurantStat->fetchAll(PDO::FETCH_ASSOC);

// Get the number of fired employees from every restaurant
$firedEmployees = "SELECT COUNT(status) FROM appeal WHERE status = 'NEW'";
$firedEmployeesStmt = $conn->prepare($firedEmployees);
$firedEmployeesStmt->execute();
$numberOfAppeal = $firedEmployeesStmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet"  href="css/adminheader.css">
 <style>
       input[type=submit] {
        padding: 5px 15px;
        background: #b8bfce;;
        border: 0 none;
        cursor: pointer;
        -webkit-border-radius: 5px;
        border-radius: 5px;
      }
  </style>

</head>

<body>
  
<div class="page-wrapper chiller-theme toggled col-md-4">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">Welcome</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
      <?php if(isset($_SESSION['login'])){?>
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="images/<?php echo $_SESSION['adminImage'];?>"
            alt="User picture">
        </div>
        
        <div class="user-info">
          <span class="user-name"><?php echo $_SESSION['adminName']?>
            <strong>Smith</strong>
          </span>
          <span class="user-role">Administrator</span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
        <?php } ?>
      </div>
      <!-- sidebar-header  -->
     
        <!-- </div> -->
      <!-- </div> -->
      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-stop"></i>
              <span>Restaurants</span>
            </a>
             <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="pending.php">Pending Restaurants
                     <span class="badge badge-pill badge-danger"><?php foreach($pendingRestaurantResult as $pendingResult){?> <?php echo implode($pendingResult);?> <?php }?> </span>
                  </a>
                  </li>
                  <li>
                    <a href="confirmedrestaurant.php">Confirmed Restaurants
                     <span class="badge badge-pill badge-success"><?php foreach($confirmedRestaurantResult as $confirmedResult){?> <?php echo implode($confirmedResult);?> <?php }?></span>
                  </a>
                  </li>
                   <li>
                    <a href="suspendedrestaurant.php">Suspended Restaurants
                     <span class="badge badge-pill badge-danger"><?php foreach($suspendedRestaurantResult as $suspendedResult){?> <?php echo implode($suspendedResult);?> <?php }?></span>
                  </a>
                  </li>
                </ul>
            </div>
          
            
          </li>

          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-stop"></i>
              <span>Restaurants Appeal</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="view_appeal.php">view All
                    <span class="badge badge-pill badge-danger"><?php foreach($numberOfAppeal as $noa){?> <?php echo implode($noa);?> <?php }?></span>
                  </a>
                </li>
               
              </ul>
            </div>
          </li>

          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-stop"></i>
              <span>Customer Complaint</span>
              
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="customers_complains.php">All Complains
                     
                  </a>
                </li>
                
              </ul>
            </div>
          </li>
  
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a>
      <a href="adminlogout.php">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  
  <!-- page-content" -->
</div>
<!-- page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

        <script >jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});


   
   
});</script>
    



<?php 
include('layout/adminfooter.php');
?>