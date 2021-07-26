<?php 
require('config.php');
if(isset($_SESSION['login'])){
    if(isset($_POST['submit'])){
        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];
        $resId = $_SESSION['restaurantid'];

        // Get itemname, quantity, customermessage, staff meal was assigned to, staff who delivered the meal
        // Rating that the customer gave.
        $getOrder = "SELECT * FROM orders WHERE restaurantid = '$resId' AND orderdate Between 
        '$fromdate' AND '$todate' GROUP BY orderid";
        $getOrderStmt = $conn->prepare($getOrder);
        $getOrderStmt->execute();
        $getOrdersResult = $getOrderStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php');?>
<?php if($getOrdersResult){?>
<section class="py-5 bg-white py-5">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                <div class= "card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-1 col-sm-2 col-md-1 mr-3">
                            <i class="fa fa-cutlery fa-4x "></i></br>
                            </div>
                            
                            <div class="col-xs-8 col-sm-7 col-md-8">
                                <?php foreach($getOrdersResult as $result){?>
                                <table class='table text-center  '>
                                    <thead>
                                        <tr>
                                        <th class="m-1 font-weight-bold text-primary">Order Id</th>
                                        <th class="m-1 font-weight-bold text-primary">Item Name</th>
                                        <th class="m-1 font-weight-bold text-primary">Quantity</th>
                                        <th class="m-1 font-weight-bold text-primary">Item Price</th>
                                        <th class="m-1 font-weight-bold text-primary">Total</th>
                                        <th class="m-1 font-weight-bold text-primary"> Customer Message</th>
                                        <th class="m-1 font-weight-bold text-primary"> Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $orderid = $result['orderid'];?>
                                        <?php 
                                            $sql = "SELECT * FROM orders  WHERE orderid = '$orderid'  ";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $mealResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        ?>
                                        <?php foreach($mealResult as $ress){?>
                                            <tr>
                                            <td class="h6 mb-2 text-gray-800"><?php echo $ress['orderid'];?></td>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $ress['itemname'];?></td>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $ress['quantity'];?></td>
                                                <!-- Do the math to get the orignal item price -->
                                                <?php 
                                                    $quantity = $ress['quantity'];
                                                    $total_price = $ress['price'];
                                                    $itemPrice = $total_price/$quantity;
                                                ?>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $itemPrice;?></td>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $ress['price'];?></td>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $ress['message'];?></td>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $ress['status'];?></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                
                                <br>
                                <br>
                                <?php }?>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
        </div>
     </section>
<?php }else{?>
    <?php echo '<script type="text/javascript">';
            echo ' alert("No orders for the date selected")'; 
            echo '</script>';;?>
    <?php }?>