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
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $address = $_POST['address']; 
        $contact = $_POST['contact']; 
        $email = $_POST['email']; 

        $updateDetails = "UPDATE employee SET name = '$name' , surname = '$surname' , address = '$address' , contact = '$contact' , email = '$email' WHERE employeeid = '$personId' AND restaurantid = '$resId'";
        $updateDetailsStmt = $conn->prepare($updateDetails); 
        $updateDetailsStmt->execute(); 
        header("location: profile.php");
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
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" name = "name" value = "<?php echo $viewPersonDetails['name'];?>" >
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Surname</label>
        <input type="text" class="form-control" name = "surname" value = "<?php echo $viewPersonDetails['surname'];?>" >
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Contact</label>
        <input type="number" class="form-control" name = "contact" value = "<?php echo $viewPersonDetails['contact'];?>" >
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Address</label>
        <input type="text" class="form-control" name = "address" value = "<?php echo $viewPersonDetails['address'];?>" >
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" name = "email" value = "<?php echo $viewPersonDetails['email'];?>" >
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"></label>
        <input type="hidden" class="form-control" name = "image" value = "<?php echo $viewPersonDetails['image'];?>" readonly>

    </div>

    
    <input type="submit" name = "update" class="btn btn-primary" value = "Update">
    </form>

    </div>
<?php }?>
<?php }?>
</div>