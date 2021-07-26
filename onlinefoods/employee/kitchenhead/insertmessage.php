 
<?php 

   

 include ('dbh.inc.php');
 
 

// include('header/restaurantheader.php');
if(($_SESSION['login'])){
 
  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
  $restid = $_SESSION['restaurantid']; 
  $_SESSION['restaurantid'] =$restid;
 

  
}
else{  header("location: onlinefoods/employee/index.php");}
  echo $customerid = $_SESSION['customerid'];
 $_SESSION['customerid'] = $customerid;
  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
  echo $restid = $_SESSION['restaurantid']; 
  $_SESSION['restaurantid'] =$restid;
 
 
?>
 
 <?php
 

  if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(isset($_POST['rrsend'])){
$output="";
 echo  $fromuser=$_POST['fromuser'];
  $touser=$_POST['touser'];
echo $message=$_POST['message'];
$status='NEW';

$sql = "INSERT INTO messages (FromUser,ToUser,Message,status)
VALUES ('$fromuser','$touser','$message','$status')";
if($conn -> query($sql))
{
  $output.="";
  header("Location: manager_resturant_message.php?cid=$fromuser "); 
}
else{
  $output.="Error";
}
echo $output;
}}

 if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(isset($_POST['rsend'])){
   echo $customerid = $_SESSION['customerid'];
 $_SESSION['customerid'] = $customerid;
$output="";
 echo  $fromuser=$_POST['fromuser'];
  $touser=$_POST['touser'];
echo $message=$_POST['message'];
echo $orderid=$_POST['orderid'];
 $_SESSION['orderid'] =$orderid;
  $orderid = $_SESSION['orderid']; 
  
echo $status='NEW';

$sql = "INSERT INTO messages (FromUser,ToUser,Message,status,orderid)
VALUES ('$fromuser','$touser','$message','$status','$orderid')";
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