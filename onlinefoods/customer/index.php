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
<link rel="stylesheet" href="css/customerhomepagee.css">


<style>
* {
  box-sizing: border-box;

}

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;

}

/* Style the header */
.header {
  padding: 80px;
  text-align: center;
  background: red;
  color: white;
}

/* Increase the font size of the h1 element */
.header h1 {
  font-size: 40px;
}

/* Style the top navigation bar */
.navbar {
  overflow: hidden;
  background-color: #333;
}

/* Style the navigation bar links */
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

/* Right-aligned link */
.navbar a.right {
  float: right;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Column container */
.row {  
  display: flex;
  flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {   
  flex: 70%;
  background-color: white;
  padding: 20px;
}

/* Fake image, just for this example */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .row {   
    flex-direction: column;
  }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width:100%;
  }
}
</style>
</head>
<body>

  <div class="header" >
  <h3 >Multiple resturant just waiting for you</h3>
  <p>Made just for your enjoyment.</p>
  <img src="images/ff1.png" >
</div>

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
      ONLINE ORDERING
    </a>
<span >
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
         
           <li class="nav-item">
             <a class="nav-link  " aria-current="page" href="customerloginpage.php">Login</a>
           </li>
           <li class="nav-item">
          <a class="nav-link active" href="customerregisterpage.php">Register</a>
            </li>
            <li class="nav-item">
          <a class="nav-link active" href="restaurantregion.php">Browse menu</a>
            </li>
             <li class="nav-item">
          <a class="nav-link active" href="aboutus.php">About us</a>
            </li>

       </ul>
       </div>  
          </div>
 </nav>


<div class="row">
  <div class="side">
    <h2>Burgers</h2>
    <h5>just for you:</h5>
     <img src="images/ff2.png" >
    <p>Some delicious and meaty burger from many resturant..</p>
    <br>
    <h3>Food. First and foremost.</h3>
    <p>Live, love, eat..</p>
    <img src="images/ff3.png" ><br>
    <img src="images/ff4.png" ><br>
     <img src="images/ff12.jfif" >
  </div>
  <div class="main">
    <h2>Good Food for Good Moments.</h2>
   <h5>Food from different countries at your dispposal</h5>
 <img src="images/ff6.jfif" >  <img src="images/ff7.jfif" >  <img src="images/ff8.jfif" >
    <p>Hasty and tasty!.</p>
    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    <br>
  <h2>Food from everywhere</h2>
    <h5>Food from different countries at your dispposal</h5>
     <img src="images/ff9.jfif" >  <img src="images/ff10.jfif" >  <img src="images/ff11.jfif" >
    <p>Good food and great vibes...</p>
    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
  </div>

</div>
 
  <?php
 include_once 'footer.php';?>
</body>
</html>
<?php
if(isset($_POST["submit"]))
{

   
 echo $phone1 = $_POST["phone"];}
?>