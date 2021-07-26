<?php  

 include ('dbh.inc.php'); 
 ?>
<?php 
if(isset($_SESSION['login'])){
    
    
}else{
    header("location: onlinefoods/employee/index.php");
}
$restid = $_SESSION['restaurantid'] ;
$_SESSION['restaurantid']  = $restid;
$cid='';
if(isset($_GET["cid"])){
   
     $cid = $_GET["cid"];
 $_SESSION['customerid'] = $cid;
  $cid = $_SESSION['customerid'];
    // $_SESSION['customerid'] = $cid;
}
 if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(isset($_POST['view'])){
 
     $cid=$_POST['cid'];
  $_SESSION['customerid'] = $cid;
  $cid = $_SESSION['customerid'];
    $orderid = $_POST['orderid'];
      $emid = $_SESSION['id'] ;
     $_SESSION['id'] =$emid;
      $restid;
    
}
}
  $check='val';
  $sql1= "UPDATE messages  SET status = 'SEEN'  WHERE FromUser = '$restid' ;";
mysqli_query($conn, $sql1);
  include('kitchenheadheader.php');
 ?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="footer, address, phone, icons" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript">
   
</script>
<style>
 

 
</style>
</head>

<body>
  <center> 
  <div class="col-md-4">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           
<div class="modal-body" id="msgbody" style="height: 400px;  overflow-y:scroll; overflow-x: hidden; ">
<?php
 

$sql1 = "SELECT * FROM messages  WHERE (FromUser = '$restid' AND ToUser ='$emid'  ) OR (FromUser = '$emid' AND ToUser ='$restid' )  ;";
  $result1 = mysqli_query($conn,$sql1);
  $resultcheck1 = mysqli_num_rows($result1);
  while ($row1 = mysqli_fetch_assoc($result1)){
    if($row1['FromUser']== $emid){
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
 
   
    <input type="text" value=' <?php echo $emid; ?>' name ="fromuser" id="fromuser" hidden/>
        <input type="text" value='<?php echo $restid; ?> ' name="touser" id="touser" hidden/>
        <textarea name="message" id="message" class="form-control" style="height: 70px; width: 300px; "></textarea>
        <br>
  <button id="send" name="rrsend" class="btn btn-primary" style="height: 70%;"> send </button>
  </form>
</div>
</div>
</div>
</div>
</center>
</body>
</html>