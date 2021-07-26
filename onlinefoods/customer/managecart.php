<?php 
require('config.php');
if(isset($_POST['add_to_cart'])){
   if(empty($_SESSION['cart'])){
       $_SESSION['cart'] = array();
   }
   $cartArray = array(
    'itemname'=>$_POST['itemName'],
    'price' => $_POST['price'],
    'quantity' => $_POST['quantity'],
    'image' => $_POST['image']
    );
   if(in_array($_POST['itemName'],$_SESSION['cart'])){
        echo '<script type="text/javascript">';
        echo ' alert("Product is already in cart")'; 
        echo '</script>';
    }else{
        array_push($_SESSION['cart'], $cartArray);
    }
    foreach($_SESSION['cart'] as $key => $value){
        print_r( $_SESSION['cart'][$key]['quantity']);
    }
   header("location: addtocart.php");
}

if(isset($_POST['remove_item'])){
    foreach($_SESSION['cart'] as $key => $value){
        if($value['itemname'] == $_POST['removeItem']){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            header("location: addtocart.php");
        }
        
    }
}

if(isset($_POST['Mod_Quantity'])){
    foreach($_SESSION['cart'] as $key => $value){
        if($value['itemname'] == $_POST['Item_name']){
            $_SESSION['cart'][$key]['quantity'] = $_POST['Mod_Quantity'];
            print_r($_SESSION['cart'][$key]['quantity']);
        }
        header("location: addtocart.php");
    }
        
} 

if(isset($_POST['checkout'])){
    if($_SESSION['login']){
        $customerid = $_SESSION['customerid'];
        $restaurantId = $_SESSION['restaurantIdSelectedByLoggedInUser'];
        $addressId = $_SESSION['useraddress'];
        echo $payment_method = $_POST['payment_method'];
        echo $message = $_POST['message'];
            // Grand Total
       
        // foreach($_SESSION['cart'] as $key => $price){
        //     $sql = "INSERT INTO orders(customerid, restaurantid, addressid, itemname, price, quantity, paymentmethod, message)
        //     VALUES (?,?,?,?,?,?,?,?)";
        //     $stmt = $conn->prepare($sql);
        //     $stmt->bindParam( $customerid, $restaurantId, $addressId, $itemName , $price, $quantity, $payment_method, $message);
        //     foreach($_SESSION['cart'] as $key => $value){
        //         $itemName = $value['itemname'];
        //         $price = $value['price'];
        //         $quantity = $value['quantity'];
        //         $stmt->execute();
        //     }
            
        

        //     // echo $price['itemname'];
        //     // echo $price['quantity'];
        //     // echo $price['price'];
        //     // echo $_SESSION['customerid'];
        //     // echo $_SESSION['useraddress'];
        //     // echo $_SESSION['restaurantIdSelectedByLoggedInUser']; 
        // }
    }
   
}

if(isset($_POST['mod_quantity'])){
     foreach ($_SESSION['cart'] as $key => $value){
          if($value["itemname"] == $_POST['item_id']){
            $_SESSION['cart'][$key]['quantity']= $_POST['mod_quantity'];
            
                 
              echo"
              <script>
               
              window.location.href='addtocart.php';

              </script>

              ";
             
          }
      }

        
  }
       
// if($_SERVER["REQUEST_METHOD"]=="POST"){
//  if(isset($_POST['submit'])){
//   echo $item_id = $_POST['item_id'];
//   echo $speed = $_POST['speed'];
//   echo $taste = $_POST['taste'];
//   echo $note = $_POST['review'];
//   echo $price_value = $_POST['price'];
//   echo $add = (integer)$speed+ (integer)$taste+(integer)$price_value;
//   echo $total = (float)($add/30)*10;
//    $cid = $_SESSION['customerid'];
//     $_SESSION['customerid'] =    $cid;
//   echo $cid;
//   $rate_status = 1;
//   echo $rest_id = $_POST['rest_id'];

//   function insertorder($conn, $item_id, $rest_id, $cid, $speed, $taste, $price_value, $total, $note, $rate_status){
 
// $sql= "INSERT INTO ratings (orderid, resturantid, customerid, speed, taste, price_value, total, note, rate_status ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ? );";
// $stmt = mysqli_stmt_init($conn);
// if(!mysqli_stmt_prepare($stmt,$sql)){
//   echo "error";
// // header("Location: add.php?error=stmtfailled&cid=$cid");
// exit();

// }
// else{
// mysqli_stmt_bind_param($stmt, "siiiiissi", $item_id, $rest_id, $cid, $speed, $taste, $price_value, $total, $note, $rate_status);

  
// mysqli_stmt_execute($stmt);

// $sql1= "UPDATE orders  SET rate_status = '$rate_status'  WHERE orderid = '$item_id' ;";
// mysqli_query($conn, $sql1);
 

// header("Location: myorders.php ");
 
// } 
 
 
//  header("Location: myorders.php ");
 
// }
// insertorder($conn, $item_id, $rest_id, $cid, $speed, $taste, $price_value, $total, $note, $rate_status);
//  }}  

?>