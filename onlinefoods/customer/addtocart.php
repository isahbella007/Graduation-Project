<?php 
error_reporting(0);
require('config.php');
include('header/restaurantheader.php');
if(($_SESSION['login'])){
	$customerid = $_SESSION['customerid'];
	$_SESSION['customerid'] =$customerid;
	$userAddressId = $_SESSION['useraddress'];
	 
	$_SESSION['useraddress'] =$userAddressId;
	// This is the meal that the Logged in user slected.
	$_POST['foodmenu_userLoggedIn'];
	
	// This is the id of the restaurant that the Logged in user selected.
	$restid = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
	$_SESSION['restaurantIdSelectedByLoggedInUser'] =$restid;
	// print_r($_SESSION['cart']);

	
}else{  header("location: customerregisterpage.php");}

if(isset($_POST['foodmenu_userNotLoggedIn'])){
	// This is the meal that the Guest user selected.
	echo $_POST['foodmenu_userNotLoggedIn'];
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
					<button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
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
    <div class="col-lg-8">
 <div class="container">
   <div class="row">
     <div class="col-lg-12 text-center border rounded bg-light my-5">
      <h1>MY CART</h1>
    </div>
      <div class="col-lg-8"> 

 <table class="table">
  <thead class="text-center">
    <tr>
       
      <th scope="col">Item Name</th>
      <th scope="col">Item Price</th>
      <th scope="col">Quantity</th>
       <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <?php
    
    
    if(isset($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $key => $value) {
      # code...
      

      
    
      echo $emements="
      <tr>
        
      <td>$value[itemname]</td>
      <td>$value[price]<input type='hidden' class='iprice'   value='$value[price]'></td>
       
      <form action='managecart.php?rest=$restid&fmid=$fmid' method='POST' >
      <td>

      <input class='text-center iquantity'name='mod_quantity' onchange='this.form.submit();'   type='number'value='$value[quantity]' min='1' max='10'>
      <input type='hidden' name='item_id' value='$value[itemname]'>
      </form> </td>
      <td class='itotal'></td>
      <form action='managecart.php' method='post' id='rem'>
      <td><button name = 'remove_item' class='btn btn-sm btn-outline-danger'> REMOVE  </botton> 
      <input type='hidden' name='removeItem' value='$value[itemname]'>
 </td>

      </form>
      
      </tr>

      ";

    }
}
    ?>
    
 
  </tbody>
</table>
       
     </div>

 <div class="col-lg-3">
     <div class="border bg-light rounded p-4">
        <h4>Grand Total:</h4>
      <h5 class="text-center " id="gtotal"> </h5>
      <br>
      <?php
    if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){


      ?>
         <form action="purchase.php"  method="POST">
 


      

<div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Card at Door" checked>
  <label class="form-check-label" for="exampleRadios1">
   Pay with Card
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Cash">
  <label class="form-check-label" for="exampleRadios2">
    Pay with Cash
  </label>
  <input type='hidden' name='rest' value= <?php echo $restid?>>
</div>
<div class="form-floating">
				<textarea class="form-control" placeholder="Message(Optional)" name = "message" id="floatingTextarea2" style="height: 100px"></textarea>
				<label for="floatingTextarea2"></label>
			</div>

<br>
 
 
        <button   class="btn btn-primary btn-block  " name="Order">
          Order
        </button>
</form>
  <?php 
    }
    ?>

      <?php
    
    if(isset($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $key => $value) {
      # code...
     

      
    
      echo"
      <tr>
      
      <td> <input type='hidden'     value='$value[price]'></td>
 
 
      <input type='hidden' name='itemm_id' value='$value[productid]'>


       
      </td>
      </tr>

      ";
    }
}
    ?>

      </form>
     </div>
       
     </div>
   </div>

 </div>
<script>

  var gt=0;
var iprice=document.getElementsByClassName('iprice');
var iquantity=document.getElementsByClassName('iquantity');
var itotal=document.getElementsByClassName('itotal');
var gtotal=document.getElementById('gtotal');
 

function subTotal(){
  var gt=0;
  var gtt=0;
  var l = 0;
   
  for(i=0;i<iprice.length;i++){

    itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
    gt=gt+(iprice[i].value)*(iquantity[i].value);
     



  }
gtotal.innerText=gt;


}
 subTotal();

 
</script>