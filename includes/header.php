<?php
	include('function/function.php'); 
	include('config/constants.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-Commerce Project</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	  <div class="header_wrapper">
	  <div class="header_logo">
	  <a href="index.php">
	  <img id="logo" src="images/metrixcode100x30.png" />
	  </a>
	  </div><!--/.header_logo-->
	  
	  <div id="form">
	     <form method="get" action="result.php" enctype="multipart/form-data">
		  <input type="text" name="user_query" placeholder="Search a Product" />
		  <input type="submit" name="search" value="Search" />
		 </form>
	  </div>  
	  
	  <div class="cart">
	    <ul>
		  <li class="dropdown_header_cart">
		   <div id="notification_total_cart" class="shopping-cart">
		     <a href="cart.php">
		     	<img src="images/cart_icon.png" id="cart_image">	
	          	<div class="noti_cart_number">
	          	<?php 
	          		total_item();
	          	 ?>
	          	</div>
		     </a><!-- /.noti_cart_number -->		  
		   </div>
		  </li>
		</ul>
	  </div>


	  <?php if (!isset($_SESSION['user_id'])) {
	  	?>
	<div class="register_login">
	  <div class="login">
	  	<a href="index.php?action=login" class="btn btn-outline-info">Login</a>
	  </div>
	  &nbsp;&nbsp;
	  <div class="register"><a href="register.php" class="btn btn-outline-success">Register</a></div>
	  </div><!-- /.register_login --> 
  		<?php } else {
  		 ?>
  		 <?php 
  		 	$user_id = $_SESSION['user_id'];
  		 	$sql = mysqli_query($conn,"select * from user where id ='$user_id'");
  		 	$data_user = mysqli_fetch_assoc($sql);

  		  ?>

  			<div class="dropdown show" style="min-width: 120px;">
				  <a class="btn btn-secondary dropdown-toggle" style="background: #fff; color:#000;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <?php if($data_user['image'] != "") { ?>
  							<span>
  								<img src="images/customer_images/<?php echo $data_user['image'];?> " width="27" height="27" style="border-radius:40% ;">
  							</span>
  						<?php }else{ ?>
  							<span>
  								<img src="images/profile-icon.png" style="width:27px;height: 27px;">
  							</span>
  					<?php } ?>
				  </a>

				  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				    <a href="myaccount.php?action=edit_account" class="dropdown-item">Account setting</a>
				    <a href="logout.php" class="dropdown-item">LogOut</a>
				  </div>
				</div>
	  <?php } ?>
	  </div><!-- /.header_wrapper --> 



		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #8e44ad;">
		  <a class="navbar-brand" href="index.php" style="color:#ffffff;">Home</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active" style="color:#ffffff;">
		        <a class="nav-link" href="all_product.php" style="color:#ffffff;">All Product <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="#" style="color:#ffffff;">My Account <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="cart.php" style="color:#ffffff;">Shopping Cart <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="#" style="color:#ffffff;">Contact Us <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="logout.php" style="color:#ffffff;">LogOut<span class="sr-only">(current)</span></a>
		      </li>

		    </ul>
		  </div>
		</nav>


<script>
	
</script>
		