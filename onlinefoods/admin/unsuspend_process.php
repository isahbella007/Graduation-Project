<?php 
require('config.php');
if(isset($_SESSION['login'])){
    if(isset($_GET['unsuspendid'])){
        echo $resId = $_GET['unsuspendid'];
        // Update the status of the restaurant 
        $updateStatus  = "UPDATE restaurant SET FLAG = 'CONFIRMED' WHERE restaurantid = '$resId'";
        $updateStmt = $conn->prepare($updateStatus);
        $updateStmt->execute();

        // Update the status of the appeal 
        $updateAppeal = "UPDATE appeal SET status = 'RESOLVED' WHERE restaurantid = '$resId'";
        $updateAppealStmt = $conn->prepare($updateAppeal);
        $updateAppealStmt->execute();

        // Update the flag in the report table 
        $updateFlag = "UPDATE report SET res_flag = 'handled' WHERE restaurantid = '$resId'";
        $updateFlagStmt = $conn->prepare($updateFlag);
        $updateFlagStmt->execute();

        header("location: view_appeal.php");
    }
}
