<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
    if(isset($_GET['employeeid'])){
        // echo "You CLicked on View History";
         $employeViewId = $_GET['employeeid'];
        $checkPosition = "SELECT * FROM employee WHERE employeeid = '$employeViewId' AND restaurantid = '$resId'";
        $checkPositionStmt = $conn->prepare($checkPosition);
        $checkPositionStmt->execute();
        $checkPositionResult = $checkPositionStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($checkPositionResult as $staff){
            $staffPosition = $staff['position'];
        }
    }
    if(isset($_GET['employeeprofileid'])){
        
        $employeeid = $_GET['employeeprofileid'];
        $getPersonDetail = "SELECT * FROM employee WHERE employeeid = '$employeeid' ";
        $getPersonDetailStmt = $conn->prepare($getPersonDetail);
        $getPersonDetailStmt->execute();
        $getPersonDetailsResult = $getPersonDetailStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Update the employee status to fired.
    if(isset($_POST['fire'])){
        $employeeId = $_GET['employeeprofileid'];
        // Ccheck if the employee the manager wants to fire is busy
        $employeeStatusCheck = "SELECT * FROM employee WHERE employeeid = '$employeeId' AND status = 'Available'
         OR status = 'Offline' AND restaurantid = '$resId'";
        $employeeStatusCheckStmt = $conn->prepare($employeeStatusCheck);
        $employeeStatusCheckStmt->execute();
        $employeeStatusCheckResult = $employeeStatusCheckStmt->fetchAll(PDO::FETCH_ASSOC);
        if($employeeStatusCheckResult){
            $updateEmployeeStatus = "UPDATE employee SET status = 'FIRED' WHERE restaurantid = '$resId' AND employeeid = '$employeeId'";
            $updateEmployeeStatusStmt = $conn->prepare($updateEmployeeStatus);
            $updateEmployeeStatusStmt->execute();
            echo '<script type="text/javascript">';
            echo ' alert("You have fired this employee")'; 
            echo '</script>';
            header("location: manageemployees.php"); 
        }else{
            echo '<script type="text/javascript">';
            echo ' alert("Sorry, You cannot fire this employee. They are busy with an order")'; 
            echo '</script>';
        }
    }
}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php');?>
<div class="container-fluid">
<!-- Stary with Profile. If the proile button is clickes, do this -->
<?php if(isset($_GET['employeeprofileid'])){?>
    <style class="cp-pen-styles">.me {
  display: block;
  margin: 2em auto;
  margin-bottom: 3em;
  width: auto;
  height: 200px;
  border-radius: 50%;
  position: relative;
  z-index: 2;
}

</style>
<div class="container-fluid">
<?php if($getPersonDetailsResult){?>
 <?php foreach($getPersonDetailsResult as $viewPersonDetails){?>
    <?php if($viewPersonDetails['image']){?>
     <img class="me" src="../userspictures./<?php echo $viewPersonDetails['image'];?>" alt="" />
    <?php }else{?>
        <img class="me" src="../userspictures/default.jpg" alt = "Users has no picture">
    <?php }?>


    <div class = "container">
    <form method = "post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" name = "name" value = "<?php echo $viewPersonDetails['name'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Surname</label>
        <input type="text" class="form-control" name = "surname" value = "<?php echo $viewPersonDetails['surname'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Contact</label>
        <input type="number" class="form-control" name = "contact" value = "<?php echo $viewPersonDetails['contact'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Address</label>
        <input type="text" class="form-control" name = "address" value = "<?php echo $viewPersonDetails['address'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" name = "email" value = "<?php echo $viewPersonDetails['email'];?>" readonly>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"></label>
        <input type="hidden" class="form-control" name = "image" value = "<?php echo $viewPersonDetails['image'];?>" readonly>

    </div>

    
    <input type="submit" name = "fire" class="btn btn-danger" value = "Fire">
    </form>

    </div>
<?php }?>
<?php }else{?>
<?php echo "You fired an employee"; }?>
</div>

<?php }?>

<!-- Display content for when a person clicks on view history -->
<?php if(isset($_GET['employeeid'])){?>
    <!-- Display the content to show the persons history -->
    
    <!-- If the position of the staff is kitchen staff, display this stuff. -->
    <?php if($staffPosition == 'Kitchen Staff'){?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="m-1 font-weight-bold text-primary">OrderId</th>
                        <th class="m-0 font-weight-bold text-primary">Status</th>
                        <th class="m-0 font-weight-bold text-primary">Rating</th>
                        <th class="m-0 font-weight-bold text-primary">Customer Note</th>
                        <th class="m-0 font-weight-bold text-primary">Order Date</th>
                        
                
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $getKitchenStaffOrders = "SELECT employeehistory.orderid, orders.status, orders.orderdate 
                        FROM employeehistory INNER join orders ON employeehistory.orderid = orders.orderid
                        WHERE employeehistory.employeeid = '$employeViewId' GROUP BY orders.orderid ";
                        $getStmt = $conn->prepare($getKitchenStaffOrders);
                        $getStmt->execute();
                        $getKitchenStaffOrdersResult = $getStmt->fetchAll(PDO::FETCH_ASSOC);
                        
                    ?>
                    <?php foreach($getKitchenStaffOrdersResult as $kitchenStaffResult){?>
                        <?php 
                            // Use the order id to get things from the rating table. 
                            $kitchenStaffOrderId = $kitchenStaffResult['orderid'];
                            $getKitchenStaffRating = "SELECT * FROM ratings WHERE orderid ='$kitchenStaffOrderId'";
                            $getKitchenStaffRatingStmt = $conn->prepare($getKitchenStaffRating);
                            $getKitchenStaffRatingStmt->execute();
                            $getKitchenStaffRatingsResult = $getKitchenStaffRatingStmt->fetchAll(PDO::FETCH_ASSOC);
                            if($getKitchenStaffRatingsResult){?>
                                <?php foreach($getKitchenStaffRatingsResult as $kkk){?>
                                    <tr>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['orderid'];?> </td>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['status'];?></td>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kkk['total'];?></td>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kkk['note'];?></td>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['orderdate'];?></td>
                                    </tr>
                                <?php }?>
                            <?php }else{?>
                               <tr>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['orderid'];?> </td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['status'];?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo "Not Rated";?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo "No Note was left.";?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['orderdate'];?></td>
                               </tr>
                            <?php }?>
                        
                    <?php }?>
                </tbody>
            </table>
        </div>
        
    <?php }?>

    <!-- If the position of the staff clicked is Delivery worker, display stuff -->
    <?php if($staffPosition == 'Delivery Worker'){?>
        <!-- Display Table Header. -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="m-1 font-weight-bold text-primary">OrderId</th>
                        <th class="m-0 font-weight-bold text-primary">Status</th>
                        <th class="m-0 font-weight-bold text-primary">Customer Note</th>
                        <th class="m-0 font-weight-bold text-primary">Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $getKitchenStaffOrders = "SELECT employeehistory.orderid, orders.status, orders.orderdate 
                        FROM employeehistory INNER join orders ON employeehistory.orderid = orders.orderid
                        WHERE employeehistory.employeeid = '$employeViewId' GROUP BY orders.orderid ";
                        $getStmt = $conn->prepare($getKitchenStaffOrders);
                        $getStmt->execute();
                        $getKitchenStaffOrdersResult = $getStmt->fetchAll(PDO::FETCH_ASSOC);
                        
                    ?>
                    <?php foreach($getKitchenStaffOrdersResult as $kitchenStaffResult){?>
                        <?php 
                            // Use the order id to get things from the rating table. 
                            $kitchenStaffOrderId = $kitchenStaffResult['orderid'];
                            $getKitchenStaffRating = "SELECT * FROM ratings WHERE orderid ='$kitchenStaffOrderId'";
                            $getKitchenStaffRatingStmt = $conn->prepare($getKitchenStaffRating);
                            $getKitchenStaffRatingStmt->execute();
                            $getKitchenStaffRatingsResult = $getKitchenStaffRatingStmt->fetchAll(PDO::FETCH_ASSOC);
                            if($getKitchenStaffRatingsResult){?>
                                <?php foreach($getKitchenStaffRatingsResult as $kkk){?>
                                    <tr>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['orderid'];?> </td>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['status'];?></td>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kkk['note'];?></td>
                                        <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['orderdate'];?></td>
                                    </tr>
                                <?php }?>
                            <?php }else{?>
                               <tr>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['orderid'];?> </td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['status'];?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo "No Note was left.";?></td>
                                    <td class="h6 mb-2 text-gray-800"><?php echo $kitchenStaffResult['orderdate'];?></td>
                               </tr>
                            <?php }?>
                        
                    <?php }?>
                </tbody>
            </table>
        </div>


    <?php }?>

    <!-- If the position of the Staff clicked is Kitchen Head, display certain things  -->
    <?php if($staffPosition == 'Kitchen Head'){?>
        Display Kitchen Head History.
    <?php }?>
<?php }?>
</div>
