<?php
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
    if(isset($_GET['orderid'])){
        $orderid =  $_GET['orderid'];
        // Get order Details 
        $sql = "SELECT orders.itemname, orders.orderid,  orders.price, orders.quantity, employeehistory.employeeid 
        from orders inner join employeehistory where orders.orderid = '$orderid'
        AND  employeehistory.orderid = '$orderid'
        AND orders.restaurantid = '$resId' AND employeehistory.restaurantid = '$resId' group by employeehistory.employeeid";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $orderhistory){
            $itemName = $orderhistory['itemname'];
            $quantity = $orderhistory['quantity'];
            $price = $orderhistory['price']/$quantity;
        }
    }
    
}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php');?>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
</head>

    <section class="py-5 bg-white py-5">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-1 col-sm-2 col-md-1 mr-3">
                            <i class="fa fa-cutlery fa-4x "></i></br>
                            </div>
                            <div class="col-xs-8 col-sm-7 col-md-8">
                                <?php if($result){?>
                                    <p>Order Id:  <?php echo $orderid ?></p>
                                    <p>Item Name: <?php echo $itemName ?></p> 
                                    <p>Price: <?php echo $price?>TL</p>  
                                    <p>Quantity: <?php  echo $quantity?></p> 
                                    <?php foreach($result as $rek){?>
                                        <?php $employeeids = $rek['employeeid'];?>
                                        <?php
                                            $get = "SELECT * FROM employee WHERE employeeid = '$employeeids'";
                                            $getStmt = $conn->prepare($get);
                                            $getStmt->execute();
                                            $getResult =$getStmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($getResult as $finalRes){
                                                if($finalRes['position'] == 'Kitchen Staff'){
                                                    $staffName = $finalRes['name'];
                                                    $staffSurName = $finalRes['surname'];
                                                }
                                                if($finalRes['position'] == 'Delivery Worker'){
                                                    $deliveryStaffName = $finalRes['name'];
                                                    $deliveryStaffSurName = $finalRes['surname'];
                                                }
                                            }
                                        ?> 
                                    <?php }?>
                                    <p>Prepared By: <?php echo $staffName?> <?php echo $staffSurName?> </p> 
                                    <p>Deleivered By: <?php echo $deliveryStaffName?> <?php echo $deliveryStaffSurName?></p>
                                <?php }else{?>
                                        <p>Order Id: <?php echo $orderid;?></p>
                                        <?php 
                                            // Get details about the order. 
                                            $unassigned = "SELECT * FROM orders WHERE orderid = '$orderid'";
                                            $unassignedStmt = $conn->prepare($unassigned);
                                            $unassignedStmt->execute();
                                            $unassignedResult = $unassignedStmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($unassignedResult as $uR){
                                                $unassignedItemName = $uR['itemname'];
                                                $unassignedQuantity = $uR['quantity'];
                                                $unassignedPrice = $uR['price']/$unassignedQuantity;
                                            }
                                        ?>
                                        <p>ItemName: <?php echo $unassignedItemName;?></p>
                                        <p>Price: <?php echo $unassignedPrice;?></p>
                                        <p>Quantity: <?php echo $unassignedQuantity;?></p>
                                        <p>Prepared By: No One Yet.</p>
                                        <p>Deleivered By: No One Yet.</p>
                                
                                    <?php }?>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
        </div>
    </section>
