<?php 
require('config.php');
if(isset($_SESSION['login'])){
    if(isset($_GET['edit'])){
      $resId = $_SESSION['restaurantid'];
      $vacancyId = $_GET['edit'];
      // echo $vacancyId;
      $vancancyQuery = "SELECT * FROM vacancy WHERE vacancyid = '$vacancyId'";
      $vancancyQueryStmt = $conn->prepare($vancancyQuery);
      $vancancyQueryStmt->execute();
      $vancancyResult = $vancancyQueryStmt->fetchAll(PDO::FETCH_ASSOC);

      // Delete Data
      $deleteVacancy = false;
      if(isset($_POST['delete'])){
        $vacancyId = $_GET['edit'];
        $position = $_POST['position'];
        $needed = $_POST['needed'];
        $description = $_POST['description'];
        $flag = $_POST['flag'];

        // Delete from Vacancy and Apply Table.
        
        $deleteQuery = "DELETE FROM vacancy WHERE vacancyid = '$vacancyId' AND restaurantid = '$resId'";
        
        $deleteQueryStmt = $conn->prepare($deleteQuery);
        $deleteQueryStmt->execute();
       

        // Now delete people who applied for the deleted vacancy position 
        $deleteAppliedPeople = "DELETE FROM apply WHERE position = '$position' AND restaurantid = '$resId'";
        $deleteStmt = $conn->prepare($deleteAppliedPeople);
        $deleteStmt->execute();

        $deleteVacancy = True;
        if($deleteVacancy){
           header("location: viewvacancy.php");
        }
      }

          // Update Vacancy
      
      if(isset($_POST['update'])){
        $vacancyUpate = $_GET['edit'];
        $updatePosition = $_POST['position'];
        $updateNeed = $_POST['needed'];
        $updateDescription = $_POST['description'];
        $updateFlag = $_POST['flag'];

        echo $resId;
        $query = "UPDATE vacancy SET position = '$updatePosition', availability = '$updateNeed', 
        description ='$updateDescription', flag = '$updateFlag' WHERE vacancyid = '$vacancyUpate' AND restaurantid = '$resId'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $updateVacancy = TRUE;
        if($updateVacancy){
          header("location: viewvacancy.php");
        }
        

      }

    }

  

}else{
    header("location: index.php");
}
?>

<?php include('managerheader.php');?>
<div class="container-fluid">
<form class="form-horizontal" role="form" method = "post" >
    <fieldset>
      
      <div class="form-group">
        <label class="col-sm-3 control-label" for="card-holder-name">Vacancy</label>
        <div class="col-sm-9">
            <?php foreach($vancancyResult as $viewResult){?>
                <div class="form-group">
                    <label for="email">Position:</label>
                    <input type="text" class="form-control" name="position" id="card-holder-name" value = "<?php echo $viewResult['position'];?>">
                </div>

                <div class="form-group">
                    <label for="email">Needed:</label>
                    <input type="number" class="form-control" name="needed" id="card-holder-name" value = "<?php echo $viewResult['availability'];?>">
                </div>

                <div class="form-group">
                    <label for="email">Job Description:</label>
                    <input type="text" class="form-control" name="description" id="card-holder-name" value = "<?php echo $viewResult['description'];?>">
                </div>

                <div class="form-group">
                    <label for="email">Status:</label>
                    <select type="text" class="form-control" name="flag" id="card-holder-name">
                        <option>ACTIVE </option>
                        <option> CLOSED</option>
                        <option> ON HOLD</option>
                    </select>
                </div>
          
          <?php }?>
        </div>
      </div>
    <br><br><br>
       
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" class="btn btn-success" name = "update">Update</button>
        </div>
      </div>   

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" class="btn btn-danger" name = "delete">Delete</button>
        </div>
      </div>

    </fieldset>
  </form>

</div>
