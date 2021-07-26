<?php
require('config.php');
$viewPending = "SELECT * FROM restaurant WHERE FLAG = 'PENDING'";
$viewPendingStat = $conn->prepare($viewPending);
$viewPendingStat->execute();
$viewPendingResult = $viewPendingStat->fetchAll(PDO::FETCH_ASSOC);

$restaurantStatusUpdate = False;
if(isset($_POST['confirm'])){
    $confirm = $_POST['confirm'];
    $restaurantStatus = "UPDATE restaurant SET FLAG = 'CONFIRMED' WHERE name = '$confirm'";
    $restaurantStatusStat = $conn->prepare($restaurantStatus);
    $restaurantStatusStat->execute();
    $restaurantStatusUpdate = True;
    // if($restaurantStatusUpdate){
    //     echo '<script type="text/javascript">';
    //     echo ' alert("Restaurant Has Been Confirmed")';
    //     echo '</script>';
    // }

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
    <?php if($viewPendingResult){?>
        <?php foreach($viewPendingResult as $viewResult){?>
            <tr>
                <td>S/NO</td>
                <td><?php echo $viewResult['name'];?></td>
                <td class="text-center"> 
                <form method = "post">
                    <input type = "submit" class = 'btn btn-info btn-xs' class="glyphicon glyphicon-edit" name = "confirm" value = "Confirm"> 
                    <input type = "hidden" name = "confirm" value = "<?php echo $viewResult['name'] ?>">
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
