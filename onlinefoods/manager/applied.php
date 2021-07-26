<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $restaurantId = $_SESSION['restaurantid'];
    $viewParticipant = "SELECT * FROM apply WHERE restaurantid = '$restaurantId'";
    $viewParticipantStmt = $conn->prepare($viewParticipant);
    $viewParticipantStmt->execute(); 
    $viewParticipantResult = $viewParticipantStmt->fetchAll();
        
}else{
    header("location: index.php");
}
?>

<?php include('managerheader.php');?>
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Applicants</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="m-1 font-weight-bold text-primary">S/NO</th>
                        <th class="m-0 font-weight-bold text-primary">Name</th>
                        <th class="m-0 font-weight-bold text-primary">Position Applied For</th>
                        <th class="m-0 font-weight-bold text-primary">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($viewParticipantResult as $viewResult){?>
                        <tr>
                            <td class="h6 mb-2 text-gray-800">#</td>
                            <td class="h6 mb-2 text-gray-800"><?php echo $viewResult['name'];?> - <?php echo $viewResult['surname'];?>  </td>
                            <td class="h6 mb-2 text-gray-800"> <?php echo $viewResult['position'];?></td>
                            <td>
                            <form method = "post" action = "viewapplied.php">
                            <a href = "#" class=><input type = "submit" name = "edit" value = "View" class = "btn btn-primary btn-xs">
                            <input type = "hidden" name = "edit" value = "<?php echo $viewResult['applyid'];?>">
                            </form>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</div>