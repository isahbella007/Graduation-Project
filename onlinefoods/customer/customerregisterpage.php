<?php 
require('config.php');
include('header/registerHeader.php');
if(isset($_POST['register'])){
    $fullName = $_POST['fullname'];
    $phoneNumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Check if phoneNumber already Exsits
    $phoneNumberCheck = "SELECT * FROM customers WHERE phonenumber = '$phoneNumber'";
    $phoneNumberCheckStmt = $conn->prepare($phoneNumberCheck);
    $phoneNumberCheckStmt->execute();
    $phoneNumberCheckResult = $phoneNumberCheckStmt->fetchAll(PDO::FETCH_ASSOC);
    if($phoneNumberCheckResult){
        echo '<script type="text/javascript">';
        echo ' alert("Phone Number is already in Use")'; 
        echo '</script>';
    }else{
        $addCustomer = "INSERT INTO customers(name, phonenumber, password) VALUES(:fullname, :phonenumber, :password)";
        $addCustomerStmt = $conn->prepare($addCustomer);
        $addCustomerStmt->execute(array(
            ':fullname' => $fullName, 
            ':phonenumber' => $phoneNumber, 
            ':password' => $password,
        ));
        header("location: customerloginpage.php");
    }

}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"/>
    
</head>
<body>
    <div class="container">
       <!-- <div class="Back">
            <i class="fa fa-arrow-left" onclick="Back()"></i>
        </div> -->
        <br>
        <p class="h2 text-center">Online Foods User Register Form</p>
        <br>
        <form action="" method="post">
            
            <div class="form-group">
                <label>Full Name:</label>
                <input class="form-control" type="text" name="fullname" required placeholder="Enter Your Full Name"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input class="form-control" type="number" name="phonenumber" required placeholder="Enter Phone Number"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input class="form-control" type="password" name="password" required placeholder="Enter Password"/>
                <span class="Error"></span>
            </div>
         
            <div class="form-group]">
                <input class="btn btn-primary btn-block" type="submit" name = "register" value="Submit"/>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<?php
include('footer.php');
?>