<?php 

  require_once 'dbh.inc.php';
 
 

include('header/restaurantheader.php');
if(($_SESSION['login'])){
  $customerid = $_SESSION['customerid'];
  $userAddressId = $_SESSION['useraddress'];
  $_SESSION['useraddress'] =$userAddressId;
  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
  $restid = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
  $_SESSION['restaurantIdSelectedByLoggedInUser'] =$restid;
  print_r($_SESSION['cart']);

  
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
 if(isset($_POST['Order'])){
    $payment = $_POST['exampleRadios'];
    $restid = $_POST['rest'];
    $message = $_POST['message'];
     $address = trim($userAddressId);
     echo $orderid = uniqid();  
     $cid = $customerid;
     $time = date("h:i:sA");
     $date = date("m/d/y");
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
            insertorder($conn, $orderid, $restid, $item_name, $price, $cid, $status, $payment, $quantity, $address, $rate_status, $message);

   
//echo $region = $_POST["region"];
 
 }}

        
  function insertorder($conn, $orderid, $restid, $item_name, $price, $cid, $status, $payment, $quantity, $address, $rate_status, $message){
 
  $sql= "INSERT INTO orders(orderid,customerid,restaurantid,addressid,itemname,price,quantity,paymentmethod,status,rate_status,message) VALUES(?,?,?,?,?,?,?,?,?,?,?);";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
  echo "gg";
// header("Location: add.php?error=stmtfailled&cid=$cid");
exit();
 
}
else{
  echo "ys";
   // $addUserAddress = "INSERT INTO orders(orderid,customerid,restaurantid,addressid,itemname,price,quantity,paymentmethod,status,rate_status) VALUES(:orderid, :cid, :restid, :address, :item_name, :price, :quantity, :payment, :status, :rate_status)";
   //        $addUserAddressStmt = $conn->prepare($addUserAddress);
   //      $addUserAddressStmt->execute(array(
   //          ':orderid' => $orderid, 
   //          ':cid' => $cid,
   //          ':restid' => $restid,
   //          ':address' => $address, 
   //          ':item_name' => $item_name,
   //          ':price' => $price,
   //          ':quantity' => $quantity,
   //          ':payment' => $payment, 
   //          ':status' => $status,
   //          ':rate_status' => $rate_status,
   //      )); employeehistory_ibfk_3
  
mysqli_stmt_bind_param($stmt, "siissiissis", $orderid, $cid, $restid, $address, $item_name, $price, $quantity, $payment, $status,$rate_status,$message);

// echo $orderid = mysql_insert_id($conn);
foreach ($_SESSION['cart'] as $key => $value){
 echo $item_name = $value['itemname'];
echo $price = $value['price'];
echo $quantity = $value['quantity'];
echo $payment = $payment;
echo $restid = $restid;
echo $cid = $cid; 
$rate_status=$rate_status;
$message = $message;

 
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