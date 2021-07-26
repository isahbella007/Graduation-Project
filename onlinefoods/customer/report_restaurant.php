 <?php 
error_reporting(0);
require('config.php');
include('header/restaurantheader.php');
if(($_SESSION['login'])){
	echo $customerid = $_SESSION['customerid'];
	
    // Get the list of all restaurants. 
    $getRes = "SELECT * FROM restaurant";
    $getResStmt = $conn->prepare($getRes);
    $getResStmt->execute();
    $getResResult = $getResStmt->fetchAll(PDO::FETCH_ASSOC);

    // If I click on the submit button, get the id of 
    // The restaurant clicked on. 
    // Check if the orderid that the user will enter 
    // Belongs to the restaurant selected. 
    // Send the message. 
    $insertQuery = false;
    if(isset($_POST['submit'])){
        echo $customerid = $_SESSION['customerid'];
        echo "Sdad";
        $orderId = $_POST['orderid'];
        echo $resName = $_POST['allRestaurant'];
        $message = $_POST['message'];

        $getId = "SELECT * FROM restaurant WHERE name = '$resName'";
        $getIdStmt = $conn->prepare($getId);
        $getIdStmt->execute();
        $getIdResult = $getIdStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($getIdResult as $idRes){
            echo $selectedResId = $idRes['restaurantid'];
        }
        // Check orderid entered by user
        $orderCheck = "SELECT * FROM orders WHERE orderid = '$orderId'
        AND restaurantid = '$selectedResId' AND customerid = 
        '$customerid'";
        $orderCheckStmt = $conn->prepare($orderCheck);
        $orderCheckStmt->execute();
        $orderCheckResult = $orderCheckStmt->fetchAll(PDO::FETCH_ASSOC);
        if($orderCheckResult){
            // Insert the details into the report table in the database.
            $insert = "INSERT INTO report(restaurantid, orderid,customerid,message)VALUES
            (:resId,:orderid,:customerid,:message)";
            $insertStmt = $conn->prepare($insert);
            $insertStmt->execute(array(
                ':resId' => $selectedResId,
                ':orderid' => $orderId, 
                ':customerid' => $customerid,
                ':message' => $message,
            ));
            $insertQuery = True; 
            if($insertQuery){
                echo "<script type='text/javascript'>alert('Complain Submitted.');
                window.location='myorders.php';
                </script>";
            }
            // The restaurant selected received the order
        }else{
            echo "<script type='text/javascript'>alert('Please, review the orderid entered.');
            window.location='myorders.php';
            </script>";
        }
    }
	
}else{
    header("location: customerloginpage.php");
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
            </div>  
        </div>
    </nav>
    <div class="container">

        <form method = "post" style="width:400px; margin: 0 auto;">
            <h1>Report Form</h1>
            
            <select name="allRestaurant" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php foreach($getResResult as $resResult){?>
                    <option><?php echo $resResult['name'];?></option>
                <?php }?>
                
            </select>
            
            <div class="required-field-block">
                <input type="text" name = "orderid" placeholder="Order Id" class="form-control" required>
            </div>
            
            <br>
            <div class="required-field-block">
                <textarea rows="3" name = "message" class="form-control" placeholder="Message" required></textarea>
            </div>
            
            <br>
            <button class="btn btn-primary" name = "submit">Submit</button>
        </form>
    </div>
</body>
