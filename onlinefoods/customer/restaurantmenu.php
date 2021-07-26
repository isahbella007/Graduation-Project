<?php 
require('config.php');
include('header/restaurantheader.php');
if(isset($_GET['restaurantSelected'])){
    if(($_SESSION['login'])){
        $customerid = $_SESSION['customerid'];
        $_SESSION['customerid'] = $customerid;
          $userAddressId = $_SESSION['useraddress'];
        if(isset($_GET['restaurantSelected'])){
            // echo "Logged in";
            // Get the Id of the restaurant that was selected. STore it in res_id
            $restaurantName = $_GET['restaurantSelected'];
            $queryGetRestaurantId = "SELECT restaurantid FROM restaurant WHERE name = '$restaurantName' ";
            $stmt = $conn->prepare($queryGetRestaurantId);
            $stmt->execute();
            $resultId = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultId as $there){
                 $res_id = $there['restaurantid'];
            }
            $_SESSION['restaurantIdSelectedByLoggedInUser'] =  $res_id;
            
            // Get the Category of the restaurant that was selected using the res_id.
            $getMenu = "SELECT * FROM foodcategory WHERE restaurantid = '$res_id' Group By foodcategoryname";
            $stmt = $conn->prepare($getMenu);
            $stmt->execute();
            $resultCategory = $stmt->fetchAll(PDO::FETCH_ASSOC);

            
        }
    }

}
if(isset($_GET['restaurantmenu'])){
    // Get the id of the restuarant that was selected. Store in res_id
    $restaurantName = $_GET['restaurantmenu'];
    $queryGetRestaurantId = "SELECT restaurantid FROM restaurant WHERE name = '$restaurantName' ";
    $stmt = $conn->prepare($queryGetRestaurantId);
    $stmt->execute();
    $resultId = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultId as $there){
         $res_id = $there['restaurantid'];
    }
     $_SESSION['restaurantIdSelectedByGuestUser'] = $res_id;

    // Get the Category of the restaurant that was selected using the res_id.
    $getMenu = "SELECT * FROM foodcategory WHERE restaurantid = '$res_id' Group By foodcategoryname";
    $stmt = $conn->prepare($getMenu);
    $stmt->execute();
    $categoryResult  = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<style>
img{
     width:  300px;
    height: 300px;
    object-fit: cover;
}
.center-box
{
  margin: 0 auto;
  max-width: 400px;
  height: 170px;
  border-radius: 3px;
}
.center-box p
{
  position: relative;
  top: 50%;
  transform: perspective(1px) translateY(-50%);
  padding: 30px;    
  text-align:center;
}
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
      
        <?php if(isset($_GET['restaurantSelected'])){?>
            <?php echo $_GET['restaurantSelected']?>
        <?php }?>

        <?php if(isset($_GET['restaurantmenu'])){?>
            <?php echo $_GET['restaurantmenu']?>
        <?php }?>
        
        </a>
        <span >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if(isset($_GET['restaurantSelected'])){?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
                    <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="myorders.php">Orders</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link active" href="reviewpage.php">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="report_restaurant.php">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Logout</a>
                    </li>
                </ul>
            <?php }?>
            <?php if(isset($_GET['restaurantmenu'])){?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
                    <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="reviewpage.php">Review</a>
                    </li>
                </ul>
            <?php }?>
            </div>  
        </div>
    </nav>
     <!-- <a   href="reviewpage.php ">
         REVIEW </a>
          <a   href="message.php ">
         MESSAGE </a> -->

    <!-- If a logged in user is accessing this page. Display Certain things. -->
    <?php if(isset($_GET['restaurantSelected'])){?>
        <br>
       <div class="container-fluid">
            <div class="row mt-5">
                <?php foreach($resultCategory as $showCategory){?>
                    <p><?php echo $showCategory['foodcategoryname'];?></p>
                    
                    <?php $fc = $showCategory['foodcategoryname'];?>
                    <?php 
                        $getMenu = "SELECT * FROM foodmenu WHERE restaurantid = '$res_id' AND foodcategory = '$fc' ";
                        $stmt = $conn->prepare($getMenu);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach($result as $found){?>
                    <div class="col-lg-3">
                        <form action="managecart.php" method = "post">
                                <div class="card">
                                <?php if($found['image']){?>
                                    <img src="..\foodpictures\<?php echo $found['image'];?>" width = "100" height="30%" alt="" class = "card-img-top">
                                <?php }else{?>
                                    <img src="..\foodpictures\default.jpg" width = "100%" height="30%" alt="" class = "card-img-top">
                                <?php }?>
                                    <div class="card-body text-center">
                                        <h5 class ="card-title"><?php echo $found['itemname'];?></h5>
                                        <p class ="card-text">Price: <?php echo $found['price'];?>TL</p>
                                        <input type="number" name = "quantity"  class="form-control text-center iquantity"  value="1" max = "10" min = "1">
                                        <br>
                                        <button type ="submit" class ="btn btn-info" name ="add_to_cart">Order</button>
                                        <input type="hidden" name = "itemName" value = "<?php echo $found['itemname'];?>">
                                        <input type="hidden" name = "price" value = "<?php echo $found['price'];?>">
                                        <input type="hidden" name = "image" value = "<?php echo $found['image'];?>">
                                    </div>
                                </div>
                        </form>
                    </div>
                <?php }?>
                <?php }?>
               
            </div>
       </div>
    <?php }?>

    <?php if(isset($_GET['restaurantmenu'])){?>
        <br>
       <div class="container-fluid">
            <div class="row mt-5">
                <?php foreach($categoryResult as $showCategory){?>
                    <p><?php echo $showCategory['foodcategoryname'];?></p>
                    
                    <?php $fc = $showCategory['foodcategoryname'];?>
                    <?php 
                        $getMenu = "SELECT * FROM foodmenu WHERE restaurantid = '$res_id' AND foodcategory = '$fc' ";
                        $stmt = $conn->prepare($getMenu);
                        $stmt->execute();
                        $resultForUserNotLoggedIn = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach($resultForUserNotLoggedIn as $found){?>
                    <div class="col-lg-3">
                        <form action="managecart.php" method = "post">
                                <div class="card">
                                    <img src="..\foodpictures\<?php echo $found['image'];?>" width = "200%" height="50%" alt="" class = "card-img-top">
                                    <div class="card-body text-center">
                                        <h5 class ="card-title"><?php echo $found['itemname'];?></h5>
                                        <p class ="card-text">Price: <?php echo $found['price'];?>TL</p>
                                        <input type="number" name = "quantity"  class="form-control text-center iquantity"  value="1" max = "10" min = "1">
                                        <br>
                                        <button type ="submit" class ="btn btn-info" name ="add_to_cart">Order</button>
                                        <input type="hidden" name = "itemName" value = "<?php echo $found['itemname'];?>">
                                        <input type="hidden" name = "price" value = "<?php echo $found['price'];?>">
                                        <input type="hidden" name = "image" value = "<?php echo $found['image'];?>">
                                    </div>
                                </div>
                        </form>
                    </div>
                <?php }?>
                <?php }?>
               
            </div>
       </div>
    <?php }?>
