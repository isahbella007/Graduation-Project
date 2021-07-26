<?php
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
    $viewFoodcategory = "SELECT * FROM foodcategory WHERE restaurantid = '$resId' ";
    $viewFoodcategoryStat = $conn->prepare($viewFoodcategory);
    $viewFoodcategoryStat->execute();
    $viewFoodcategoryResult = $viewFoodcategoryStat->fetchAll();
}
?>

<?php include('managerheader.php');?>
<div class="container-fluid">
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Food Category(ies)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        
                        <th class="m-0 font-weight-bold text-primary">Food Category Name</th>
                        <th class="m-0 font-weight-bold text-primary">Date Created</th>
                        <th class="m-0 font-weight-bold text-primary">Action</th>
                
                    </tr>
                </thead>
                
                <tbody>
                <?php if($viewFoodcategoryResult){?>
                    <?php foreach($viewFoodcategoryResult as $result){?>
                    <tr>
                        
                        <td class="h6 mb-2 text-gray-800"> <?php echo $result['foodcategoryname']?></td>
                        <td class="h6 mb-2 text-gray-800"> <?php echo $result['datecreated']?></td>
                        <td class="h6 mb-2 text-gray-800">
                            <form method = "GET" action = "editfoodcategory.php">
                                <a href = "#" class=><input type = "submit" name = "edit" value = "Edit" class = "btn btn-warning btn-xs">
                                <input type = "hidden" name = "edit" value = "<?php echo $result['foodcategoryid']?>">
                            </form>
                        </td>
                        
                    </tr>
                 <?php } ?>
                    <?php } ?> 
                </tbody>
        </table>
</div>