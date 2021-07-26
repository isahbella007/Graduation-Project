<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $restaurantId = $_SESSION['restaurantid'];
    $postVacancy = FALSE;
    if(isset($_POST['post'])){
        $position = $_POST['position'];
        $needed = $_POST['availability'];
        $description = $_POST['description'];

        // Check if the position being entered is already in the database.
        $checkQuery = "SELECT * FROM vacancy WHERE restaurantid = '$restaurantId' AND position = '$position'";
        $checkQueryStmt = $conn->prepare($checkQuery);
        $checkQueryStmt->execute();
        $checkResult = $checkQueryStmt->fetchAll(PDO::FETCH_ASSOC);
        if($checkResult){
          echo '<script type="text/javascript">';
          echo ' alert("A Vacancy For This Position Has Already Been Posted")'; 
          echo '</script>'; 
        }else{
        // Insert into the vacancy table 
        $insertQuery = "INSERT INTO vacancy(restaurantid, position, availability, description)VALUES
        (:id, :position, :available,:description)";
        $insertQueryStmt = $conn->prepare($insertQuery);
        $insertQueryStmt->execute(array(
            ':id' => $restaurantId,
            ':position' => $position,
            ':available' => $needed, 
            ':description' => $description,
        ));
        $postVacancy = TRUE; 
        if($postVacancy){
            echo '<script type="text/javascript">';
            echo ' alert("Posted")'; 
            echo '</script>';
        }
      }
      
    }

}else{
    header("location: index.php");
}
?>

<?php include('managerheader.php');?>
<div class="container-fluid">
<div class="container">
  <h2>Post Vacancy</h2>
  <form method = "post">
    <div class="form-group">
      <label for="email">Position:</label>
      <select name="position" class="form-control" type = "text" required>
        <option >Kitchen Head</option>
        <option >Delivery Worker</option>
        <option>Kitchen Staff</option>
      </select>
    </div>

    <div class="form-group">
      <label for="pwd">Availability:</label>
      <input type="number" class="form-control" id="pwd" name="availability">
    </div>

    <div class="form-group">
      <label for="pwd">Job Description:</label>
      <input type="text" class="form-control" id="pwd" name="description">
    </div>
    
    <button type="submit" class="btn btn-primary" name = "post">Post</button>
  </form>
</div>
</div>