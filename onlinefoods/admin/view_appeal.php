<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $employeeCategories = "SELECT * FROM appeal WHERE status = 'NEW'";
    $employeeCategoriesStmt = $conn->prepare($employeeCategories); 
    $employeeCategoriesStmt->execute(); 
    $employeeCategoriesResult = $employeeCategoriesStmt->fetchAll(PDO::FETCH_ASSOC); 
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
            
            <th>Restaurant Name</th>
            <th>Message</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <?php if($employeeCategoriesResult){?>
        <?php foreach($employeeCategoriesResult as $viewResult){?>
            <tr>
                
                <td><?php echo $viewResult['res_name'];?></td>
                <td><?php echo $viewResult['message'];?></td>
                <td class="text-center">
                <form method = "get" action = "unsuspend_process.php">
                    <button type = "submit" name = "unsuspendid" class = "btn btn-success btn-xs" value = "<?php echo $viewResult['restaurantid'] ?>">Unsuspend</button>
                    
                </form>
                 </td>
            </tr>
        <?php }?>
    <?php }?>
    </table>
    </div>
    </div>
</div>
</body>
</html>
