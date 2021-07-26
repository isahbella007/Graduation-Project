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
    <a href="#" class="btn btn-primary btn-xs pull-right"> Put a Search bar here</a>
        <tr>
        <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Restaurant</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <?php if($viewConfirmedResult){?>
        <?php foreach($viewConfirmedResult as $viewResult){?>
            <tr>
                <td>S/NO</td>
                <td><?php echo $viewResult['name'];?></td>
                <td><?php echo $viewResult['datecreated'];?></td>
                <td class="text-center">
                <form method = "post">
                <input type = "submit" class = 'btn btn-success btn-xs' class="glyphicon glyphicon-edit" name = "unsuspend" value = "Unsuspend"> 
                <input type = "hidden" name = "unsuspend" value = "<?php echo $viewResult['name'];?>">
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

<!------ Include the above in your HEAD tag ---------->

