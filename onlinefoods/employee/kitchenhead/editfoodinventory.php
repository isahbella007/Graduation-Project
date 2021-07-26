<?php
require('config.php'); 
if(isset($_SESSION['login'])){
     // Do stuff
     if(isset($_GET['edit'])){
        $inventoryId= $_GET['edit'];
        $resId = $_SESSION['restaurantid'];
        $viewInventory = "SELECT * FROM foodinventory WHERE restaurantid = '$resId' AND id = '$inventoryId'";
        $viewInventoryStmt = $conn->prepare($viewInventory);
        $viewInventoryStmt->execute();
        $viewInventoryResult = $viewInventoryStmt->fetchAll(PDO::FETCH_ASSOC);

        if(isset($_POST['update'])){
            $itemName = $_POST['itemname'];
            $cost = $_POST['cost']; 
            $qty = $_POST['qty'];
            $updatedby = $_SESSION['name'];
            $inventoryId = $_GET['edit'];
            $resId = $_SESSION['restaurantid'];
    
            $updateQuery = "UPDATE foodinventory set  itemname= '$itemName'
            , cost = '$cost', quantity = '$qty' , updatedby = '$updatedby' 
            WHERE restaurantid = '$resId' AND id = '$inventory'";
            $updateQueryStmt = $conn->prepare($updateQuery); 
            $updateQueryStmt->execute(); 
            header("location: managefoodinventory.php");
        }
    }
    
}else{
    // Redirect to the index page
    header("location: ../index.php");
}
?>

<?php include('kitchenheadheader.php');?>
<div class="container-fluid">
<form method = "post">
<?php foreach($viewInventoryResult as $result){?>

<div class="form-group">
    	<label for="exampleInputPassword1">ItemName</label>
    	<input type="text" name = "itemname" class="form-control" id="exampleInputPassword1" value = "<?php echo $result['itemname'];?>" required>
  </div>

   <div class="form-group">
    	<label for="exampleInputPassword1">Cost</label>
    	<input type="text" name = "cost" class="form-control" id="exampleInputPassword1" value = "<?php echo $result['cost'];?>" required>
  </div>

  <div class="form-group">
    	<label for="exampleInputPassword1">Quantity</label>
    	<input type="number" name = "qty" class="form-control" id="exampleInputPassword1" value = "<?php echo $result['quantity'];?>" required>
  </div>


  <button type="submit" class="btn btn-primary" name="update" >Update</button>

<?php } ?>
</form>
</div>