
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>kitchen Head</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
      
       
    $restid = $_SESSION['restaurantid'] ;
    $_SESSION['restaurantid'] = $restid;
    $emid = $_SESSION['id'] ;
    $_SESSION['id'] =$emid;
    ?>
<?php 
   $count=0;
   $mcount=0;
   $check ;
 
if (isset($check)){

    $sql4 = "SELECT * FROM messages INNER JOIN customers
    ON customers.customerid = messages.FromUser  WHERE messages.ToUser=$restid
    AND messages.status='NEW' GROUP BY messages.orderid  
     ;";
    $result4 = mysqli_query($conn,$sql4);
                      
    $resultcheck4 = mysqli_num_rows($result4);
                      
    while ($row4 = mysqli_fetch_assoc($result4)){
    $count++;
    }
     $sql4 = "SELECT * FROM messages INNER JOIN restaurant
    ON restaurant.restaurantid = messages.FromUser  WHERE messages.ToUser=$emid
    AND messages.status='NEW' GROUP BY restaurant.restaurantid  
     ;";
    $result4 = mysqli_query($conn,$sql4);
                      
    $resultcheck4 = mysqli_num_rows($result4);
                      
    while ($row4 = mysqli_fetch_assoc($result4)){
    $mcount++;
    }
}


else{     
    $getOrders1 = "SELECT * FROM messages INNER JOIN customers
    ON customers.customerid = messages.FromUser  WHERE messages.ToUser=$restid
    AND messages.status='NEW' GROUP BY messages.orderid  ;";
    $getOrdersStmt1 = $conn->prepare($getOrders1); 
    $getOrdersStmt1->execute();
    $getOrdersResult1 = $getOrdersStmt1->fetchAll(PDO::FETCH_ASSOC); 
    foreach($getOrdersResult1 as $orderResult1){
        $count++;

    }
    $getOrders1 = "SELECT * FROM messages INNER JOIN restaurant
    ON restaurant.restaurantid = messages.FromUser  WHERE messages.ToUser=$emid
    AND messages.status='NEW' GROUP BY restaurant.restaurantid  
     ;";
    $getOrdersStmt1 = $conn->prepare($getOrders1); 
    $getOrdersStmt1->execute();
    $getOrdersResult1 = $getOrdersStmt1->fetchAll(PDO::FETCH_ASSOC); 
    foreach($getOrdersResult1 as $orderResult1){
        $mcount++;

    }
}
   
                        ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <?php if(isset($_SESSION['login'])){?>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['restaurantname'];?> <sup></sup></div>
                <?php } ?>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-circle" aria-hidden="true"></i>
                    <span>Food Inventory</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="addfoodinventory.php">Add Food Inventory</a>
                        <a class="collapse-item" href="managefoodinventory.php">Manage Food Inventory</a>
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUti"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    <span>Today's Orders </span>
                </a>
                <div id="collapseUti" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="order_accept_page.php">View Orders</a>
                       
                    </div>
                </div>
            </li>
            <!-- Note this,If you want to add extra to the side bar, the data-target and id in div must match -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtil"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tasks </span>
                </a>
                <div id="collapseUtil" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="vieworders.php">Assign Kitchen Staff </a>

                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtil1"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-comments"></i>
                    <span>  Customer Message  </span> <?php echo " <small style='color:red'>$count </small>"; ?>
                </a>
                <div id="collapseUtil1" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="customer_message.php">View New Message </a>
                         <a class="collapse-item" href="all_customer_messeges.php">View All Message </a>
                        <!--   <a class="collapse-item" href="resturant_employee_message.php"> Message Employees</a> -->

                    </div>
                </div>
            </li>
            

            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Communicate
            </div>

            <!-- Nav Item - Tables -->
            
            <li class="nav-item">
                <a class="nav-link" href="messege_manager.php">
                    <i class="fas fa-comments"></i>
                    <span>Message Manager</span><?php echo " <small style='color:red'>$mcount </small>"; ?></a> 
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><?php echo implode(',' ,$_SESSION['ordercount']);?></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="order_accept_page.php">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-black-500"><?php date_default_timezone_set('Europe/Istanbul'); echo $date = date('Y-m-d'); ?></div>
                                        <span class="font-weight-bold">View Today's Orders</span>
                                    </div>
                                </a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?php echo $count;?>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="all_customer_messeges.php">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt=""> 
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><a class="collapse-item" href="customer_message.php">Display Messages </a> </div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                 
                                <a class="dropdown-item text-center small text-gray-500" href="all_customer_messeges.php">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if(isset($_SESSION['login'])){?>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name'];?></span>
                                <?php if($_SESSION['image']){?>
                                 <img class="img-profile rounded-circle"
                                        src="../../userspictures./<?php echo $_SESSION['image']?>">
                                    <?php }else{?>
                                        <img class="img-profile rounded-circle"
                                        src="../../userspictures/default.jpg">
                                    <?php } ?>
                                    <?php } ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="password.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <a class="dropdown-item" href="kitchenheadlogout.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>

                           
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/chart-area-demo.js"></script>
                <script src="js/demo/chart-pie-demo.js"></script>

                </body>

                </html>
                <!-- Begin Page Content -->
                