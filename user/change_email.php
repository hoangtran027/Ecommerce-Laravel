
<?php 
	$user_id = $_SESSION['user_id'];
	$select_user = mysqli_query($conn,"select * from user where id = '$user_id'");
	$fetch_user = mysqli_fetch_assoc($select_user);

 ?>
		<div class="container" style="margin-top: 40px;">
			<div class="row">
				<form action="" method="POST" enctype="multipart/form-data" style="width:80%;">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email</label>
					    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $fetch_user['email']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Password</label>
					    <input type="password" class="form-control" aria-describedby="emailHelp" placeholder="Enter Current Password" name="password" required>
					  </div>
				  <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
				</form>

			</div>
		</div>

<?php 
	if (isset($_POST['change_password'])) {
		$user_id = $_SESSION['user_id'];
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$hash_password = md5($password);

		if ($hash_password != $fetch_user['password']) {
			echo "<script>alert('Your password is wrong!!')</script>";
		}
		else{
			$update_email = mysqli_query($conn,"update user set email='$email' where id='$user_id'");
			if ($update_email) {
			echo "<script>alert('Update Successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";				
			}
		}

			
	}



 ?>


</body>
</html>