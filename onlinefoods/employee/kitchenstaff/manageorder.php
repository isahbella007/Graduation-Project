<?php 
require('config.php');
include('layout/kitchenstaffheader.php');
if(isset($_SESSION['login'])){
    if(isset($_GET['edit'])){
        $orderid = $_GET['edit'];
        date_default_timezone_set('Europe/Istanbul');
        $date = date('Y-m-d');
        // Update status of order to Prepared
        $updateMeal = "UPDATE orders SET status = 'PREPARED' WHERE orderid = '$orderid' and orderdate = '$date'";
        $updateMealStmt = $conn->prepare($updateMeal);
        $updateMealStmt->execute();

        // Update assigned employee status to Available
        $sql1 = "SELECT * FROM employeehistory WHERE orderid = '$orderid'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        foreach($result1 as $res1){
           echo $assignedEmployee = $res1['employeeid'];
           $updateSql = "UPDATE employee SET status = 'Available' WHERE employeeid = '$assignedEmployee'";
           $updateSqlStmt = $conn->prepare($updateSql);
           $updateSqlStmt->execute();
        }
        // Redirect user 
        header("location: updateorder.php");
    }
}
?>