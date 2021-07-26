<?php 
require('config.php');
include('layout/header.php');
if(isset($_SESSION['login'])){
    $employeeid = $_SESSION['employeeid'];
    $sql = "SELECT password FROM employee WHERE employeeid = '$employeeid'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $res){
        $oldpassword = $res['password'];
    }
    if(isset($_POST['update'])){
        $newPassword = $_POST['newpassword'];
        $update = "UPDATE employee SET password = '$newPassword' WHERE employeeid = '$employeeid'";
        $updateSql = $conn->prepare($update);
        $updateSql->execute();

        echo '<script type="text/javascript">';
        echo ' alert("Password Updated")'; 
        echo '</script>';
    }
    // DOd stuff
}
?>
<div class="container-fluid">
<form method = "post"> 
  <div class="mb-3">
      
    <label for="exampleInputEmail1" class="form-label">Old Password:</label>
    <input type="text" class="form-control" name = "foodcategory" value = "<?php echo $oldpassword?>"disabled>
  </div>
  <div class="mb-3">
      
    <label for="exampleInputEmail1" class="form-label">New Password:</label>
    <input type="password" class="form-control" name = "newpassword">
  </div>
  <button type="submit" class="btn btn-primary" name="update" >Update</button>
</form>
</div>