<?php 
require('config.php');
if(isset($_SESSION['login'])){
    // Do stuff
    $resId = $_SESSION['restaurantid'];
    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d');

    // Get Complete(Deleivered) Orders
    $getCompleteOrders = "SELECT * FROM orders WHERE restaurantid = '$resId' AND status = 'Delivered' AND orderdate ='$date'";
    $getCompleteOrdersStmt = $conn->prepare($getCompleteOrders);
    $getCompleteOrdersStmt->execute();
    $getCompleteOrdersResult = $getCompleteOrdersStmt->fetchAll(PDO::FETCH_ASSOC);
}else{
    header("location: index.php");
}
?>
<?php include("managerheader.php") ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Complete Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                         <th class="m-1 font-weight-bold text-primary">S/NO</th>
                            <th class="m-0 font-weight-bold text-primary">Item Name</th>
                            <th class="m-0 font-weight-bold text-primary">Status</th>
                            <th class="m-0 font-weight-bold text-primary">Price</th>
                
                         </tr>
                    </thead>
                    <tbody>
                        <?php if($getCompleteOrdersResult){?>
                            <?php foreach($getCompleteOrdersResult as $CompleteOrderResult){?>
                                <tr>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $CompleteOrderResult['orderid'];?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $CompleteOrderResult['itemname'];?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $CompleteOrderResult['status'];?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $CompleteOrderResult['price'];?></td>
                                </tr>
                            <?php }?>
                        <?php }else{?>
                            <p>Sorry, No order has been paid for </p>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>