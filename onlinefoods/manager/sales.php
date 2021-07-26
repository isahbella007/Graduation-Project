<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
    // Do stuff
    if(isset($_POST['submit'])){
        $totalSales = 0;
        $from = $_POST['fromdate'];
        $to = $_POST['todate'];
        $getSales = "SELECT itemname, orderid, price FROM orders WHERE restaurantid = '$resId' AND status = 'Paid' OR status = 'Delivered' AND orderdate between '$from' AND '$to'";
        $getSalesStmt = $conn->prepare($getSales);
        $getSalesStmt->execute();
        $getSalesResult = $getSalesStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($getSalesResult as $res){
            $totalSales = $totalSales + $res['price'];
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
<?php if($getSalesResult){?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sales between <?php echo $from?> - <?php echo $to?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                     <tr>
                        <th class="m-1 font-weight-bold text-primary">Order Number</th>
                        <th class="m-0 font-weight-bold text-primary">ItemName</th>
                        <th class="m-0 font-weight-bold text-primary">Price</th>
                        
                     </tr>
                    </thead>
                    <tbody>
                        <?php foreach($getSalesResult as $salesResult){?>
                            <tr>
                                <td class="h6 mb-2 text-gray-800"><?php echo $salesResult['orderid'];?></td>
                                <td class="h6 mb-2 text-gray-800"><?php echo $salesResult['itemname'];?></td>
                                <td class="h6 mb-2 text-gray-800"><?php echo $salesResult['price'];?></td>
                            </tr>
                        <?php }?>
                        
                     </tbody>
                </table>
                <p class="h6 mb-2 text-gray-800">Total Price is: <?php echo $totalSales;?></p>
            </div>
        </div>
    </div>

<?php }else{?>
<!-- <p>Sorry, No sales were made between <?php echo $from?> to <?php echo $to?></p> -->
<?php echo '<script type="text/javascript">';?>
<?php echo ' alert("Sorry, No sales were made between the dates you entered")';?>
<?php echo '</script>';?>
<?php }?>
<?php }?>
</div>