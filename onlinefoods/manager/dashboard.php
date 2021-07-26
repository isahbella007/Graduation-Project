<?php 
require('config.php');
if(isset($_SESSION['login'])){
    $restaurantId = $_SESSION['restaurantid'];
    // Get people who apploed for job positions
    $viewParticipant = "SELECT Count(name) FROM apply WHERE restaurantid = '$restaurantId'";
    $viewParticipantStmt = $conn->prepare($viewParticipant);
    $viewParticipantStmt->execute(); 
    $viewParticipantResult = $viewParticipantStmt->fetchAll(PDO::FETCH_ASSOC);

    // Most Ordered Meal
    $getOrderedMeal = "SELECT * FROM orders WHERE restaurantid = '$restaurantId' order by itemname ";
    $getOrderedMealStmt = $conn->prepare($getOrderedMeal);
    $getOrderedMealStmt->execute(); 
    $getOrderedMealResult = $getOrderedMealStmt->fetchAll(PDO::FETCH_ASSOC);
    if($getOrderedMealResult){
        foreach($getOrderedMealResult as $mealResult){
            $mostOrdered = $mealResult['itemname'];
        }
    }else{
        $mostOrdered = "Nothing";
    }
   
    // Get the stores Monthly Sale.
    $month = date("m");
    $getMonthlySale = "SELECT SUM(price) FROM orders WHERE restaurantid = '$restaurantId' and EXTRACT(Month from orderdate) = '$month'
    AND status = 'DELIVERED'";
    $getMonthlySaleStmt = $conn->prepare($getMonthlySale); 
    $getMonthlySaleStmt->execute(); 
    $getMonthlySaleResult = $getMonthlySaleStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($getMonthlySaleResult as $monthlyResult){
            $monthlySale = $monthlyResult;
        }
    
   
    // Get the stores Yearly Income.
    $year = date("Y");
    $getYearlySale = "SELECT SUM(price) FROM orders WHERE restaurantid = '$restaurantId' and EXTRACT(Year from orderdate) = '$year'
    AND status = 'DELIVERED'";
    $getYearlySaleStmt = $conn->prepare($getYearlySale); 
    $getYearlySaleStmt->execute(); 
    $getYearlySaleResult = $getYearlySaleStmt->fetchAll(PDO::FETCH_ASSOC); 
    foreach($getYearlySaleResult as $yearlyResult){
        $yearlySale = $yearlyResult;
    }
}else{
    header("location: index.php");
}
?>
<!-- Begin content page -->
<?php include('managerheader.php');?>
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">TL <?php echo implode(',', $monthlySale);?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">TL <?php echo implode(',', $yearlySale);?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                       

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                People Who Applied For Job Positions</div>
                                                <?php foreach($viewParticipantResult as $viewResult){?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo implode ('',$viewResult);?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Most Ordered Meal</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mostOrdered?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cutlery fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                       

                        <!-- Pie Chart -->
                    

                    
    <!-- Bootstrap core JavaScript-->
    

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>