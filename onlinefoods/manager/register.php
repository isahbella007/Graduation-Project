<?php 
require('config.php');

$registerDone = false;

if(isset($_POST['submit'])){
	$resName = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$password = $_POST['password'];
	$passwordTwo = $_POST['passwordtwo'];
	$category = $_POST['category'];
    $region = $_POST['region'];

	// Check if the User pressed the button without filling the form. 
	if($_POST['name'] == '' || $_POST['email'] == '' || $_POST['address'] == '' || $_POST['password'] == '' || $_POST['passwordtwo'] == ''){
		    echo '<script type="text/javascript">';
        	echo ' alert("Please fill the form")'; 
       		 echo '</script>';
	}

	// Check if the email entered is valid. 
	 if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script type="text/javascript">';
        echo ' alert("Email is valid")'; 
        echo '</script>';
    }
    else{
        echo '<script type="text/javascript">';
        echo ' alert("Email is invalid")'; 
        echo '</script>';
    }

	// Check if the email being entered is already in use. 
	$emailCheck = "SELECT * FROM restaurant WHERE email = '$email'";
	$emailCheckStat = $conn->prepare($emailCheck);
	$emailCheckStat->execute();
	$emailCheckResult = $emailCheckStat->fetchAll();
	if($emailCheckResult){
	 	echo '<script type="text/javascript">';
      	echo ' alert("Email entered is already in use. ")'; 
      	echo '</script>';
	}
    // Check if a restaurant with the same name already exsits 
    $checkRes = "SELECT * FROM restaurant WHERE name = '$resName'";
    $checkResStmt = $conn->prepare($checkRes);
    $checkResStmt->execute();
    $checkResResult = $checkResStmt->fetchAll();
    if($checkResResult){
        echo '<script type="text/javascript">';
        echo ' alert("Please, come up with another name. ")'; 
        echo '</script>';
    }
	// Check if the password entered matches 
	if($_POST['password'] == $_POST['passwordtwo'] and !$emailCheckResult and !$checkResResult){
		$registerRestaurant = "INSERT INTO restaurant(name, address, category, email, password, region) VALUES (:restaurantname, :address, :category, :email, :password, :region)";
		$registerRestaurantStat = $conn->prepare($registerRestaurant);
		$registerRestaurantStat->execute(array(
			':restaurantname' => $resName,
			':address' => $address,
			':category' => $category,
			':email' => $email, 
			':password' => $password,
            ':region' => $region,
		));
		$registerDone = true;
	}
	if($registerDone){
		echo '<script type="text/javascript">';
      	echo ' alert("Congrats on your restaurant!")'; 
      	echo '</script>';
	}

}
?>

<html> 
<head>
<title>Register</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel = "stylesheet" href = "css\register.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<div class="container">
<br><br><br>
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
    <h4 class="card-title mt-3 text-center">Create Account</h4>
    <p class="text-center">Get started with your free account</p>
    
    <form method = "post" action = "">
    <!-- form-group// -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Name: </span>
         </div>
        <input name="name" class="form-control" placeholder="Restaurant Name" type="text" required>
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Email: </span>
         </div>
        <input name="email" class="form-control" placeholder="Email address" type="email" required>
    </div> <!-- form-group// -->
     <!-- form-group// -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Address: </span>
        </div>
        <input name = "address"class = "form-control" placeholder="Address" type = "text" required>
    </div> <!-- form-group end.// -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Password: </span>
        </div>
        <input name = "password" class="form-control" placeholder="Create password" type="password" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Password: </span>
        </div>
        <input name =  "passwordtwo" class="form-control" placeholder="Repeat password" type="password" required>
    </div> <!-- form-group// -->  
    <!-- Make it option    -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Category: </span>
        </div>
        <select name="category" id="cars">
            <option >African</option>
            <option >Asian</option>
            <option >Middle East</option>
            <option >Eastern Europe</option>
        </select>
    </div>      
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
    <div class="form-group">
        <button name = "submit" type="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account? <a href="index.php">Log In</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->
</body>
</html>