<?php
require('config.php');

// Get all confirmed resturants
$viewConfirmed = "SELECT * FROM restaurant ";
$viewConfirmedStat = $conn->prepare($viewConfirmed);
$viewConfirmedStat->execute();
$viewConfirmedResult = $viewConfirmedStat->fetchAll(PDO::FETCH_ASSOC);


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
            <th>Restaurant ID</th>
            <th>Restaurant Name</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <?php if($viewConfirmedResult){?>
        <?php foreach($viewConfirmedResult as $viewResult){?>
            <tr>
                <td><?php echo $viewResult['restaurantid'];?></td>
                <td><?php echo $viewResult['name'];?></td>
                <td class="text-center"> 
                    <form method = "post" action = "all_complains.php">
                        <input type = "submit" class = 'btn btn-primary btn-xs' class="glyphicon glyphicon-edit" name = "view" value = "View Complains"> 
                        <input type = "hidden" name = "view" value = "<?php echo $viewResult['restaurantid'] ?>">
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
