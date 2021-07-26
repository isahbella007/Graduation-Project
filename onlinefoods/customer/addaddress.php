<?php
require('config.php');
if($_SESSION['login']){
    if(isset($_POST['submit'])){
        $address = $_POST['address'];
        $customerid = $_SESSION['customerid'];
        $region = $_POST['region'];
        // Add Address
        $addUserAddress = "INSERT INTO address(address, customerid, region)VALUES(:address, :customerid, :region)";
        $addUserAddressStmt = $conn->prepare($addUserAddress);
        $addUserAddressStmt->execute(array(
            ':address' => $address, 
            ':customerid' => $customerid,
            ':region' => $region,
        ));
        header("location: address.php");

    }
}
?>
<!DOCTYPE html>
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

<body>
 
 
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
      Add Address
    </a>
<span >
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
          <li class="nav-item">
          <a class="nav-link active" href="address.php">Back</a>
            </li>
           <li class="nav-item">
          <a class="nav-link active" href="logout.php">Logout</a>
            </li>
              

       </ul>
       </div>  
    </div>
 </nav>
<div class="main">
    <p class="sign" align="center">Add Address</p>
    <form class="form1" method="post" >
      <input  class="un" type="text" align="center" name= "address" size="25" placeholder="Address">

      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Region: </span>
        </div>
        <select name="region" id="cars">
            <option >Famagusta</option>
            <option >Iskele</option>
            <option >Kyernia</option>
            <option >Nicosia</option>
        </select>
      </div>
      
       <input class="submit" type="submit" name ="submit" align="center" value="Submit">  
    </form>
</div>
