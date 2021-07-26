<?php
require('config.php'); 
if(isset($_SESSION['login'])){
    // Do stuff
    if(isset($_POST['submit'])){
        $kitchenHeadName = $_SESSION['name'];
        $resId = $_SESSION['restaurantid'];
        $itemName = $_POST['itemname'];
        $cost = $_POST['cost'];
        $quantity = $_POST['qty'];
        $purchaseDate = $_POST['date'];
        $dt1=date("Y-m-d");

        // Insert into the food inventory table
        $insertQuery = "INSERT INTO foodinventory (restaurantid,itemname, cost, quantity, datebought, dateentered, 
        submittedby,updatedby)VALUES(:resid, :itemname, :cost, :qty, :datebought, :dateentered, :submittedby, :updatedby)";
        
        $insertQueryStmt = $conn->prepare($insertQuery); 
        $insertQueryStmt->execute(array(
            ':resid' => $resId, 
            ':itemname' => $itemName, 
            ':cost' => $cost, 
            ':qty' => $quantity, 
            ':datebought' => $purchaseDate, 
            ':dateentered' => $dt1, 
            ':submittedby' => $kitchenHeadName, 
            ':updatedby' => $kitchenHeadName
        ));
            echo '<script type="text/javascript">';
            echo ' alert("Record Submitted")'; 
            echo '</script>';
    }
}else{
    // Redirect to the index page
    header("location: ../index.php");
}
?>

<?php include('kitchenheadheader.php');?>
<div class="container-fluid">
<form method = "post">

<div class="form-group">
    	<label for="exampleInputPassword1">ItemName</label>
    	<input type="text" name = "itemname" class="form-control" id="exampleInputPassword1" required>
  </div>

   <div class="form-group">
    	<label for="exampleInputPassword1">Cost</label>
    	<input type="text" name = "cost" class="form-control" id="exampleInputPassword1" placeholder = "Please enter the total amount you spent on this Item" required>
  </div>

  <div class="form-group">
    	<label for="exampleInputPassword1">Quantity</label>
    	<input type="number" name = "qty" class="form-control" id="exampleInputPassword1" placeholder = "Please enter the total quantity you purchased for the Item" required>
  </div>

  <div class="form-group">
    	<label for="exampleInputPassword1">Date Of Purchase</label>
    	<input type="date" name = "date" class="form-control" id="exampleInputPassword1" required>
  </div>


  <button type="submit" class="btn btn-primary" name="submit" >Submit</button>


</form>
</div>