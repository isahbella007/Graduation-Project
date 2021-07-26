<?php
require('config.php');
include('header/restaurantheader.php');

// echo "The reason I keep getting an error when I click on back in the restaurantmenu page is because
// from line 12 to 20 is inside the _POST['apply']";
if($_SESSION['login']){
    if(isset($_POST['apply'])){
         $_SESSION['useraddress']= $_POST['post'];
         $userAddressId = $_SESSION['useraddress'];
        // Get what region this Address i is
        $getRegion = "SELECT * FROM address WHERE addressid = '$userAddressId'";
        $getRegionStmt = $conn->prepare($getRegion);
        $getRegionStmt->execute();
        $getRegionResult = $getRegionStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($getRegionResult as $regionResult){
            $region = $regionResult['region'];
        }
        // Get Restaurant that match with the user address id
        $getRestaurant = "SELECT * FROM restaurant WHERE region = '$region' AND FLAG = 'CONFIRMED'";
        $getRestaurantStmt = $conn->prepare($getRestaurant);
        $getRestaurantStmt->execute();
        $getRestaurantResult = $getRestaurantStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<body>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
     Restaurant List
    </a>
    <span >
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
          <li class="nav-item">
          <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
            </li>
          
           <li class="nav-item">
          <a class="nav-link active" href="logout.php">Logout</a>
            </li>
       </ul>
       </div>  
    </div>
 </nav>
 <br>
<div class="container">
	<div class="row">
		<h2>Restaurant List</h2>
        <div class="col-lg-12">
            <input type="search" class="form-control" id="input-search" placeholder="Search Restaurants..." >
        </div>
        <br> <br>
        <?php foreach($getRestaurantResult as $restaurantRes){?>
        <div class="searchable-container">
            <div class="items col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">
               <div class="info-block block-info clearfix" >
                    <div class="square-box pull-left">
                        <span class="glyphicon glyphicon-user glyphicon-lg"></span>
                    </div>

                    <form action="restaurantmenu.php" method = "get" >

                    <table>
            
                       <tr>
                           <td><button><?php echo $restaurantRes['name']?></button></td>
                           <br>
                       </tr>
                   </table>
                    <input type="hidden" value = "<?php echo $restaurantRes['name']?>" name = "restaurantSelected">
                    

                    </form>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
       

</body>
<script>
    $(function() {    
        $('#input-search').on('keyup', function() {
          var rex = new RegExp($(this).val(), 'i');
            $('.searchable-container .items').hide();
            $('.searchable-container .items').filter(function() {
                return rex.test($(this).text());
            }).show();
        });
    });
</script>