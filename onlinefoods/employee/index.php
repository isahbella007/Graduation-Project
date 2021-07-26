<?php 
require('config.php');
error_reporting(0);
if(isset($_POST['login'])){
  echo "LOGIN";
  $name = $_POST['username']; 
  $password = $_POST['password']; 
  $orderCount = False;

  // Write A Query Statment for all type of Employees 
  $logDeliveryManIn = True;
  $loginKitchenStaffIn = true;
  $loginQuery = "SELECT * FROM employee WHERE employeeid = '$name' AND password = '$password' AND
  position = 'Kitchen Head' AND status != 'FIRED'";
  $loginQueryStmt  = $conn->prepare($loginQuery); 
  $loginQueryStmt->execute(); 
  $loginQueryResult = $loginQueryStmt->fetch();
  if($loginQueryResult >0){
    $logDeliveryManIn = false;
    $loginKitchenStaffIn = false;
  }
  if($loginQueryResult){
    $orderCount = True;
    // If there is a result, get the restaurant name and check if the restaurant is suspended.
    $resName = $loginQueryResult['restaurantid'];
    $getRestaurantName = "SELECT * FROM restaurant WHERE restaurantid = '$resName' AND FLAG = 'CONFIRMED'";
    $getRestaurantNameStmt = $conn->prepare($getRestaurantName);
    $getRestaurantNameStmt->execute();
    $getRestaurantNameResult = $getRestaurantNameStmt->fetch();
    if($getRestaurantNameResult){
      $_SESSION['login'] = true; 
      $_SESSION['restaurantname'] = $getRestaurantNameResult['name'];
      $_SESSION['restaurantid'] = $loginQueryResult['restaurantid'];
      $_SESSION['image'] = $loginQueryResult['image']; 
      $_SESSION['name'] = $loginQueryResult['name'];
      $_SESSION['id'] =  $loginQueryResult['employeeid'];
     
    }
    if(!$getRestaurantNameResult){
      $orderCount = FALSE;
      echo '<script type="text/javascript">';
      echo ' alert("Restaurant Suspended. Unable to login")'; 
      echo '</script>';
    }
    if($orderCount){
      $res = $_SESSION['restaurantid'];
      date_default_timezone_set('Europe/Istanbul');
      $date = date('Y-m-d');   
      // Get the orders for this particular date.
      $getOrders = "SELECT Count(itemname) from orders WHERE orderdate = '$date' AND restaurantid = '$res' AND status = 'PENDING'";
      $getOrdersStmt = $conn->prepare($getOrders); 
      $getOrdersStmt->execute();
      $getOrdersResult = $getOrdersStmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($getOrdersResult as $getResult){
        $_SESSION['ordercount'] = $getResult;
      }
      header("location: kitchenhead/dashboard.php");
    }
  }elseif($logDeliveryManIn){
    // Do the Query for Delivery Man
    $loginQueryDelivery = "SELECT * FROM employee WHERE employeeid = '$name' AND password = '$password' 
    AND position = 'Delivery Worker' AND status != 'FIRED'";
    $loginQueryDeliveryStmt = $conn->prepare($loginQueryDelivery); 
    $loginQueryDeliveryStmt->execute();
    $loginQueryDeliveryResult = $loginQueryDeliveryStmt->fetch();
    if($loginQueryDeliveryResult){
      $loginKitchenStaffIn = false;
    }
    if($loginQueryDeliveryResult){
      $resName = $loginQueryDeliveryResult['restaurantid'];
      $getRestaurantName = "SELECT * FROM restaurant WHERE restaurantid = '$resName' AND FLAG = 'CONFIRMED'";
      $getRestaurantNameStmt = $conn->prepare($getRestaurantName);
      $getRestaurantNameStmt->execute();
      $getRestaurantNameResult = $getRestaurantNameStmt->fetch();
      if($getRestaurantNameResult){
        $_SESSION['login'] = true; 
        $_SESSION['restaurantname'] = $getRestaurantNameResult['name'];
        $_SESSION['restaurantid'] = $loginQueryDeliveryResult['restaurantid'];
        $_SESSION['employeeid'] = $loginQueryDeliveryResult['employeeid'];
        header("location: deliveryworker/home.php");
      }
      if(!$getRestaurantNameResult){
        echo '<script type="text/javascript">';
        echo ' alert("Restaurant Suspended. Unable to login")'; 
        echo '</script>';
      }
    }
  }
  if($loginKitchenStaffIn){
    // Do Kitchen Staff Stuff
    $sql = "SELECT * FROM employee WHERE employeeid = '$name' AND password = '$password'
    AND position = 'Kitchen Staff' AND status != 'Fired'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $ksLoginSuccess = $stmt->fetch();
    if($ksLoginSuccess){
      
      // Get the name of the restaurant the employee is working for
      echo $resId = $ksLoginSuccess['restaurantid'];
      $getResName = "SELECT * FROM restaurant WHERE restaurantid = '$resId' AND FLAG = 'CONFIRMED'";
      $getStmt = $conn->prepare($getResName);
      $getStmt->execute();
      $finalResult = $getStmt->fetch();
      if($finalResult){
        $_SESSION['login'] = true; 
        $_SESSION['restaurantname'] = $finalResult['name'];
        $_SESSION['restaurantid'] = $finalResult['restaurantid'];
        $_SESSION['employeeid'] = $ksLoginSuccess['employeeid'];
        header("location: kitchenstaff/home.php");
      }
      if(!$finalResult){
        echo '<script type="text/javascript">';
        echo ' alert("Restaurant Suspended. Unable to login")'; 
        echo '</script>';
      }
    }
  }
  if(!$loginQueryDeliveryResult){
    $employeeStatus = "SELECT * FROM employee WHERE employeeid = '$name' AND status = 'FIRED'";
    $employeeStatusStmt = $conn->prepare($employeeStatus);
    $employeeStatusStmt->execute();
    $employeeStatusResult = $employeeStatusStmt->fetchAll();
    if($employeeStatusResult){
      echo '<script type="text/javascript">';
      echo ' alert("Sorry, You Have been fired")'; 
      echo '</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="./logincss/style.css">
  </head>
  <body>
  <div class="login-box">
  <h1>Login</h1>
  <form method = "post" action = "">
  <div class="textbox">
    <i class="fas fa-user"></i>
    <input type="text" placeholder="Employee ID" name = "username">
  </div>

  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="Password" name = "password">
  </div>

  <input type="submit" class="btn" placeholder ="Sign in" name = "login" >
  </form>
</div>
  </body>
</html>

