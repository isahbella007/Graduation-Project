<?php 
require('config.php');
// 
$insertDone = False; 
if(isset($_POST['submit'])){
    $resName = $_POST['name'];
    $message = $_POST['message'];

    // Check if the restaurant name entered is valid 
    $nameCheck = "SELECT * FROM restaurant WHERE name = '$resName'AND FLAG ='SUSPENDED' ";
    $nameCheckStmt = $conn->prepare($nameCheck);
    $nameCheckStmt->execute();
    $nameCheckResult = $nameCheckStmt->fetchAll(PDO::FETCH_ASSOC);

    // From the restaurant name, get the id of the restaurant 
    if($nameCheckResult){
        foreach($nameCheckResult as $nameRes){
            echo $resId = $nameRes['restaurantid'];
        }
        // Check if the manager has sent an appeal that hasn't been handled . 
        $checkMessage = "SELECT * FROM appeal WHERE restaurantid = '$resId' and status = 'NEW'";
        $checkMessageStmt = $conn->prepare($checkMessage);
        $checkMessageStmt->execute();
        $checkMessageResult = $checkMessageStmt->fetchAll(PDO::FETCH_ASSOC);
        if($checkMessageResult){
            echo "<script type='text/javascript'>alert
                ('Your Previous Appeal is being reviewed. Please, Be patient.');
                window.location='index.php';
                </script>";
        }else{
            $insertAppeal = "INSERT INTO appeal(restaurantid, res_name, message, status)VALUES(
            :resId, :resName, :message, :status)";
            $insertStmt = $conn->prepare($insertAppeal);
            $insertStmt->execute(array(
                ':resId' => $resId, 
                ':resName' => $resName, 
                ':message' => $message, 
                ':status' => 'NEW', 
            ));
            $insertDone = True; 
            if($insertDone){
                echo "<script type='text/javascript'>alert
                ('Appeal Submitted.');
                window.location='index.php';
                </script>";
            }
        }
    }else{
        echo '<script type="text/javascript">';
        echo ' alert("Please, check the spelling of your restaurant and re-enter. ")'; 
         echo '</script>';
    }
    
    

    // Insert into the appeal table in the database. 
}

?>
<html> 
<head>
<title>Submit Appeal</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel = "stylesheet" href = "css\register.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<div class="container">
<br><br><br>
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
    <h4 class="card-title mt-3 text-center">Submit An Appeal</h4>
    
    <form method = "post" action = "">
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Restaurant Name: </span>
         </div>
        <input name="name" class="form-control" placeholder="Enter Your Restaurant Name" type="text" required>
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> Message: </span>
        </div>
        <textarea rows="3" name = "message" class="form-control" placeholder="Enter Your Message Here" required></textarea>
    </div>                
    <div class="form-group">
        <button name = "submit" type="submit" class="btn btn-primary btn-block"> Submit </button>
    </div>                                                                 
</form>
</article>
</div> 

</div> 

</body>
</html>