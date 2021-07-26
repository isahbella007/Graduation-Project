<?php
require('config.php');
include('header\restaurantheader.php');
if($_SESSION['login']){
    // Display this users address.
    $customerid = $_SESSION['customerid'];
    $getAddress = "SELECT * FROM address WHERE customerid = '$customerid'";
    $getAddressStmt = $conn->prepare($getAddress);
    $getAddressStmt->execute();
    $getAddressResult = $getAddressStmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Foods</title>
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/117dc4583c.js" crossorigin="anonymous"></script>

  <title>Sign in</title>
  <style>
  
  button, input[type="submit"], input[type="reset"] {
  background: none;
  color: inherit;
  border: none;
  padding: 0;
  font: inherit;
  cursor: pointer;
  outline: inherit;
}

  </style>
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
             <a class="nav-link  " aria-current="page" href="index.php">Home</a>
           </li>
           <li class="nav-item">
           <a class="nav-link  " aria-current="page" href="address.php">Browse Menu</a>
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
 <br>
 <hr>
 <?php foreach($getAddressResult as $userAddress){?>
 <section class="py-5 bg-white py-5">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                    
                        <div class="row">
                        
                            <div class="col-xs-1 col-sm-2 col-md-1 mr-3">
                            <i class="fas fa-map fa-4x"></i></br>
                            </div>
                            <div class="col-xs-8 col-sm-7 col-md-8">
                            
                            
                                 <h5><?php echo $userAddress['address']?> </h5> 
                                 <br>
                            <form method = "post" action = "editmyaddress.php">
                            <input type="submit" name = "apply" class="btn btn-primary btn-xs" value = "EDIT">
                            <input type = "hidden" name = "post" value = "<?php echo $userAddress['addressid'];?>" class = "btn-btn primary" > 
                            </form>
                            </div>
                            
                           
                        </div>
                        <br>
                       
                    </div>
                </div>
                </div>
            </div>
        
        </div>
     </section>
     <?php }?> 
</body>