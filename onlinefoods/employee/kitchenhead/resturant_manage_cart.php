<?php  

 include ('dbh.inc.php'); ?>

<?php 

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['Accept'])){
        echo $id =   $_POST['item_id'];
        $status="ACCEPTED";
        echo $rest_id = $_POST['rest_id'];
        $item_id = trim($id);
        $sql1= "UPDATE orders  SET status = '$status'  WHERE orderid = '$item_id' ;";
        $data = mysqli_query($conn, $sql1);
        if($data){
            header("Location: order_accept_page.php?error=none&cid=$cid&rest=$rest_id");  
        }else{
            echo "error";
        }
    
    
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['Decline'])){
        echo $id =   $_POST['item_id'];
        $status="DECLINE";
        echo $rest_id = $_POST['rest_id'];
        $item_id = trim($id);
        $sql1= "UPDATE orders  SET status = '$status'  WHERE orderid = '$item_id' ;";
        $data = mysqli_query($conn, $sql1);
        if($data){
            header("Location: order_accept_page.php?error=none&cid=$cid&rest=$rest_id");  
        }else{
            echo "error";
        }
    
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['Delivered'])){
            
        echo $id =   $_POST['item_id']; 
        $status="DELIVERED";
        echo $rest_id = $_POST['rest_id'];
        $item_id = trim($id);
        $sql1= "UPDATE orders  SET status = '$status'  WHERE orderid = '$item_id' ;";
        $data = mysqli_query($conn, $sql1);
        if($data){
            header("Location: order_delivered_page.php?error=none&cid=$cid&rest=$rest_id");  
        }else{
            echo "error";
        }
    }
}

?>