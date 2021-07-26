<?php 
require('config.php');
if(isset($_SESSION['login'])){
    // Get all vacancy post by restaurants and sort by active post first.
    $restaurantId = $_SESSION['restaurantid'];
    // assign a variable its purpose is to check if the restaurant has posted a vacany in the vacany table 
    $restuarantInVacancyTable = 0;
    // Restaurant in vacancy table should be equals to 0. after getting all restaurants in the vacancy table,
    // Assign restuarant in vacancy table to the ID of it's restaurant. Id of every restaurant is greater than 0.
    $viewVacancy = "SELECT * FROM vacancy WHERE restaurantid = '$restaurantId'";
    $viewVacancyStmt = $conn->prepare($viewVacancy);
    $viewVacancyStmt->execute();
    $viewVacancyResult = $viewVacancyStmt->fetchAll();
    foreach($viewVacancyResult as $need){
        $availabliltyAmount = $need['availability'];
        $restuarantInVacancyTable = $need['restaurantid'];
        // echo $availabliltyAmount;
    }
    // if availabilityAmount is == 0, update the status of the vacancy 
    if($restuarantInVacancyTable > 0){
        if($availabliltyAmount == 0){
            $vacancyUpdate = "UPDATE vacancy availability SET flag = 'CLOSED' WHERE restaurantid = '$restaurantId'";
            $vacancyUpdateStmt = $conn->prepare($vacancyUpdate);
            $vacancyUpdateStmt->execute();
        }
    }
    
    

}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php');?>
<style>
     @import url('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
 
    .isa_success {
    color: #4F8A10;
    }

    .isa_error {
    color: #D8000C;
    }
</style>
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Posted Vacancies</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="m-1 font-weight-bold text-primary">S/NO</th>
                        <th class="m-0 font-weight-bold text-primary">Position</th>
                        <th class="m-0 font-weight-bold text-primary">Staff Needed</th>
                        <th class="m-0 font-weight-bold text-primary">Warning</th>
                        <th class="m-0 font-weight-bold text-primary">Staus</th>
                        <th class="m-0 font-weight-bold text-primary">Action</th>
                
                    </tr>
                </thead>
                
                <tbody>
                    <?php if($viewVacancyResult){?>
                        <?php foreach($viewVacancyResult as $viewResult){?>
                            <tr>
                                 <td class="h6 mb-2 text-gray-800">#</td>
                                 <td class="h6 mb-2 text-gray-800"><?php echo $viewResult['position'];?></td>
                                 <td class="h6 mb-2 text-gray-800"><?php echo $viewResult['availability'];?></td>
                                 <td class="h6 mb-2 text-gray-800"><?php if($viewResult['availability'] <= 0){?>
                                 <p class="isa_error"> 
                                    <i class="fa fa-info-circle"></i>
                                    Please, Delete or Update!
                                </p>
                                 <?php }else{?>
                                    <p class="isa_success"> 
                                    <i class="fa fa-check"></i>
                                    This is fine
                                </p>
                                 <?php }?>
                                 </td>
                                 <td class="h6 mb-2 text-gray-800"><?php if($viewResult['availability'] == 0){?>
                                    <?php echo "CLOSED"?>
                                <?php }else{?>
                                    <?php echo $viewResult['flag'];?></td>
                                <?php }?>
                                 
                                 <td class="h6 mb-2 text-gray-800">
                                    <form method = "GET" action ="editvacancy.php">
                                    <a href = "#" class=><input type = "submit" name = "edit" value = "Edit" class = "btn btn-warning btn-xs">
                                    <input type = "hidden" name = "edit" value = "<?php echo $viewResult['vacancyid'];?>">
                                    </form>

                                </td>
                            </tr>
                        <?php }?>
                    <?php }?>
                </tbody>
            </table> 
        </div>   
    </div>
</div>
