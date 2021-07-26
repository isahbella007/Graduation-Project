<?php 

 include ('dbh.inc.php');
if(isset($_SESSION['login'])){
       $resId = $_SESSION['restaurantid'];
    $_SESSION['restaurantid'] = $resId ;
    // date_default_timezone_set('Europe/Istanbul');
    // $date = date('Y-m-d');   
    
    // Get the orders for this particular date.
    // $getOrders = "SELECT * from orders WHERE status = 'Accepted' AND restaurantid = '$resId'";
    // $getOrdersStmt = $conn->prepare($getOrders); 
    // $getOrdersStmt->execute();
    // $getOrdersResult = $getOrdersStmt->fetchAll(PDO::FETCH_ASSOC); 

    
}else{
      header("location: onlinefoods/employee/index.php");
}  $check='val';
   $resId = $_SESSION['restaurantid'];
    $_SESSION['restaurantid'] = $resId ;
 
?>
<?php include('kitchenheadheader.php');
  $check= "val"; ?>

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

 
<style>
 

 
</style>
</head>
<body>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <table class="table   table-bordered ">
                  
                  <tbody>   
                    <?php
                   

                     $sql1 = "SELECT * FROM messages  WHERE ToUser = $resId GROUP BY ToUser   ;";

                     $result1 = mysqli_query($conn,$sql1);
 
                     $resultcheck1 = mysqli_num_rows($result1);
 
                     while ($row1 = mysqli_fetch_assoc($result1)){
                        echo "      <table class='table table-bordered   '>
                        <thead>
                    <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'> orderid</th>
                     <th scope='col'> Chat</th>
                         
                    </tr>
                  </thead> 
                  <tbody>";
                      

                   $custid = $row1['ToUser'];

                     $sql3 = "SELECT * FROM messages INNER JOIN customers ON customers.customerid = messages.FromUser  WHERE messages.ToUser=$resId AND messages.status='NEW' GROUP BY messages.orderid  
 ;";
                     $result3 = mysqli_query($conn,$sql3);
                     $resultcheck3 = mysqli_num_rows($result3);
                      
                     while ($row3 = mysqli_fetch_assoc($result3)){
                        echo "
                        <tr>
                        <td>$row3[name]</td>
                          <td><a href='orderdetails.php?orderid=$row3[orderid]'>$row3[orderid]</a></td>
                         
                        <td> <br> ";

                           echo $emements=" 
                     <form action='resturant_message.php' method='post'>
                     <input type='hidden' name='cid' value=' $row3[customerid]'>
                     <input type='hidden' name='orderid' value=' $row3[orderid]'>
                     <button   class='btn btn-primary btn-block  ' style='width:100px' name='view'>
                      VIEW MESSAGE
                     </button>
                     </form>

                      ";
                      
                     }
                      
                      

                   
                    

                  echo"
                  </tbody>
                  </table>

                        </td>
                         </tr>

                        ";
                         
                     
                 }

                    ?>
                  </tbody>

                </table>
            </div>
        </div>
    </div>
</body></html>