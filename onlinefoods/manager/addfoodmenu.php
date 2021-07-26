<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
	$getFoodCategory = "SELECT * FROM foodcategory WHERE restaurantid = '$resId' ";
	$getFoodCategoryStat = $conn->prepare($getFoodCategory);
	$getFoodCategoryStat->execute();
    $getFoodCategoryResult = $getFoodCategoryStat->fetchAll();
    
    if(isset($_POST['addfoodmenu'])){

		$foodCategory = $_POST['fc'];
		$foodCategoryId = $_POST['fcid'];
		$itemName = $_POST['itemname'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$image = $_POST['image']; 
        $dt1=date("Y-m-d");

        // Check if the manager selected the correct id.
        $check = "SELECT * FROM foodcategory WHERE foodcategoryname = '$foodCategory' AND restaurantid = '$resId'";
        $checkStmt = $conn->prepare($check);
        $checkStmt->execute();
        $checkresult = $checkStmt->fetch();

        $correctFoodCategoryId = $checkresult['foodcategoryid'];
        if($foodCategoryId == $correctFoodCategoryId){
            $insert = "INSERT INTO foodmenu(restaurantid,foodcategoryid, itemname, price, description, image, foodcategory,datecreated) VALUES (:restaurantid, :foodcategoryid, :itemname, :price, :description, :image, :foodcategory, :dc)";
            $insertStat = $conn->prepare($insert);
            $insertStat->execute(array(
                ':restaurantid' => $resId, 
                ':foodcategoryid' => $foodCategoryId, 
                ':itemname' => $itemName, 
                ':price' => $price, 
                ':description' => $description, 
                ':image' => $image, 
                ':foodcategory' => $foodCategory,
                ':dc' => $dt1
            ));
                echo '<script type="text/javascript">';
                echo ' alert("Food Menu Is Added")'; 
                echo '</script>';
                header("location: managefoodmenu.php");
        }else{
            echo "<script type='text/javascript'>alert('Food Category Id Does Not Match Selected Food Category Id. Not Added.');
            window.location='addfoodmenu.php';
            </script>";
        }
	}

}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php');?>
<div class="container-fluid">
<form method = "post">
       <label for="exampleInputPassword1">Food category</label>
    <select class="form-control" name = "fc" type = "text" required>

        <?php if($getFoodCategoryResult){?>
            <option>
            <?php foreach($getFoodCategoryResult as $result){?>
                <option ><?php echo $result['foodcategoryname']; ?></option> 

            <?php } ?> 

        <?php }?>
        </option>
    </select>

       <label for="exampleInputPassword1">Food category ID</label>
    <select class="form-control" name = "fcid" type = "text" required>

        <?php if($getFoodCategoryResult){?>
            <option>
            <?php foreach($getFoodCategoryResult as $result){?>
                <option ><?php echo $result['foodcategoryid'];?></option> 

            <?php } ?> 

        <?php }?>
        </option>
    </select>

    <div class="form-group">
    	<label for="exampleInputPassword1">ItemName</label>
    	<input type="text" name = "itemname" class="form-control" id="exampleInputPassword1" required>
  </div>

   <div class="form-group">
    	<label for="exampleInputPassword1">Price</label>
    	<input type="text" name = "price" class="form-control" id="exampleInputPassword1" required>
  </div>

   <div class="form-group">
    	<label for="exampleInputPassword1">Description</label>
    	<input type="text" name = "description" class="form-control" id="exampleInputPassword1" >
  </div>

   <div class="form-group">
    	<label for="exampleInputPassword1">Image</label>
    	<input type="file" name = "image"  id="exampleInputPassword1">
  </div>

  <button type="submit" class="btn btn-primary" name="addfoodmenu" >Submit</button>

    </form>
</div>