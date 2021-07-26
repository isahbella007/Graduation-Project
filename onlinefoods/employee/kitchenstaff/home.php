<?php
require('config.php');
include('layout/kitchenstaffheader.php');
if(isset($_SESSION['login'])){
    $employeeid = $_SESSION['employeeid'];
    $sql = "SELECT * FROM employee WHERE employeeid = '$employeeid'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $res){
        $password = $res['password'];
    }
}
?>

<?php
include('layout/kitchenstafffooter.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
</head>
<?php if($password == 'welcome'){?>
<body>

<div class="alert">
  <strong>Danger!</strong> Update Your Password.
</div>

</body>
<?php }?>
</html>
