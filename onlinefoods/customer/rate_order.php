<?php 

   

 include ('dbh.inc.php');
 
 

include('header/restaurantheader.php');
if(($_SESSION['login'])){
    $customerid = $_SESSION['customerid'];

 

  
}

if(isset($_POST['foodmenu_userNotLoggedIn'])){
  // This is the meal that the Guest user selected.
  echo $_POST['foodmenu_userNotLoggedIn'];
  echo "Not logged in";
  // This is the restaurant that the Guest user selected. 
  echo $_SESSION['restaurantIdSelectedByGuestUser'];
}
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<head>
    <link rel="stylesheet" href ="./css/cart.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
        Online Foods
        </a>
        <span >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if($_SESSION['login']){?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
          <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="myorders.php">Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Logout</a>
                    </li>
                </ul>
            <?php }?>
            <?php if(isset($_POST['foodmenu_userNotLoggedIn'])){?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
                    <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
                </ul>
            <?php }?>
            </div>  
        </div>
    </nav>

    <?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(isset($_POST['Rate'])){
    $item_id = $_POST['item_id'];
        $rest_id = $_POST['rest_id'];
 }}
 ?>

    <!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 
<style>
 

 
</style>
</head>
 

 
<body>

 <form action="send_ratings_to_database.php" method="POST">  
 <table class="table">
  <thead class="text-center">
     
    <tr>
      <th scope="col">RATE SPEED</th>
      <th scope="col">RATE TASTE</th>
      <th scope="col">RATE PRICE VALUE</th>
 
    </tr>
      
  </thead>
  <tbody class="text-center">
 <tr>
      <td scope="col">
  <select name="speed" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  
  <option selected value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
</td>
      <td scope="col">
   <select name="taste" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
   
  <option selected value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
</td>
      <td scope="col">
        <select name="price" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
 
  <option selected value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>


      </td>

      </tr>
      <tr> 
        <td> NOTE: </td>
        <td>       </td>
        <td>       </td> 
    </tr>

       </tr>
      <tr> <td> <textarea name="review"  style="height: 100px; width: 400px"></textarea> </td>
        <td>  <input type='hidden' name='rest_id' value= <?php echo $rest_id; ?> > 
         <input type='hidden' name='item_id' value= <?php echo $item_id; ?> > 
         <button   class='btn btn-primary btn-block  ' name='submit'>SUBMIT
        </button></td>
        <td> </td> </tr>
 
    

  </tbody>
 
    </table>
       
</form>
</body>
</html>