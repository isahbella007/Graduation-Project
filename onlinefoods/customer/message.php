<?php 

   

 include ('dbh.inc.php');
 
 

include('header/restaurantheader.php');
if(($_SESSION['login'])){
       $customerid = $_SESSION['customerid'];
   $_SESSION['customerid'] =$customerid;
 

  // This is the meal that the Logged in user slected.
 
  
  // This is the id of the restaurant that the Logged in user selected.
  
 

  
}else{  header("location: customerloginpage.php");}
if(isset($_POST['chat'])){
   $orderid =  $_POST['item_id'];
   $restid=$_POST['rest_id'];
 $orderidd=trim($orderid);
  $_SESSION['restaurantIdSelectedByLoggedInUser'] =$restid;
 echo $restid = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
}
 if(isset($_GET["orderid"])){
   echo $orderid=$_GET["orderid"];
    echo $restid = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
  $_SESSION['restaurantIdSelectedByLoggedInUser'] =$restid;
 $orderidd=trim($orderid);
}

if(isset($_POST['foodmenu_userNotLoggedIn'])){
  // This is the meal that the Guest user selected.
    $_POST['foodmenu_userNotLoggedIn'];
  echo "Not logged in";
  // This is the restaurant that the Guest user selected. 
  echo $_SESSION['restaurantIdSelectedByGuestUser'];
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
                        <a class="nav-link active" href="myorders.php">Orders</a>
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

<center> 
  <div class="col-md-4">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           
<div class="modal-body" id="msgbody" style="height: 400px;  overflow-y:scroll; overflow-x: hidden; ">
<?php
$orderidd=trim($orderid);

$sql1 = "SELECT * FROM messages  WHERE (FromUser = '$customerid' AND ToUser ='$restid' AND trim(orderid)='$orderidd'  ) OR (FromUser = '$restid' AND ToUser ='$customerid'  AND trim(orderid)='$orderidd' )  ;";
  $result1 = mysqli_query($conn,$sql1);
  $resultcheck1 = mysqli_num_rows($result1);
  while ($row1 = mysqli_fetch_assoc($result1)){
    if($row1['FromUser']== $customerid){
      echo"
        <div style='text-align:right;'>
        <p  style='background-color:lightblue; word-wrap:break-word; display:inline-block;
        padding:5px; border-radius:10px; max width:70%;'>
        ".$row1['Message']."</p>
        </div>
      ";
    }
    else{
      echo"
        <div style='text-align:left;'>
        <p  style='background-color:yellow; word-wrap:break-word; display:inline-block;
        padding:5px; border-radius:10px; max width:70%;'>
        ".$row1['Message']."</p>
        </div>
      ";
    }
   
      
    }
    
  
  ?>

</div>



</div>
<div class="modal-footer">
  <form action="insertmessage.php" method="post">

   
    <input type="text" value=' <?php echo $customerid; ?>' name ="fromuser" id="fromuser" hidden/>
        <input type="text" value='<?php echo $restid; ?> ' name="touser" id="touser" hidden/>
         <input type="text" value='<?php echo $orderid; ?> ' name="orderid" id="orderid" hidden/>
        <textarea name="message" id="message" class="form-control" style="height: 70px; width: 400px; "></textarea>
        <br>
  <button id="send" name="send" class="btn btn-primary" style="height: 70%;"> send </button>
  </form>
</div>
</div>
</div>
</div>
</center>
</body>
 
  