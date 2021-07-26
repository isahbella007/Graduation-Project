<?php
require('config.php');
include('header/restaurantheader.php');
if(isset($_GET['restaurantmenu'])){
    echo $_GET['restaurantmenu'];
    echo "Not logged in";
}
?>
