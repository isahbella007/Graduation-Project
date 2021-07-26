<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
    if(isset($_GET['edit'])){
        echo $orderId = $_GET['edit'];

        $getKitchenStaff = "SELECT * FROM employee WHERE restaurantid = '$resId' AND position ='Kitchen Staff' 
        AND status = 'Available'";
        $getKitchenStaffStmt = $conn->prepare($getKitchenStaff);
        $getKitchenStaffStmt->execute(); 
        $getKitchenStaffResult = $getKitchenStaffStmt->fetchAll(PDO::FETCH_ASSOC);

        
        if(isset($_POST['assign'])){
            echo "dd";
            $resId = $_SESSION['restaurantid'];
            $orderId = $_GET['edit'];
            $checkbox1 = $_POST['chkl'];
            for($i = 0; $i<sizeof($checkbox1); $i++){
                $insertQuery = "INSERT INTO employeehistory(restaurantid, employeeid, orderid)values(:resid, :employeeid, :orderid)";
                $insertQueryStmt = $conn->prepare($insertQuery);
                $insertQueryStmt->execute(array(
                    ':resid' => $resId, 
                    ':employeeid' => $checkbox1[$i], 
                    ':orderid' => $orderId,
                    
                ));
            }
            
            // Update the status of the order.
            $updateStatus = "UPDATE orders SET status = 'Assigned' where restaurantid = '$resId' AND orderid = '$orderId'";
            $updateStatusStmt = $conn->prepare($updateStatus);
            $updateStatusStmt->execute();

            // Update the status of the kitchen staff who an order has been assigned to 
            for($j = 0; $j<sizeof($checkbox1); $j++){
                $employeeId = $checkbox1[$j];
                $updateEmployeeStatus = "UPDATE employee SET status = 'Busy' WHERE restaurantid = '$resId' AND employeeid = '$employeeId'";
                $updateEmployeeStatusStmt = $conn->prepare($updateEmployeeStatus);
                $updateEmployeeStatusStmt->execute();
            }
          


            header("location: vieworders.php");
        }

    }
        
        
    // Get Kitchen Staffs

}else{
    header("location: ../index.php");
}
?>
<?php include('kitchenheadheader.php')?>
<?php if($getKitchenStaffResult){?>
    <div class="container-fluid">
        <div class="card-body">
            <p>Choose Staff To Prepare Meal</p>
            <div class="row">
                <ul class="list-group">
                    <li>
                        <form action="" method = "post">
                            <?php foreach($getKitchenStaffResult as $kitchenStaff){?>
                            <input type="checkbox" name = chkl[] value="<?php echo $kitchenStaff['employeeid'];?>" aria-label="...">
                            <?php echo $kitchenStaff['name'];?>
                            <?php }?>
                            <input type = "submit" name = "assign" value = "Assign" class = "btn btn-primary btn-xs">
                        </form>
                    </li>
        
                </ul>
            </div>
        
        </div>
    </div>   
<?php }else{?>    
    <?php echo "No Staff Available";?>
<?php }?>       
 
