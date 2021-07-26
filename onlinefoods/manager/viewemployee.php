<?php 
require('config.php');
if(isset($_SESSION['login'])){
    if(isset($_POST['edit'])){
        $resid = $_SESSION['restaurantid'];
        //  Echo Position of employee click.
      $employeePosition = $_POST['edit'];
      $employee = "SELECT * from employee WHERE position = '$employeePosition' AND restaurantid = '$resid'";
      $employeeStmt = $conn->prepare($employee); 
      $employeeStmt->execute(); 
      $employeeResult = $employeeStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_GET['profile'])){
        header("location: employeeprofile.php");
    }

}else{
    header("location: index.php");
}
?>

<?php include('managerheader.php');?>
<div class="container-fluid">
<?php if(isset($_POST['edit'])){?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> <?php echo $_POST['edit']; ?> Employees</h6>
    </div>
<?php }?>
<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="m-1 font-weight-bold text-primary">S/NO</th>
                        <th class="m-1 font-weight-bold text-primary">Name</th>
                        <th class="m-1 font-weight-bold text-primary">Contact</th>
                        <th class="m-0 font-weight-bold text-primary">Action</th>
                
                    </tr>
                </thead>

                <tbody>
                 <?php foreach($employeeResult as $result){?>
                    <tr>
                        <td class="h6 mb-2 text-gray-800"> # </td>
                        <td class="h6 mb-2 text-gray-800"> <?php echo $result['name'];?> - <?php echo $result['surname']; ?></td>
                        <td class="h6 mb-2 text-gray-800"> <?php echo $result['contact'];?> </td>
                        <td class="h6 mb-2 text-gray-800"> 
                            <form method = "get" action = "">
                            <button type = "submit" name = "profile" class = "btn btn-primary btn-xs" value = "<?php echo $result['employeeid'] ?>">View Profile</button>
                            <button type = "submit" name = "history" class = "btn btn-success btn-xs" value = "<?php echo $result['employeeid'] ?>">View History</button>
                            </form>
                        </td>
                    </tr>
                 <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>