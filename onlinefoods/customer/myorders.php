<?php 

   

 include ('dbh.inc.php');
 
 

include('header/restaurantheader.php');
if(($_SESSION['login'])){
  $customerid = $_SESSION['customerid'];
  
  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
 

  
}

?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<head>
    <link rel="stylesheet" href ="./css/cart.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="" width="35" height="30" class="id-inline-block assign-top">
        Online Foods
        </a>
        <span >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if($_SESSION['login']){?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
          <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="report_restaurant.php">Report restaurant</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Logout</a>
                    </li>
                </ul>
            <?php }?>
            <?php if(isset($_POST['foodmenu_userNotLoggedIn'])){?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
                    <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
                </ul>
            <?php }?>
            </div>  
        </div>
    </nav>

      <?php 
       $sql = "SELECT orderid, status, restaurantid, rate_status FROM orders  WHERE customerid = '$customerid' GROUP BY orderid ORDER BY id DESC ;";

$result = mysqli_query($conn,$sql);
 
$resultcheck = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)){
     $order_id = $row['orderid'];
    $resturantid = $row['restaurantid'];
    $sql3 = "SELECT  name FROM restaurant  WHERE restaurantid = '$resturantid'  ;";
$result3 = mysqli_query($conn,$sql3);
$resultcheck3 = mysqli_num_rows($result3);
$row3 = mysqli_fetch_assoc($result3);
 
 
  $sql1 = "SELECT * FROM orders  WHERE orderid = '$order_id' ;";

$result1 = mysqli_query($conn,$sql1);
 
$resultcheck1 = mysqli_num_rows($result1);
   echo $emements="<div class='col-lg-7'>";
     echo $emements=" <div class= 'border bg-light rounded p-4'>";
     echo $emements=" <table class='table'>";
  echo $emements=" <thead class='text-center'>";
while ($row1 = mysqli_fetch_assoc($result1)){
    echo $emements=" <tr>"; 
    echo $emements=" <td>"; 
    echo "Order Identifier:";
    echo " ";     
    echo $order_id;
    echo $emements=" <tr>"; 
    echo $emements=" <td>"; 
    echo "ITEM NAME:";
    echo " ";     
    echo $row1['itemname'];
    echo "ITEM PRICE:";
    echo " ";  
    echo $row1['price'];
    echo "TL";
    echo " ";
    echo "ITEM PAYMENTMETHOD:";
    echo " ";  
    echo $row1['paymentmethod'];
    echo "ITEM QUANTITY:";
    echo " ";  
    echo $row1['quantity'];
      "ITEM TIMEOFORDER:";
      " ";  
      $time = $row1['timeoforder'];
      
      $rid = $row1['restaurantid'];
      $emements=" <br>";
     
    echo $emements=" </td>";
    echo $emements=" </tr>";

       
 
  
  }
  echo $emements=" </tbody>";
  echo $emements=" </table>";
  echo "ITEM TIME OF ORDER:";
  echo " ";  
  echo $time;

  echo " STATUS:"; echo " "; echo " <p style='background-color:lightyellow; width:10%;'> $row[status]</p>";
  echo "<h4>"; echo $row3['name']; echo "</h4>";
   if($row['rate_status']==0){
   if($row['status']=="DELIVERED" ){
     
    echo $emements=" 
    <form action='rate_order.php' method='post'>
     

    <input type='hidden' name='item_id' value=' $order_id'>
    <input type='hidden' name='rest_id' value=' $rid'>
    <button   class='btn btn-primary btn-block  ' style='width:100px' name='Rate'>
          RATE
        </button>
        </form>

        ";

   }
   }
     if($row['status']!="DELIVERED" ){
    echo $emements=" 
    <form action='message.php' method='post'>
     

    <input type='hidden' name='item_id' value=' $order_id'>
    <input type='hidden' name='rest_id' value=' $rid'>
    <button   class='btn btn-primary btn-block'  style='width:100px' name='chat'>
          CHAT
        </button>
        </form>

        ";
        "<br><hr>";
      
      }
   elseif ($row['rate_status']==1){
    if($row['status']=="DELIVERED" ){
      echo " ";
      echo "<p style='background-color:lightblue; width:10%;'>RATED</p>";

    }

   }
 
 echo $emements=" </div>";
 echo "<br>
 <br>
 <br>";
 echo $emements="</div>";

}
 ?>