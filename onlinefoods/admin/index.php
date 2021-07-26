<?php
require('config.php');
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($_POST['email'] == '' || $_POST['password'] == ''){
        echo '<script type="text/javascript">';
        echo ' alert("Please fill the form")'; 
       	echo '</script>';
    }

    $adminLogin = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $adminLoginStat = $conn->prepare($adminLogin);
    $adminLoginStat->execute();
    $adminLoginResult = $adminLoginStat->fetchAll();
    if($adminLoginResult){
        $_SESSION['login'] = true;
        foreach($adminLoginResult as $result){
            $_SESSION['adminName'] = "".$result['name']."";
            $_SESSION['adminImage'] = "".$result['image']."";
        }
        header("location: confirmedrestaurant.php");
    }
    if(!$adminLoginResult){
        echo '<script type="text/javascript">';
        echo ' alert("Password or Email is Incorrect")'; 
       	echo '</script>';
    }
  
}

?>

<html>
<head>
<title>Login</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css\index.css">

</head>
<body>
<body id="LoginForm">
<div class="container">
<br><br>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Admin Login</h2>
  <br><br>
   </div>
    <form id="Login" method = "POST">

        <div class="form-group">


            <input type="email" class="form-control" name = "email" placeholder="Email Address">

        </div>

        <div class="form-group">

            <input type="password" class="form-control" name = "password" placeholder="Password">

        </div>
        <div class="forgot">
        
</div>
        <button type="submit" class="btn btn-primary" name = "login">Login</button>

    </form>
    </div>

</div></div></div>


</body>
</html>