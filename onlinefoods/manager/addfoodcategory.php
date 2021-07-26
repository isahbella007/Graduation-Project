<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $foodCatgeoryAdded = FALSE;
    if(isset($_POST['add'])){
        $foodcategory = $_POST['foodcategory'];
        $dt1=date("Y-m-d");

        $addFoodCategory = "INSERT INTO foodcategory(restaurantid, foodcategoryname, datecreated) VALUES (:id, :name, :datecreated ) ";
        $addFoodCategoryStat = $conn->prepare($addFoodCategory);
        $addFoodCategoryStat->execute(array(
            ':id' => $_SESSION['restaurantid'],
            ':name' => $foodcategory, 
            ':datecreated' => $dt1, 
        ));
        $foodCatgeoryAdded = TRUE;
        if($foodCatgeoryAdded){
            echo '<script type="text/javascript">';
            echo ' alert("Food Category Is Added")'; 
            echo '</script>';
        }
    }
}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php');?>
<div class="container-fluid">
<form method = "post"> 
  <div class="mb-3">
      <h2>Add Food Category</h2>
    <label for="exampleInputEmail1" class="form-label">Category Name:</label>
    <input type="text" class="form-control" name = "foodcategory">
  </div>
  
  <button type="submit" class="btn btn-primary" name="add" >Submit</button>
</form>
</div>