<?php 
error_reporting(0);
require('config.php');
include('header/restaurantheader.php');
if(($_SESSION['login'])){
  $customerid = $_SESSION['customerid'];
  $userAddressId = $_SESSION['useraddress'];
  $_SESSION['useraddress'] =$userAddressId;
  // This is the meal that the Logged in user slected.
  $_POST['foodmenu_userLoggedIn'];
  
  // This is the id of the restaurant that the Logged in user selected.
  $restid = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
  $_SESSION['restaurantIdSelectedByLoggedInUser'] =$restid;
  print_r($_SESSION['cart']);

  
}

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
 if(isset($_POST['Order'])){
  echo $payment = $_POST['exampleRadios'];
  echo $restid = $_POST['rest'];
     $address = trim($userAddressId);
     $orderid = uniqid();
     $cid = $customerid;
   echo $time = date("h:i:sA");
   echo $date = date("m/d/y");
   $price =  "";
$quantity =  "";
$item_name = "";
 
   $status = "PENDING";
   
   $spiceleve = "";
   $t ="";
    $d ="";
    $rate_status=0;


     foreach ($_SESSION['cart'] as $key => $value){
                       
               $p=0;
               $p = (float)$value["quantity"]*(float)$value["price"];
               $_SESSION['cart'][$key]['price'] = $p;
             
          
        }
            insertorder($conn, $orderid, $restid, $item_name, $price, $cid, $status, $payment, $quantity, $address, $rate_status);

      }}
        
  function insertorder($conn, $orderid, $restid, $item_name, $price, $cid, $status, $payment, $quantity, $address, $rate_status){
 
$sql= "INSERT INTO orders (orderid, restaurantid, itemname, price, customerid, status, paymentmethod, quantity, addressid, rate_status ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ? );";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
  echo "error";
// header("Location: add.php?error=stmtfailled&cid=$cid");
exit();

}
else{
mysqli_stmt_bind_param($stmt, "sisiissisi", $orderid, $restid, $item_name, $price, $cid, $status, $payment, $quantity, $address,$rate_status);

// echo $orderid = mysql_insert_id($conn);
foreach ($_SESSION['cart'] as $key => $value){
 echo $item_name = $value['itemname'];
echo $price = $value['price'];
echo $quantity = $value['quantity'];
echo $payment = $payment;
echo $restid = $restid;
echo $cid = $cid;
$rate_status=$rate_status;
 
echo $payment = $_POST['exampleRadios'];
  echo $restid = $_POST['rest'];
 // $rad1 = rand(0,4000);
 //    $rad2 = rand(100,5000);
     
mysqli_stmt_execute($stmt);

}
unset($_SESSION['cart']);
} 
 
 
 header("Location: addtocart.php");
 
}
 
 
 
 ?>