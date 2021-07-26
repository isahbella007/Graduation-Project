<?php
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
    // Get the id of the foodmenu the manager wants to update 
    if(isset($_GET['edit'])){
        echo $menu = $_GET['edit'];
        $getMenu = "SELECT * FROM foodmenu WHERE foodmenuid = '$menu' AND restaurantid = '$resId'";
        $getMenuStmt =$conn->prepare($getMenu);
        $getMenuStmt->execute();
        $getMenuResult = $getMenuStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($getMenuResult as $oldMenu){
            $oldItemName = $oldMenu['itemname'];
            $oldPrice = $oldMenu['price'];
            $oldDecription = $oldMenu['description'];
            $oldImage = $oldMenu['image'];
        }

        $getFoodCategory = "SELECT * FROM foodcategory WHERE restaurantid = '$resId' ";
        $getFoodCategoryStat = $conn->prepare($getFoodCategory);
        $getFoodCategoryStat->execute();
        $getFoodCategoryResult = $getFoodCategoryStat->fetchAll();

        $updateSuccess = false;
        // Note that the manager might want to change the catgory of the foodmenu so update the category id as well
        if(isset($_POST['update'])){
            echo "Update clicked";
            $foodCategory = $_POST['fc'];
            $foodCategoryId = $_POST['fcid'];
            $itemName = $_POST['itemname'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image = $_POST['image']; 
            // Check if the manager selected the correct id.
            $check = "SELECT * FROM foodcategory WHERE foodcategoryname = '$foodCategory' AND restaurantid = '$resId'";
            $checkStmt = $conn->prepare($check);
            $checkStmt->execute();
            $checkresult = $checkStmt->fetch();
            
            $correctFoodCategoryId = $checkresult['foodcategoryid'];
        
            echo $correctFoodCategoryId;
            if($foodCategoryId == $correctFoodCategoryId){
                $sql = "UPDATE foodmenu SET foodcategory = '$foodCategory', foodcategoryid = '$foodCategoryId',
                itemname = '$itemName', price = '$price', description = '$description', image = '$image'
                WHERE foodmenuid = '$menu'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $updateSuccess = true;
                if($updateSuccess){
                    echo "<script type='text/javascript'>alert('Updated.');
                    window.location='managefoodmenu.php';
                    </script>";
                }
            }
            else{
                echo "<script type='text/javascript'>alert('Food Category Id Does Not Match Selected Food Category Id. Not Updated.');
                    window.location='managefoodmenu.php';
                    </script>";
            }
        }
        // If the manager clicks on the delete button, Just delete the food under that 
        if(isset($_POST['delete'])){
            $sql = "DELETE FROM foodmenu WHERE foodmenuid = '$menu'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            echo "<script type='text/javascript'>alert('Deleted.');
            window.location='managefoodmenu.php';
            </script>";
        }
    }
    
   


}else{
    header("location: index.php");
}

?>

<?php include('managerheader.php');?>
<div class="container-fluid">
<form method = "POST">
       <label for="exampleInputPassword1">Food category (SELECT NEW CATEGORY)</label>
    <select class="form-control" name = "fc" type = "text" required>

        <?php if($getFoodCategoryResult){?>
            <option>
            <?php foreach($getFoodCategoryResult as $result){?>
                <option ><?php echo $result['foodcategoryname']; ?></option> 

            <?php } ?> 

        <?php }?>
        </option>
    </select>

       <label for="exampleInputPassword1">Food category ID (SELECT CORRESPONDING ID)</label>
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
    	<input type="text" name = "itemname" class="form-control" id="exampleInputPassword1" value = "<?php echo $oldItemName;?>" required>
  </div>

   <div class="form-group">
    	<label for="exampleInputPassword1">Price</label>
    	<input type="text" name = "price" class="form-control" id="exampleInputPassword1" value = "<?php echo $oldPrice;?>" required>
  </div>

   <div class="form-group">
    	<label for="exampleInputPassword1">Description</label>
    	<input type="text" name = "description" class="form-control" id="exampleInputPassword1" value = "<?php echo $oldDecription;?>" >
  </div>

   <div class="form-group">
    	<label for="exampleInputPassword1">Image</label>
    	<input type="file" name = "image"  id="exampleInputPassword1" value = "<?php echo $oldImage;?>">
  </div>

  <button type="submit" class="btn btn-primary" name="update" >Update</button>
  <button type="submit" class="btn btn-danger" name="delete" >Delete</button>
    </form>
</div>
</div>