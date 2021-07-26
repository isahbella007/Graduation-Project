<?php 
require('config.php');
if(isset($_SESSION['login'])){
    if(isset($_POST['submit'])){
        $totalCost = 0;
        $resId = $_SESSION['restaurantid'];
        $from = $_POST['fromdate'];
        $to = $_POST['todate'];
        $getInventory = "SELECT * FROM foodinventory WHERE restaurantid = '$resId'";
        $getInventoryStmt = $conn->prepare($getInventory);
        $getInventoryStmt->execute();
        $getInventoryResult = $getInventoryStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($getInventoryResult as $res){
            $totalCost = $totalCost + $res['cost'];
        }
    }
}else{
    header("location: index.php");
}
?>

<?php include('managerheader.php');?>
<div class="container-fluid">
<form method = "post">
<div class="form-group">
    	<label for="exampleInputPassword1">FROM:</label>
    	<input type="date" name = "fromdate" class="form-control" id="exampleInputPassword1" required>
</div>

<div class="form-group">
    	<label for="exampleInputPassword1">TO:</label>
    	<input type="date" name = "todate" class="form-control" id="exampleInputPassword1" required>
</div>
<input type="submit" name = "submit" class = "btn btn-primary" value = "Submit">
</form>
<br>
<?php if(isset($_POST['submit'])){?>
<?php if($getInventoryResult){?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inventory Records between <?php echo $from?> - <?php echo $to?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                     <tr>
                        <th class="m-1 font-weight-bold text-primary">ItemName</th>
                        <th class="m-0 font-weight-bold text-primary">Quantity</th>
                        <th class="m-0 font-weight-bold text-primary">Cost</th>
                        <th class="m-0 font-weight-bold text-primary">Item Purchase Date</th>
                        <th class="m-0 font-weight-bold text-primary">Recorded By</th>
                     </tr>
                    </thead>
                    <tbody>
                        <?php foreach($getInventoryResult as $inventoryResult){?>
                            <tr>
                                <td class="h6 mb-2 text-gray-800"><?php echo $inventoryResult['itemname'];?></td>
                                <td class="h6 mb-2 text-gray-800"><?php echo $inventoryResult['quantity'];?></td>
                                <td class="h6 mb-2 text-gray-800"><?php echo $inventoryResult['cost'];?></td>
                                <td class="h6 mb-2 text-gray-800"><?php echo $inventoryResult['datebought'];?></td>
                                <td class="h6 mb-2 text-gray-800"><?php echo $inventoryResult['submittedby'];?></td>
                            </tr>
                        <?php }?>
                        
                     </tbody>
                </table>
                <p class="h6 mb-2 text-gray-800">OutGoing Cost is: <?php echo $totalCost;?></p>
            </div>
        </div>
    </div>


<?php }else{?>
    <?php echo '<script type="text/javascript">';?>
    <?php echo ' alert("No Records for the Date entered ")';?>
    <?php echo '</script>';?>
    <?php }?>

<?php }?>