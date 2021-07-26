<?php
require('config.php');
include('header/restaurantheader.php');
if(isset($_GET['searchrestaurant'])){
    $categorySelected =  $_GET['searchrestaurant'];
    $getRestaurant = "SELECT * FROM restaurant Where FLAG = 'CONFIRMED' AND category = '$categorySelected'";
    $getRestaurantStmt = $conn->prepare($getRestaurant);
    $getRestaurantStmt->execute();
    $getRestaurantResult = $getRestaurantStmt->fetchAll(PDO::FETCH_ASSOC);
}
// Get Restaurant Name by region



?>

<body>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
     Restaurants
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
          
       </ul>
       </div>  
    </div>
 </nav>
 <br>
<div class="container">
	<div class="row">
		
        <div class="col-lg-12">
            <input type="search" class="form-control" id="input-search" placeholder="Search Restaurant By Name..." >
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
                    <input type="hidden" value = "<?php echo $restaurantRes['name']?>" name = "restaurantmenu">
                    

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