<?php 
require('config.php');
if(isset($_SESSION['login'])){
    // Get all the orders for current date that have been prepared. 
    $resId = $_SESSION['restaurantid'];
    date_default_timezone_set('Europe/Istanbul');
    $date = date('Y-m-d');   
    
    // Get the orders for this particular date.
    $getOrders = "SELECT * from orders WHERE status = 'PREPARED' AND restaurantid = '$resId' and orderdate = '$date' group by orderid ";
    $getOrdersStmt = $conn->prepare($getOrders); 
    $getOrdersStmt->execute();
    $getOrdersResult = $getOrdersStmt->fetchAll(PDO::FETCH_ASSOC); 
    foreach($getOrdersResult as $res){
        $orderid = $res['orderid'];
    }
}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php')?>
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
                                        <th class="m-1 font-weight-bold text-primary"> Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $orderid = $result['orderid'];?>
                                        <?php 
                                            $sql = "SELECT * FROM orders  WHERE orderid = '$orderid'  AND orderdate = '$date' ";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $mealResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                        <?php foreach($mealResult as $ress){?>
                                            <tr>
                                            <td class="h6 mb-2 text-gray-800"><?php echo $ress['orderid'];?></td>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $ress['itemname'];?></td>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $ress['quantity'];?></td>
                                                <td class="h6 mb-2 text-gray-800"><?php echo $ress['message'];?></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                <form method = "GET" action = "assignprocess.php">
                                    <input type = "submit" name = "edit" value = "Assign To Delivery Worker" class = "btn btn-primary btn-xs">
                                    <input type = "hidden" name = "edit" value = "<?php echo $ress['orderid']?>">
                                </form>
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
            echo ' alert("No meal has been prepared yet.")'; 
            echo '</script>';;?>
    <?php }?>