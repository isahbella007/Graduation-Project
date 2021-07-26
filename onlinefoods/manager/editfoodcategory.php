<?php 
require('config.php');
if(isset($_SESSION['login'])){
	$resId = $_SESSION['restaurantid'];
    if(isset($_GET['edit'])){
		$foodCategoryId = $_GET['edit'];

		$viewFoodCategory = "SELECT * FROM foodcategory WHERE foodcategoryid = '$foodCategoryId'";
		$viewFoodCategoryStat = $conn->prepare($viewFoodCategory);
		$viewFoodCategoryStat->execute();
		$viewFoodCategoryResult = $viewFoodCategoryStat->fetchAll(PDO::FETCH_ASSOC);
		foreach($viewFoodCategoryResult as $viewResult){
			$categoryName = $viewResult['foodcategoryname'];
		}
		
		
		$updateFoodCategory = FALSE;
		if(isset($_POST['update'])){
			// NB the first update statement is to update foodmenu category. Now write an sql for a statment where there is no menu under that categiry 
			$newFoodCategory = $_POST['fc'];
			$foodCategoryUpdate = "UPDATE foodcategory, foodmenu SET foodcategory.foodcategoryname = '$newFoodCategory', 
			foodmenu.foodcategory = '$newFoodCategory' WHERE foodcategory.foodcategoryid  = '$foodCategoryId' 
			AND foodmenu.foodcategoryid  = '$foodCategoryId' AND foodcategory.restaurantid = '$resId'";
			$foodCategoryUpdateStat = $conn->prepare($foodCategoryUpdate);
			$foodCategoryUpdateStat->execute();
	
			// 
			$updateCategoryName = "UPDATE foodcategory SET foodcategoryname = '$newFoodCategory' where foodcategoryid  = '$foodCategoryId'";
			$updateCategoryNameStmt = $conn->prepare($updateCategoryName);
			$updateCategoryNameStmt->execute();
			
			$updateFoodCategory = TRUE;
			if($updateFoodCategory){
				echo '<script type="text/javascript">';
				echo ' alert("Sucessfully Updated")'; 
				echo '</script>';		
			}else{
				echo '<script type="text/javascript">';
				echo ' alert("Try Again! Something went wrong")'; 
				echo '</script>';
			}
			
			header("location: managefoodcategory.php");
		
		}

		$deleteFood = False;

		// Delete food category
		if(isset($_POST['delete'])){
			$deleteFoodCategory = $_POST['fc'];
	
			$foodCategoryDelete = "DELETE FROM foodcategory  WHERE foodcategory.foodcategoryid  = '$foodCategoryId' 
			AND restaurantid = '$resId'";
			
			$foodCategoryDeleteStat = $conn->prepare($foodCategoryDelete);
			$foodCategoryDeleteStat->execute();
			$deleteFood = True;
			if($deleteFood){
				echo '<script type="text/javascript">';
				echo ' alert("Sucessfully Deleted")'; 
				echo '</script>';
				header("location: managefoodcategory.php");
			}
		}
	


    }
    
	
	// Updates food category name
	
	
}
else{
    header("location: index.php");
}
?>
<?php include('managerheader.php');?>
<div class="container-fluid">
<form class="form-horizontal" role="form" method = "post" >
    <fieldset>
      <legend>Food category/edit</legend>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="card-holder-name">Food Category</label>
        <div class="col-sm-9">
        <?php if(isset($_GET['edit'])){?>
          <input type="text" class="form-control" name="fc" id="card-holder-name" value = "<?php echo $categoryName;?>">
		<?php }?>
        </div>
      </div>
    
       
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" class="btn btn-success" name = "update" >Update</button>
        </div>
      </div>   

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" class="btn btn-danger" name = "delete">Delete</button>
        </div>
      </div>

    </fieldset>
  </form>
</div>
