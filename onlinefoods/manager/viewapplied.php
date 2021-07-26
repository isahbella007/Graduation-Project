<?php 
require('config.php');
// error_reporting(E_ERROR | E_PARSE);
if(isset($_SESSION['login'])){
    if(isset($_POST['edit'])){
        $unemployedPerson =  $_POST['edit'];
        $getPersonDetails = "SELECT * FROM apply WHERE applyid = '$unemployedPerson'";
        $getPersonDetailsStmt = $conn->prepare($getPersonDetails);
        $getPersonDetailsStmt->execute(); 
        $getPersonDetailsResult = $getPersonDetailsStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Hire Employee
    $hireSucessful = FALSE;
    $hireBackEndComplete = FALSE;
    if(isset($_POST['hire'])){
        $restaurantid = $_SESSION['restaurantid'];
        $name = $_POST['name']; 
        $surname = $_POST['surname']; 
        $contact = $_POST['contact']; 
        $address = $_POST['address']; 
        $email = $_POST['email']; 
        $gender = $_POST['gender']; 
        $position = $_POST['position']; 
        $image = $_POST['image'];
        $applyid = $_POST['applyid'];

        // If availabaility == 0; Tell the manager that he cannot hire another person. 
        // He should update the staff need for this position
        $availabilityCheck = "SELECT availability FROM vacancy WHERE position = '$position' 
        AND restaurantid = '$restaurantid'";
        $availabilityCheckStmt = $conn->prepare($availabilityCheck);
        $availabilityCheckStmt->execute();
        $availabilityCheckResult = $availabilityCheckStmt->fetch(PDO::FETCH_ASSOC);
        foreach($availabilityCheckResult as $checking){
            echo $checking;
        }
        if($checking >0){
            $hireEmployee = "INSERT INTO employee(restaurantid,name, surname, contact, address, email,
             gender,position, image)
            VALUES(:resid, :name, :surname, :contact, :address, :email, :gender, :position, :image)";

            $hireEmployeeStmt = $conn->prepare($hireEmployee);
            $hireEmployeeStmt->execute(array(
            ':resid' => $restaurantid, 
            ':name' => $name, 
            ':surname' => $surname,
            ':contact' => $contact, 
            ':address' => $address, 
            ':email' => $email, 
            ':gender' => $gender, 
            ':position' => $position, 
            ':image' => $image,
            ));
            $hireSucessful = TRUE;
            if($hireSucessful){
                // If the manager has hired an employee, reduce the number of people needed for the position.
                $reduceNeed = 1;
                $getNeed = "SELECT availability FROM vacancy WHERE position = '$position'
                AND restaurantid = '$restaurantid'";
                $getNeedStmt = $conn->prepare($getNeed); 
                $getNeedStmt->execute(); 
                $getNeedResult = $getNeedStmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($getNeedResult as $needResult){
                    $vacancyAvailability =  $needResult;
                }
                // First, get the result, convert it to string them convert it to integar in order 
                // to carry out the update query
                // Update the database with the new value of workers needed 
                echo $string = implode('',$vacancyAvailability);
                echo $newNeedAvailabality = intval($string);
                $newNeed = $newNeedAvailabality - $reduceNeed;
                $updateAvailabilty = "UPDATE vacancy SET availability = '$newNeed' WHERE position = '$position' 
                AND restaurantid = '$restaurantid'";
                $updateAvailabiltyStmt = $conn->prepare($updateAvailabilty); 
                $updateAvailabiltyStmt->execute();
    
                // Delete the persom who was just hired from the 'applied' Table.
                $deletePerson = "DELETE FROM apply WHERE position = '$position' AND restaurantid = '$restaurantid'
                AND applyid = '$applyid'"; 
                $deletePersonStmt = $conn->prepare($deletePerson); 
                $deletePersonStmt->execute();

                // $hireBackEndComplete = TRUE;
            }
                // if($hireBackEndComplete){
                //     header("location: applied.php");
                // } 
        }else{
            echo '<script type="text/javascript">';
            echo ' alert("Sorry you cannot hire someone right now because all vacancy slots are filled")'; 
            echo '</script>';
        }  
    }
    // Next is if the manager clicks on Reject 
    // Delete the person he rejected from the apply table
    if(isset($_POST['reject'])){
        $position = $_POST['position'];
        $restaurantid = $_SESSION['restaurantid'];
        $applyid = $_POST['applyid'];

        $deleteUnemployed = "DELETE FROM apply WHERE position = '$position' AND restaurantid = '$restaurantid' AND applyid = '$applyid'";
        $deleteUnemployedStmt = $conn->prepare($deleteUnemployed);
        $deleteUnemployedStmt->execute();

        header("location: applied.php");
    }
}else{
    header("location: index.php");
}
?>

<?php include('managerheader.php');?>
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
    <?php if($viewPersonDetails['image'] != null){?>
        <img class="me" src="../userspictures./<?php echo $viewPersonDetails['image'];?>" alt="" />
    <?php }?>

    <?php if($viewPersonDetails['image'] == null){?>
        <img class="me" src="../userspictures./default.jpg" alt="" />
    <?php }?>
    


    <div class = "container">
    <form method = "post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" name = "name" value = "<?php echo $viewPersonDetails['name'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Surname</label>
        <input type="text" class="form-control" name = "surname" value = "<?php echo $viewPersonDetails['surname'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Contact</label>
        <input type="text" class="form-control" name = "contact" value = "<?php echo $viewPersonDetails['contact'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Address</label>
        <input type="text" class="form-control" name = "address" value = "<?php echo $viewPersonDetails['address'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" name = "email" value = "<?php echo $viewPersonDetails['email'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Description</label>
        <input type="text" class="form-control" name = "description" value = "<?php echo $viewPersonDetails['description'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Gender</label>
        <input type="text" class="form-control" name = "gender" value = "<?php echo $viewPersonDetails['gender'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Position</label>
        <input type="text" class="form-control" name = "position" value = "<?php echo $viewPersonDetails['position'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"></label>
        <input type="hidden" class="form-control" name = "image" value = "<?php echo $viewPersonDetails['image'];?>" readonly>
        <input type="hidden" class="form-control" name = "applyid" value = "<?php echo $viewPersonDetails['applyid'];?>" readonly>

    </div>

    
    <input type="submit" name = "hire" class="btn btn-primary" value = "Hire!">
    <input type="submit" name = "reject" class="btn btn-danger" value = "Reject!">
    </form>

    </div>
<?php }?>
<?php }?>
</div>