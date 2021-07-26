<?php
require('config.php');
if(isset($_SESSION['login'])){
    $resId = $_SESSION['restaurantid'];
    $number_of_chances = 5;
    // Get the number of times the restaurant has been reported by a customer. 
    $sql = "SELECT * FROM `report` WHERE restaurantid = '$resId' AND res_flag = 'Received' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Display the Complains to the manager. 
}else{
    header("location: index.php");
}
?>
<?php include('managerheader.php');?>
<style>
    @import url('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
 
    .isa_info, .isa_success, .isa_warning, .isa_error {
    margin: 10px 0px;
    padding:12px;
    }

    .isa_warning {
    color: #9F6000;
    background-color: #FEEFB3;
    }

    .isa_success {
    color: #4F8A10;
    background-color: #DFF2BF;
    }

    .isa_info {
    color: #00529B;
    background-color: #BDE5F8;
    }   
    .isa_error {
    color: #D8000C;
    background-color: #FFD2D2;
    }
    .isa_info i, .isa_success i, .isa_warning i, .isa_error i {
    font-size:2em;
    vertical-align:middle;
    }
</style>
<?php if(count($result) == 0){?>
    <div class="isa_success">
        <i class="fa fa-check"></i>
        No Complains From Customers Yet. 
    </div>
<?php }?>

<?php if($number_of_chances - count($result) == 3 or $number_of_chances - count($result) ==4 ){?>
    <div class="container-fluid">
        <div class="isa_info">
            <i class="fa fa-info-circle"></i>
            Restaurant has been reported <?php echo count($result)?> time
        </div>
</div>
<?php }?>

<?php if($number_of_chances - count($result) == 2 or $number_of_chances - count($result) == 1 ){?>
    <div class="container-fluid">
        <div class="isa_error">
            <i class="fa fa-info-circle"></i>
            Restaurant has been reported <?php echo count($result)?> times. Suspension will follow soon.
        </div>
</div>
<?php }?>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
</head>
<?php foreach($result as $reportRes){?>
    <section class="py-5 bg-white py-5">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-1 col-sm-2 col-md-1 mr-3">
                            <i class="fa fa-cutlery fa-4x "></i></br>
                            </div>
                            <div class="col-xs-8 col-sm-7 col-md-8">
                            <p>Order Id: <a href="complain_details.php?orderid=<?php echo $reportRes['orderid']?>"> <?php echo $reportRes['orderid']; ?></a></p>
                            <p>Customer Complain: <?php echo $reportRes['message'];?></p>  
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
        </div>
    </section>
<?php }?>