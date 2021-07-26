<?php 
require('config.php');
if(isset($_GET['apply'])){
    // Position Clicked On
    $personPosition = $_GET['post'];
    // echo $personPosition;
    // Restauarant Name
    $restauarnt = $_GET['restaurant'];

    $query = "SELECT * FROM restaurant WHERE restaurantid = '$restauarnt' ";
    $querystmt = $conn->prepare($query);
    $querystmt->execute();
    $result = $querystmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $re){
        // echo $re['name'];
    }

    $added = FALSE;
    if(isset($_POST['submit'])){
        $id =  $restauarnt;
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        // $restaurant = $_POST['restauarnt'];
        $position = $personPosition;
        $describe = $_POST['description'];
        $gender = $_POST['gender'];
        $image = $_POST['image'];

        // Check if the email entered is valid.
        // You can add a 'Check if the person applying has applied to the particular restaurant 
        // more than 
        // 3 times to avoid SPAM.
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $applyQuery = "INSERT INTO apply(restaurantid, name, surname, contact, address, email, gender, description, position, image)
            VALUE(:id, :name, :surname, :contact, :address, :email, :gender, :description, :position, :image)";
            $applyStmt = $conn->prepare($applyQuery);
            $applyStmt->execute(array(
                ':id' => $id, 
                ':name' => $name, 
                ':surname' => $surname, 
                ':contact' => $contact,
                ':address' => $address, 
                ':email' => $email, 
                ':gender' => $gender, 
                ':description' => $describe, 
                ':position' => $position, 
                ':image' => $image
                
            ));
            echo '<script type="text/javascript">';
            echo ' alert("Submitted")'; 
            echo '</script>';
            header("location: index.php");
        }else{
            echo '<script type="text/javascript">';
            echo ' alert("Sorry, Your Email is Invalid")'; 
            echo '</script>';
        }
    }

}


?>
<html>
    <head>
        <title>Apply</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
    <section class="py-4 bg-primary text-light">
        <div class="container">
            <div class="row">
                <h2>Apply For This Position</h2>
            </div>
        </div>
    </section>
    <br>
        <form method = "post">
            <div class = "container">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputEmail4">Name</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Name" name= "name" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputPassword4">SurName</label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="Surname" name = "surname" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name = "address" required>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Email</label>
                <input type="email" class="form-control" id="inputAddress2" placeholder="example@gmail.com" name = "email" required>
            </div>
            <?php if(isset($_POST['apply'])){?>
            <!-- <?php foreach($getRestaurantNameResult as $resName){?>
            <div class="form-group">
                <label for="inputAddress2">Restaurant</label>
                <input type="text" class="form-control" value = <?php echo $resName['name'];?> name = "restaurant" disabled>
            </div>
            <?php } ?> -->
            <div class="form-group">
                <label for="inputAddress2">Position</label>
                <input type="text" class="form-control"  value = <?php echo $personPosition ;?> name = "position" disabled>
            </div>
            <?php }?>
            <div class="form-row">
                
                <div class="form-group col-md-6">
                <label for="inputCity">Describe Yourself</label>
                <input type="text" class="form-control" id="inputCity" name = "description" required>
                </div>
                <div class="form-group col-md-4">
                <label for="inputState">Gender</label>
                <select id="inputState" class="form-control" name = "gender">
                    <option selected>Woman</option>
                    <option>Man</option>
                    <option>Other</option>
                </select>
                </div>
                <div class="form-group col-md-2">
                <label for="inputCity">Contact</label>
                <input type="number" class="form-control" id="inputCity" name = "contact" required>
                </div>
               
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Image</label>
                <input type="file" id="inputZip" name = "image">
                </div>
            
            <button type="submit" class="btn btn-primary" name = "submit">Apply</button>
</div>
            </form>
        
</body>
</html>