<?php 
include('config.php');
include('header/restaurantheader.php');

if(isset($_SESSION['login'])){
  $restid = $_SESSION['restaurantIdSelectedByLoggedInUser']; 
  $sql = "SELECT * FROM ratings WHERE resturantid = '$restid'";
  $stmt =$conn->prepare($sql); 
  $stmt->execute(); 
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  
 
}
 else{  
  $resId = $_SESSION['restaurantIdSelectedByGuestUser'];
  $sql1 = "SELECT * FROM ratings WHERE resturantid = '$resId'";
  $stmt1 = $conn->prepare($sql1);
  $stmt1->execute();
  $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
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
            <?php if(isset($_SESSION['login'])){?>
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
            <?php }else{?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 " >
                    <li class="nav-item">
                    <button onclick="history.go(-1);"><p style = "color:white">Back</p> </button>
                    </li>
                </ul>
            <?php }?>
            </div>  
        </div>
    </nav>
<?php if(isset($_SESSION['login'])){?>
  <?php foreach($result as $loggedinUser){?>
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
                            <table  id="dataTable" width="120%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Speed</th>
                                  <th>Taste</th>
                                  <th>Price for value</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><?php echo $loggedinUser['speed'];?></td>
                                  <td><?php echo $loggedinUser['taste'];?></td>
                                  <td><?php echo $loggedinUser['price_value'];?></td>
                                </tr>
                              </tbody>
                            </table>
                            <br>
                            <p>Message: <?php echo $loggedinUser['note'];?> </p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
        </div>
    </section>
  <?php }?>
  <?php }else{?>
    <?php foreach($result1 as $notloggedinUser){?>
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
                            <table  id="dataTable" width="120%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Speed</th>
                                  <th>Taste</th>
                                  <th>Price for value</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><?php echo $notloggedinUser['speed'];?></td>
                                  <td><?php echo $notloggedinUser['taste'];?></td>
                                  <td><?php echo $notloggedinUser['price_value'];?></td>
                                </tr>
                              </tbody>
                            </table>
                            <br>
                            <p>Message: <?php echo $notloggedinUser['note'];?> </p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
        </div>
    </section>
    <?php }?>

  <?php }?>
