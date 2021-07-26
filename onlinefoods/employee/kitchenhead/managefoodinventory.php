<?php
require('config.php'); 
if(isset($_SESSION['login'])){
     // Do stuff
    $resId = $_SESSION['restaurantid'];
    $viewInventory = "SELECT * FROM foodinventory WHERE restaurantid = '$resId'";
    $viewInventoryStmt = $conn->prepare($viewInventory);
    $viewInventoryStmt->execute();
    $viewInventoryResult = $viewInventoryStmt->fetchAll(PDO::FETCH_ASSOC);
}else{
    // Redirect to the index page
    header("location: ../index.php");
}
?>

<?php include('kitchenheadheader.php');?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Food Inventory</h6>
</div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="m-1 font-weight-bold text-primary">S/NO</th>
                <th class="m-0 font-weight-bold text-primary">Item Name</th>
                <th class="m-0 font-weight-bold text-primary">Cost</th>
                <th class="m-0 font-weight-bold text-primary">Quanity</th>
                <th class="m-0 font-weight-bold text-primary">Action</th>
        
            </tr>
        </thead>
        <tbody>
         <?php if($viewInventoryResult){?>
            <?php foreach($viewInventoryResult as $result){?>
            <tr>
                <td class="h6 mb-2 text-gray-800">#</td>
                <td class="h6 mb-2 text-gray-800"><?php echo $result['itemname']?></td>
                <td class="h6 mb-2 text-gray-800"><?php echo $result['cost']?> tl </td>
                <td class="h6 mb-2 text-gray-800"><?php echo $result['quantity']?></td>
                <td class="h6 mb-2 text-gray-800">
                    <form method = "GET" action = "editfoodinventory.php">
                        <a href = "#" class=><input type = "submit" name = "edit" value = "Edit" class = "btn btn-warning btn-xs">
                        <input type = "hidden" name = "edit" value = "<?php echo $result['id']?>">
                    </form>
                </td>

            </tr>
            <?php } ?>
        <?php } ?> 
        </tbody>
</div>
</div>