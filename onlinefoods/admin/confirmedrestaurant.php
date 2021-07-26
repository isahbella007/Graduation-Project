<?php
require('config.php');

// Get all confirmed resturants
$viewConfirmed = "SELECT * FROM restaurant WHERE FLAG = 'CONFIRMED'";
$viewConfirmedStat = $conn->prepare($viewConfirmed);
$viewConfirmedStat->execute();
$viewConfirmedResult = $viewConfirmedStat->fetchAll(PDO::FETCH_ASSOC);

$suspendRestaurant = FALSE;
if(isset($_POST['suspend'])){
    $suspend = $_POST['suspend'];
    $suspendQuery = "UPDATE restaurant SET FLAG = 'SUSPENDED' WHERE name = '$suspend'";
    $suspendQueryStat = $conn->prepare($suspendQuery);
    $suspendQueryStat->execute();
    $suspendRestaurant = TRUE;
    if($suspendRestaurant){
        echo '<script type="text/javascript">';
        echo ' alert("Restaurant Has Been Suspended")';
        echo '</script>';
        header("location: suspendedrestaurant.php");
    }
    
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
        <th>S/NO</th>
            <th>Restaurant Name</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <?php if($viewConfirmedResult){?>
        <?php foreach($viewConfirmedResult as $viewResult){?>
            <tr>
                <td>S/NO</td>
                <td><?php echo $viewResult['name'];?></td>
                <td class="text-center"> 
                    <form method = "post">
                        <input type = "submit" class = 'btn btn-warning btn-xs' class="glyphicon glyphicon-edit" name = "suspend" value = "Suspend"> 
                        <input type = "hidden" name = "suspend" value = "<?php echo $viewResult['name'] ?>">
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
