
<head>
<link rel = "stylesheet" href = "css/kicthenstaffheader.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<nav>
	<input id="nav-toggle" type="checkbox">
	<div class="logo"><?php echo $_SESSION['restaurantname'];?></div>
	<ul class="links">
		<li><a href="updateorder.php">Update Order</a></li>
		<li><a href="updatepassword.php">Update Password</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
	<label for="nav-toggle" class="icon-burger">
		<div class="line"></div>
		<div class="line"></div>
		<div class="line"></div>
	</label>
</nav>

<div class="container">
	
</div>
