<?php 
require('config.php');
include('header/registerAndLoginHeader.php');
if(isset($_POST['login'])){
    $phoneNumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Check if the phone number is correct
    $loginUser = "SELECT * FROM customers WHERE phonenumber = '$phoneNumber' AND password = '$password'";
    $loginUserStmt = $conn->prepare($loginUser);
    $loginUserStmt->execute();
    $loginUserResult = $loginUserStmt->fetch();
    if($loginUserResult){
        $_SESSION['login'] = true; 
        $_SESSION['customerid'] = $loginUserResult['customerid'];
        header("location: address.php");
    }

}
?>
  <div class="main">
     <p class="sign" align="center">Sign in</p>
     <form class="form1"  method="post" >
      <input class="un " type="text" align="center" name= "phonenumber" placeholder="Phone Number">
      <input class="pass" type="password" align="center" name="password" placeholder="Password">
      <input class="submit" type="submit" name ="login" align="center" value="Submit">
     </form>  
       
 
                
    </div>
<?php
 include_once 'footer.php';
?>



 