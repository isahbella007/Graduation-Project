 
<?php 

   

 include ('dbh.inc.php');
 
 

include('header/restaurantheader.php');
if(($_SESSION['login'])){
  $customerid = $_SESSION['customerid'];
 
  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
  $restid = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
  $_SESSION['restaurantIdSelectedByLoggedInUser'] =$restid;
 

  
}else{  header("location: customerloginpage.php");}

if(isset($_POST['foodmenu_userNotLoggedIn'])){
  // This is the meal that the Guest user selected.
  echo $_POST['foodmenu_userNotLoggedIn'];
  echo "Not logged in";
  // This is the restaurant that the Guest user selected. 
  echo $_SESSION['restaurantIdSelectedByGuestUser'];
}
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<head>
    <link rel="stylesheet" href ="./css/cart.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
        Online Foods
        </a>
        <span >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if($_SESSION['login']){?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
          <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Logout</a>
                    </li>
                </ul>
            <?php }?>
            <?php if(isset($_POST['foodmenu_userNotLoggedIn'])){?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
                    <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
                </ul>
            <?php }?>
            </div>  
        </div>
    </nav>

 <?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(isset($_POST['send'])){
$output="";
echo $fromuser=$_POST['fromuser'];
echo $touser=$_POST['touser'];
echo $message=$_POST['message'];
echo $orderid=$_POST['orderid'];
 
 
$_SESSION['restaurantIdSelectedByLoggedInUser'] =$touser;
$touser = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
$status = "NEW";

$sql = "INSERT INTO messages (FromUser,ToUser,Message,status,orderid)
VALUES ('$fromuser','$touser','$message','$status','$orderid')";
if($conn -> query($sql))
{
  $output.="";
header("Location: message.php?orderid=$orderid");
}
else{
  $output.="Error";
}
echo $output;
}}

 

//  if($_SERVER["REQUEST_METHOD"]=="POST"){
//  if(isset($_POST['rsend'])){
// $output="";
// echo $fromuser=$_POST['fromuser'];
// echo $touser=$_POST['touser'];
// echo $message=$_POST['message'];

// $sql = "INSERT INTO messages (FromUser,ToUser,Message)
// VALUES ('$fromuser','$touser','$message')";
// if($conn -> query($sql))
// {
//  $output.="";
//  header("Location: resturant_message.php "); 
// }
// else{
//  $output.="Error";
// }
// echo $output;
// }}
?>