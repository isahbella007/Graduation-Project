<?php 
require('config.php');
$flag = 'pending';
// Check How many times a restaurant has been reported
$sql = "SELECT COUNT(res_flag) as numberoftimes, restaurantid FROM report WHERE res_flag = 'Received'
GROUP BY restaurantid";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($result){
  foreach($result as $reportResult){
    $restaurantId = $reportResult['restaurantid'];
    $numberOfReports = $reportResult['numberoftimes'];
    if($numberOfReports == 5){
      // Update their status to SUSPENDED
      $update = "UPDATE restaurant SET FLAG = 'SUSPENDED' WHERE restaurantid = '$restaurantId'";
      $updateStmt = $conn->prepare($update);
      $updateStmt->execute();

    }
  }
}

if(isset($_POST['login'])){

  $restaurantEmail = $_POST['email'];
  $password = $_POST['password'];
  $orderCount = False;

// Let Only restaurants that have been confirmed to login 
  $detailsCheck = "SELECT * FROM restaurant WHERE email = '$restaurantEmail' AND password = '$password' AND FLAG = 'CONFIRMED' ";
  $detailsCheckStat = $conn->prepare($detailsCheck);
  $detailsCheckStat->execute();
  $detailsCheckResult = $detailsCheckStat->fetch();
  if($detailsCheckResult){
    $orderCount = True;
    $_SESSION['login'] = true;
    $_SESSION['restaurantid'] = "".$detailsCheckResult['restaurantid']."";
    $_SESSION['name'] = "".$detailsCheckResult['name']."";
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
    header("location: dashboard.php");
  }
    
  

// Check if the email and password entered is correct 
  $verfication = "SELECT * FROM restaurant WHERE email = '$restaurantEmail' AND password = '$password'";
  $verficationStat = $conn->prepare($verfication);
  $verficationStat->execute();
  $verficationResult = $verficationStat->fetch();
  if(!$verficationResult){
      echo '<script type="text/javascript">';
      echo ' alert("Email/Password Is not correct ")'; 
      echo '</script>';
    }
    
  
  // Check if the FLAG of the email and password entered is Pending 
  $pendingCheck = "SELECT * FROM restaurant WHERE email = '$restaurantEmail' AND password = '$password' AND FLAG = 'PENDING' ";
  $pendingCheckStat = $conn->prepare($pendingCheck);
  $pendingCheckStat->execute();
  $pendingCheckResult = $pendingCheckStat->fetch();
  if($pendingCheckResult){
    if($flag = $pendingCheckResult['FLAG']){
      echo '<script type="text/javascript">';
      echo ' alert("Wait For Admin To Confirm Your Restaurant")'; 
      echo '</script>';
    }
  }

  // Check if the FLAG of the email and password enetered is Suspended 
  $suspendCheck = "SELECT * FROM restaurant WHERE email = '$restaurantEmail' AND password = '$password' AND FLAG = 'SUSPENDED'";
  $suspendCheckStmt = $conn->prepare($suspendCheck);
  $suspendCheckStmt->execute();
  $suspendCheckResult = $suspendCheckStmt->fetch();
  if($suspendCheckResult){
    echo "<script type='text/javascript'>alert
    ('Your Restaurant has been Suspended. Send an Appeal to the admin.');
    window.location='appeal.php';
    </script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css\index.css">

</head>
<body>
<div class="login">
  <h1>Welcome to OnlineFoods</h1>
    <form method="post">
      <input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button name = "login" type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
      <h5>New here? <a href = "register.php">Create Account</h5>
    </form>
</div>
</body>
</html>
