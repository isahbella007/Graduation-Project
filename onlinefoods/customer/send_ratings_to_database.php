

 <?php 

   

 include ('dbh.inc.php');
 
 

include('header/restaurantheader.php');
if(($_SESSION['login'])){
    $customerid = $_SESSION['customerid'];
  $userAddressId = $_SESSION['useraddress'];
  $_SESSION['useraddress'] =$userAddressId;
  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
  $restid = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
  $_SESSION['restaurantIdSelectedByLoggedInUser'] =$restid;
 

  
}
else{  header("location: customerloginpage.php");}

if(isset($_POST['foodmenu_userNotLoggedIn'])){
  // This is the meal that the Guest user selected.
  echo $_POST['foodmenu_userNotLoggedIn'];
  echo "Not logged in";
  // This is the restaurant that the Guest user selected. 
  echo $_SESSION['restaurantIdSelectedByGuestUser'];
}
?>
<?php
       
if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(isset($_POST['submit'])){
  echo $item_id = $_POST['item_id'];
  echo $speed = $_POST['speed'];
  echo $taste = $_POST['taste'];
  echo $note = $_POST['review'];
  echo $price_value = $_POST['price'];
  echo $add = (integer)$speed+ (integer)$taste+(integer)$price_value;
  echo $total = (float)($add/30)*10;
   $cid = $_SESSION['customerid'];
    $_SESSION['customerid'] =    $cid;
  echo $cid;
  $rate_status = 1;
  echo $rest_id = $_POST['rest_id'];

  function insertorder($conn, $item_id, $rest_id, $cid, $speed, $taste, $price_value, $total, $note, $rate_status){
 
$sql= "INSERT INTO ratings (orderid, resturantid, customerid, speed, taste, price_value, total, note, rate_status ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ? );";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
  echo "error";
// header("Location: add.php?error=stmtfailled&cid=$cid");
exit();

}
else{
mysqli_stmt_bind_param($stmt, "siiiiissi", $item_id, $rest_id, $cid, $speed, $taste, $price_value, $total, $note, $rate_status);

  
mysqli_stmt_execute($stmt);

$sql1= "UPDATE orders  SET rate_status = '$rate_status'  WHERE orderid = '$item_id' ;";
mysqli_query($conn, $sql1);
 

header("Location: myorders.php ");
 
} 
 
 
 header("Location: myorders.php ");
 
}
insertorder($conn, $item_id, $rest_id, $cid, $speed, $taste, $price_value, $total, $note, $rate_status);
 }} 
?>