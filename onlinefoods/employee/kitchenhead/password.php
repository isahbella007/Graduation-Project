<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $personId = $_SESSION['id'];
    $getPersonDetail = "SELECT * FROM employee WHERE employeeid = '$personId' ";
    $getPersonDetailStmt = $conn->prepare($getPersonDetail);
    $getPersonDetailStmt->execute();
    $getPersonDetailsResult = $getPersonDetailStmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['update'])){
        $personId = $_SESSION['id'];
        $resId =  $_SESSION['restaurantid'];
        $password = $_POST['password'];

        $updatePassword = "UPDATE employee set password = '$password' WHERE employeeid = '$personId' AND  restaurantid = '$resId'"; 
        $updatePasswordStmt = $conn->prepare($updatePassword); 
        $updatePasswordStmt->execute(); 
        header("location: password.php");
    }
}else{
    header("location: ../index.php");
}

?>
<?php include('kitchenheadheader.php');?>
<style class="cp-pen-styles">.me {
  display: block;
  margin: 2em auto;
  margin-bottom: 3em;
  width: auto;
  height: 200px;
  border-radius: 50%;
  position: relative;
  z-index: 2;
}

</style>
<div class="container-fluid">
<?php if($getPersonDetailsResult){?>
 <?php foreach($getPersonDetailsResult as $viewPersonDetails){?>
    <img class="me" src="../../userspictures./<?php echo $viewPersonDetails['image'];?>" alt="" />


    <div class = "container">
    <form method = "post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Old Password</label>
        <input type="text" class="form-control" name = "password" value = "<?php echo $viewPersonDetails['password'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">New Password</label>
        <input type="password" class="form-control" name = "password"  >
    </div>

    <input type="submit" name = "update" class="btn btn-primary" value = "Change Password">
    </form>
 <?php }?>
<?php }?>