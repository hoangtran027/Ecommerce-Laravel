<?php 
	include ('includes/header.php');
 ?>
<script>
	$(document).ready(function() {
		$("#password_confirm2").on('keyup',function () {
			var password_confirm1 = $("#password_confirm1").val();
			var password_confirm2 = $("#password_confirm2").val();
			if ( password_confirm1 == password_confirm2) {
				$("#status_for_confirm_password").html('<strong style="color:green">Password match</strong>');
			}
			else{
				$("#status_for_confirm_password").html('<strong style="color:red">Password not match</strong>');
			}
		})
	});


</script>



		<div class="container" style="margin-top: 40px;">
			<div class="row">
				<form action="" method="POST" enctype="multipart/form-data" style="width:80%;">
				    <div class="form-group">
					    <label for="exampleInputEmail1">Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="Enter Name" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email</label>
					    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter Email" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Password</label>
					    <input type="password" class="form-control" id="password_confirm1" aria-describedby="emailHelp" placeholder="Enter Password" name="password" required>
					  </div>
					   <div class="form-group">
					    <label for="exampleInputEmail1">Confirm Password</label>
					    <input type="password" class="form-control" id="password_confirm2" aria-describedby="emailHelp" placeholder="Enter Confirm Password" required name="confirm_password">
					    <p id="status_for_confirm_password"></p>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Image</label>
					    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="image" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Country</label>
					    <?php include('country_list.php'); ?>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">City</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="city" placeholder="Enter City" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Contact</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="contact" placeholder="Enter Contact" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Address</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="address" placeholder="Enter Address" required>
					  </div>

				  <button type="submit" name="register" class="btn btn-primary">Register</button>
				</form>

			</div>
		</div>

<?php 
	if (isset($_POST['register'])) {
		if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['name'])) {
			$ip = get_ip();
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = trim($_POST['password']);
			$hash_password = md5($password);
			$confirm_password = trim($_POST['confirm_password']);
			$image = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$country = $_POST['country'];
			$contact = $_POST['contact'];
			$city = $_POST['city'];
			$address = $_POST['address'];

			$check_exit = mysqli_query($conn,"select * from user where email = '$email'");
			$email_count = mysqli_num_rows($check_exit);
			$row_email = mysqli_fetch_assoc($check_exit);
			$email_user = $row_email['email'];

			if($email_count>0) {
				echo "<script>alert('Sorry, your email $email address already exist in our database')</script>";
			}
			if($password == $confirm_password && $email_user != $email ){
				move_uploaded_file($image_tmp, "images/customer_images/$image");
				$run_insert = mysqli_query($conn,"insert into user (ip_address,name,email,password,country,city,contact,user_address,image) values ('$ip','$name','$email','$hash_password','$country','$city','$contact','$address','$image')");
				echo "<script>alert('Welcome to shopping')</script>";
				if ($run_insert) {
					$sel_user = mysqli_query($conn,"select * from user where email = '$email'");
					$row_user = mysqli_fetch_assoc($sel_user);
					$_SESSION['user_id'] = $row_user['id'];
					$_SESSION['role'] = $row_user['role'];

				}
				$run_cart = mysqli_query($conn,"select * from cart where ip_address = '$ip'");
				$check_cart = mysqli_num_rows($run_cart);

				if ($check_cart == 0) {
					$_SESSION['email'] = $email;
					echo "<script>alert('Account has been create successfully!')</script>";
					echo "<script>window.open('customer/my_account.php','_self')</script>";
				}
				else{
					$_SESSION['email'] = $email;
					echo "<script>alert('Account has been create successfully!')</script>";
					echo "<script>window.open('checkout.php','_self')</script>";
				}


			}



		}
	}



 ?>

<?php include('includes/footer.php'); ?>