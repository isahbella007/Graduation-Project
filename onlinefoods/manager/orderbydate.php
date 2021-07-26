<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d');   
    
    // Get the orders for this particular date.
    $getOrders = "SELECT * from orders WHERE orderdate = '$date' AND restaurantid = '$resId'";
    $getOrdersStmt = $conn->prepare($getOrders); 
    $getOrdersStmt->execute();
    $getOrdersResult = $getOrdersStmt->fetchAll(PDO::FETCH_ASSOC); 

    
}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php')?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Daily Order(s)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="m-1 font-weight-bold text-primary">Order Id</th>
                <th class="m-0 font-weight-bold text-primary">ItemName</th>
                <th class="m-0 font-weight-bold text-primary">Quantity</th>
                <th class="m-0 font-weight-bold text-primary">Price</th>
                <th class="m-0 font-weight-bold text-primary">Status</th>
                
        
            </tr>
        </thead>
        <tbody>
            <?php if($getOrdersResult){?>
                 <?php foreach($getOrdersResult as $orderResult){?>
                    <tr>
                    
                        <td class="h6 mb-2 text-gray-800"><?php echo $orderResult['orderid'];?></td>
                        <td class="h6 mb-2 text-gray-800"><?php echo $orderResult['itemname'];?></td>
                        <td class="h6 mb-2 text-gray-800"><?php echo $orderResult['quantity'];?></td>
                        <td class="h6 mb-2 text-gray-800"><?php echo $orderResult['price']?></td>
                        <td class="h6 mb-2 text-gray-800"><?php echo $orderResult['status'];?></td>
                        


                    </td>

                 <?php }?>
            <?php }else{ ?>
                     <?php echo "Sorry, No Orders Yet"?>
                   <?php }?>
        </tbody>
    </table>
</div>