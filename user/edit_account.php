
<?php 
	$user_id = $_SESSION['user_id'];
	$select_user = mysqli_query($conn,"select * from user where id = '$user_id'");
	$fetch_user = mysqli_fetch_assoc($select_user);

 ?>
		<div class="container" style="margin-top: 40px;">
			<div class="row">
				<form action="" method="POST" enctype="multipart/form-data" style="width:80%;">
					<div class="form-group">
					    <label for="exampleInputEmail1">Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?php echo $fetch_user['name']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Country</label>
					    <?php include('edit_list_coutry.php'); ?>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">City</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="city" value="<?php echo $fetch_user['city']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Contact</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="contact" value="<?php echo $fetch_user['contact']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Address</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="address" value="<?php echo $fetch_user['user_address']; ?>">
					  </div>

				  <button type="submit" name="edit_account" class="btn btn-primary">Register</button>
				</form>

			</div>
		</div>

<?php 
	if (isset($_POST['edit_account'])) {
		if ($_POST['name'] != "" && $_POST['edit_country'] != "" && $_POST['contact'] != "") {
			$ip = get_ip();
			$name = $_POST['name'];
			$email = $_POST['email'];
			$country = $_POST['edit_country'];
			$contact = $_POST['contact'];
			$city = $_POST['city'];
			$address = $_POST['address'];	
			$user_id = $_SESSION['user_id'];

			$update_profile = mysqli_query($conn,"update user set name = '$name',country='$country',city='$city',contact='$contact', user_address='$address' where id = '$user_id'");
			if ($update_profile) {
				echo "<script>alert('Your update successfully')</script>";
				echo "<script>window.open(window.location.href,'_self')</script>";

			}


		}	
	}



 ?>


</body>
</html>