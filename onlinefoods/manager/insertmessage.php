 
<?php 

   

 include ('dbh.inc.php');
 
 

include('header/restaurantheader.php');
if(($_SESSION['login'])){
  $customerid = $_SESSION['customerid'];
 $_SESSION['customerid'] = $customerid;
  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
  $restid = $_SESSION['restaurantid']; 
  $_SESSION['restaurantid'] =$restid;
 

  
}
else{  header("location: onlinefoods/employee/index.php");}
  $customerid = $_SESSION['customerid'];
 $_SESSION['customerid'] = $customerid;
  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
  $restid = $_SESSION['restaurantid']; 
  $_SESSION['restaurantid'] =$restid;
 
 
?>
 
 <?php
 

 

 if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(isset($_POST['rsend'])){
$output="";
echo $fromuser=$_POST['fromuser'];
echo $touser=$_POST['touser'];
echo $message=$_POST['message'];
$status='NEW';
$sql = "INSERT INTO messages (FromUser,ToUser,Message,status)
VALUES ('$fromuser','$touser','$message','$status')";
if($conn -> query($sql))
{
	$output.="";
	header("Location: resturant_message.php?cid=$customerid "); 
}
else{
	$output.="Error";
}
echo $output;
}}
?>