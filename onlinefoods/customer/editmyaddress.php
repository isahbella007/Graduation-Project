<?php 
require('config.php');
if($_SESSION['login']){
    $customerId = $_SESSION['customerid'];
    if(isset($_POST['apply'])){
        $_SESSION['addressId'] = $_POST['post'];
        $userAddressId = $_SESSION['addressId'];
        $getAddressDetails = "SELECT * FROM address WHERE addressid = '$userAddressId'";
        $getAddressDetailsStmt = $conn->prepare($getAddressDetails);
        $getAddressDetailsStmt->execute();
        $getAddressDetailsResult = $getAddressDetailsStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($getAddressDetailsResult as $addressDetails){
            $userAddress = $addressDetails['address'];
        }
    }
    echo $addressId = $_SESSION['addressId'];
    if(isset($_POST['update'])){
        $newAddress = $_POST['address'];
        $newRegion = $_POST['region'];
        $addressId = $_SESSION['addressId'];
      

        $updateAddress = "UPDATE address SET address = '$newAddress', region = '$newRegion' WHERE addressid = '$addressId'";
        $updateAddressStmt = $conn->prepare($updateAddress);
      
        $updateAddressStmt->execute();
        header("location: myaddress.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
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
<link rel="stylesheet" href="css/customerhomepagee.css">
  <link rel="stylesheet" href="css/customerloginpage.css">
  <title>Sign in</title>
</head>

<body>
 
 
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
      Edit Address
    </a><span >

     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
          <li class="nav-item">
            <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
            </li>
            <li class="nav-item">
          <a class="nav-link active" href="aboutus.php">About us</a>
            </li>
           <li class="nav-item">
          <a class="nav-link active" href="logout.php">Logout</a>
            </li>
           

       </ul>
       </div>  
    </div>
 </nav>
<div class="main">
     <p class="sign" align="center">Sign in</p>
     <form class="form1"  method="post" >
        <input class="un " type="text" align="center" name= "address" value = "<?php echo $userAddress?>">
        <br>

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
        
        <input class="submit" type="submit" name ="update" align="center" value="Update">
     </form>  
       
 
                
    </div>
<?php
 include_once 'footer.php';
?>