<?php 
require('config.php');
$viewVacancy = "SELECT * FROM vacancy WHERE flag = 'ACTIVE' AND availability >=1";
$viewVacancyStmt = $conn->prepare($viewVacancy);
$viewVacancyStmt->execute();
$viewVacancyResult = $viewVacancyStmt->fetchAll();

?>
<html>
    <head>
        <title>OnlineFoods Job Listing</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    </head>
    <body>
    <section class="py-5 bg-primary text-light">
        <div class="container">
            <div class="row">
                <h2>Job Listings</h2>
            </div>
        </div>
    </section>
  
    <?php foreach($viewVacancyResult as $viewResult){?>
        <?php $resid = $viewResult['restaurantid'];?>
        <!-- Using the viewResult id, get the name of the restaurant. -->
            <?php $name = "SELECT * FROM restaurant WHERE restaurantid = '$resid'"; ?>
            <?php $namestmt = $conn->prepare($name); ?>
            <?php $namestmt->execute();?>
            <?php $result = $namestmt->fetchAll(); ?>
            
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
                            <?php foreach($result as $k){?>
                                 <h5> <?php echo $k['name'];?> </h5>
                             <?php }?>
                            <p>Position: <?php echo $viewResult['position'];?></p>
                            <p>Availability: <?php echo $viewResult['availability'];?></p>
                            <p>Status: <?php echo $viewResult['flag'];?></p>
                            <hr>
                            <p>Job Description: <?php echo $viewResult['description'];?></p>
                            <form method = "GET" action = "apply.php">
                            <input type="submit" name = "apply" class="btn btn-primary btn-xs" value = "Apply">
                            <input type = "hidden" name = "post" value = "<?php echo $viewResult['position'];?>" class = >
                            <input type = "hidden" name = "restaurant" value = "<?php echo $resid;?>">
                            </form>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
        </div>
     </section>
    <?php }?>

</body>
</html>
