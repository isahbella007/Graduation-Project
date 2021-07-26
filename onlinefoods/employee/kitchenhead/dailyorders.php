<?php 
require('config.php');
if(isset($_SESSION['login'])){
    // Do stuff
    $resId = $_SESSION['restaurantid'];
    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d');  

    // Display all New orders 
    $getNewOrders = "SELECT * FROM orders WHERE restaurantid = '$resId' AND orderdate = '$date' AND status = 'New'";
    $getNewOrdersStmt = $conn->prepare($getNewOrders);
    $getNewOrdersStmt->execute();
    $getNewOrdersResult = $getNewOrdersStmt->fetchAll(PDO::FETCH_ASSOC);
    
}else{
    header("location: ../index.php");
}
?>

<?php include('kitchenheadheader.php')?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Daily Order(s)</h6>
</div>
<?php if($getNewOrdersResult){?>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="m-1 font-weight-bold text-primary">S/NO</th>
                <th class="m-0 font-weight-bold text-primary">ItemName</th>
                <th class="m-0 font-weight-bold text-primary">Price</th>
                <th class="m-0 font-weight-bold text-primary">Message</th>
                <th class="m-0 font-weight-bold text-primary">Payment method</th>
                <th class="m-0 font-weight-bold text-primary">Action</th>
        
            </tr>
        </thead>
        <tbody>
            
                 <?php foreach($getNewOrdersResult as $orderResult){?>
                    <tr>
                    
                        <td class="h6 mb-2 text-gray-800">#</td>
                        <td class="h6 mb-2 text-gray-800"><?php echo $orderResult['itemname'];?></td>
                        <td class="h6 mb-2 text-gray-800"><?php echo $orderResult['price']?>tl</td>
                        <td class="h6 mb-2 text-gray-800"><?php if($orderResult['message'] == ""){?>
                        <?php echo "The Customer did not leave a message";}else{ echo $orderResult['message']; ?><?php }?>
                        </td>
                        <td class="h6 mb-2 text-gray-800"><?php echo $orderResult['paymentmethod'];?></td>
                        <td>
                         <form method = "Get" action = "updateorder.php">
                            <button type = "submit" name = "status" class = "btn btn-primary btn-xs" value = "<?php echo $orderResult['orderid']?>">Update Status</button>
                            
                        </form>
                        </td>


                    </td>

                 <?php }?>
            <?php }else{ ?>
                     <?php echo "Sorry, No Orders Yet "?>
                   <?php }?>
        </tbody>
    </table>
</div>



</div>
