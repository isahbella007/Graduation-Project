<?php 
require('config.php'); 
if(isset($_SESSION['login'])){
    // Do stuff
    $resId = $_SESSION['restaurantid'];
    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d');
    // Get Incomplete order according to the date 
    $getIncompleteOrder = "SELECT * FROM orders WHERE restaurantid ='$resId' AND orderdate = '$date' AND status != 'Delivered'";
    $getIncompleteOrderStmt = $conn->prepare($getIncompleteOrder);
    $getIncompleteOrderStmt->execute();
    $getIncompleteOrderResult = $getIncompleteOrderStmt->fetchAll(PDO::FETCH_ASSOC);
}else{
    header("location: index.php");
}
?>
<?php include("managerheader.php") ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Incomplete Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                         <th class="m-1 font-weight-bold text-primary">Order Id</th>
                            <th class="m-0 font-weight-bold text-primary">Item Name</th>
                            <th class="m-0 font-weight-bold text-primary">Status</th>
    
                
                         </tr>
                    </thead>
                    <tbody>
                        <?php if($getIncompleteOrderResult){?>
                            <?php foreach($getIncompleteOrderResult as $incompleteOrderResult){?>
                                <tr>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $incompleteOrderResult['orderid'];?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $incompleteOrderResult['itemname'];?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $incompleteOrderResult['status'];?></td>
                                    
                                </tr>
                            <?php }?>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>