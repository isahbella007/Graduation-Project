<?php 
require('config.php');
if(isset($_SESSION['login'])){?>

    <?php include('managerheader.php');?>
    <div class="container-fluid">
        <form method = "post" action = "viewallordersprocess.php">
            <div class="form-group">
                    <label for="exampleInputPassword1">FROM:</label>
                    <input type="date" name = "fromdate" class="form-control" id="exampleInputPassword1" required>
            </div>

            <div class="form-group">
                    <label for="exampleInputPassword1">TO:</label>
                    <input type="date" name = "todate" class="form-control" id="exampleInputPassword1" required>
            </div>
            <input type="submit" name = "submit" class = "btn btn-primary" value = "Submit">
        </form>
    </div>
<?php }?>
<br>