<?php
require('config.php');

if(isset($_SESSION['login'])){
    $userId = $_SESSION['customerid'];
    $getCustomerId = "SELECT * FROM customers WHERE customerid = '$userId'";
    $getCustomerIdStmt = $conn->prepare($getCustomerId);
    $getCustomerIdStmt->execute();
    $getCustomerIdResult = $getCustomerIdStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($getCustomerIdResult as $customerDetails){
        $customerNameValue = $customerDetails['name'];
        $customerNumberValue = $customerDetails['phonenumber'];
        $customerPasswordValue = $customerDetails['password'];
    }
    $newDetails = false;
    if(isset($_POST['submit'])){
        $newName = $_POST['name'];
        $newPhoneNumber = $_POST['phonenumber'];
        $newPassword = $_POST['password'];

        $updateDetails = "UPDATE customers SET name = '$newName', phonenumber = '$newPhoneNumber', password = '$newPassword' WHERE customerid = '$userId'";
        $updateDetailsStmt = $conn->prepare($updateDetails);
        $updateDetailsStmt->execute();
        $newDetails = True;
    }
    if($newDetails){
       header("location: address.php");
    }
}
?>
<html lang="en">
<head>
<title>Online Fods</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="footer, address, phone, icons" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="customerhomepagee.css">
  <link rel="stylesheet" href="css/customerloginpage.css">
  <title>Sign in</title>
</head>

<style>

</style>

<body>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
     My Profile
    </a>
    <span >
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
          <li class="nav-item">
          <a class="nav-link active" href="myaddress.php">My Address</a>
            </li>
          <li class="nav-item">
            <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
            </li>
           <li class="nav-item">
          <a class="nav-link active" href="logout.php">Logout</a>
            </li>
       </ul>
       </div>  
    </div>
 </nav>
 <br>

 <div class="main">
    <p class="sign" align="center">My Profile</p>
    <form class="form1" method="post" >
    
      <input  class="un" type="text" align="center" name= "name" size="25" value = "<?php echo $customerNameValue?>">

      <input  class="un" type="text" align="center" name= "phonenumber" size="25" value = "<?php echo $customerNumberValue?>">  

      <input  class="un" type="password" align="center" name= "password" size="25" value = "<?php echo $customerPasswordValue?>">    
      
       <input class="submit" type="submit" name ="submit" align="center" value="Update">  
    </form>
</div>

<?php 
include('footer.php');
?>