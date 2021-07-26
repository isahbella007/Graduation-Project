<?php 
require('config.php');
if(isset($_SESSION['login'])){
    if(isset($_POST['view'])){
        $resId = $_POST['view'];
        $employeeCategories = "SELECT * FROM report WHERE restaurantid = '$resId'";
        $employeeCategoriesStmt = $conn->prepare($employeeCategories); 
        $employeeCategoriesStmt->execute(); 
        $employeeCategoriesResult = $employeeCategoriesStmt->fetchAll(PDO::FETCH_ASSOC); 
    }
   
}else{
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./pending.css">
</head>
<body>
<div class="container d-flex">
    <div class="col-md-4">
        <?php 
            include('layout/adminheader.php');
        ?>
    </div>
    <div class="col-md-8">
        
    <div class="row col-md-12 custyle">
    <table class="table table-striped custab">
    <thead>
        <tr>
            <th>report ID</th>
            <th>Customer Complain</th>
        </tr>
    </thead>
    <?php if($employeeCategoriesResult){?>
        <?php foreach($employeeCategoriesResult as $viewResult){?>
            <tr>
                <td><?php echo $viewResult['reportid'];?></td>
                <td><?php echo $viewResult['message'];?></td>
            </tr>
        <?php }?>
    <?php }?>
    </table>
    </div>
    </div>
</div>
</body>
</html>
