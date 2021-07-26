<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid']; 
    $employeeCategories = "SELECT * FROM employee WHERE restaurantid = '$resId' 
    AND status != 'FIRED' AND position != 'Kitchen Head' GROUP BY position";
    $employeeCategoriesStmt = $conn->prepare($employeeCategories); 
    $employeeCategoriesStmt->execute(); 
    $employeeCategoriesResult = $employeeCategoriesStmt->fetchAll(PDO::FETCH_ASSOC); 
}else{
    header("location: index.php");
}
?>


<?php include('managerheader.php');?>
<div class="container-fluid">
<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Employee Categories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                
                        <th class="m-0 font-weight-bold text-primary">Position</th>
                        <th class="m-0 font-weight-bold text-primary">Action</th>
                
                    </tr>
                </thead>
                
                <tbody>
                <?php if($employeeCategoriesResult){?>
                <?php foreach($employeeCategoriesResult as $employeeResult){?>

                    <tr>
                         
                        <td class="h6 mb-2 text-gray-800"><?php echo $employeeResult['position'];?></td>
                        <td class="h6 mb-2 text-gray-800">  
                            <form method = "post" action = "viewemployeehistory.php">
                                 <a href = "#" class=><input type = "submit" name = "edit" value = "View" class = "btn btn-success btn-xs">
                                 <input type = "hidden" name = "edit" value = "<?php echo $employeeResult['position'];?>">
                            </form>
                        </td>
                    </tr>
                <?php }?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
            
