
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
					    <label for="exampleInputEmail1">Current Password</label>
					    <input type="password" class="form-control" aria-describedby="emailHelp" placeholder="Enter Password" name="password" required>
					  </div>
					   <div class="form-group">
					    <label for="exampleInputEmail1">New Password</label>
					    <input type="password" class="form-control" id="password_confirm1" aria-describedby="emailHelp" placeholder="Enter Confirm Password" required name="new_password">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Confirm Password</label>
					    <input type="password" class="form-control" id="password_confirm2" aria-describedby="emailHelp" placeholder="Enter Confirm Password" required name="confirm_password">
					    <p id="status_for_confirm_password"></p>
					  </div>

				  <button type="submit" name="change_password" class="btn btn-primary">Register</button>
				</form>

			</div>
		</div>

<?php 
	if (isset($_POST['change_password'])) {
		$password = trim($_POST['password']);
		$hash_password = md5($password);

		$new_password = trim($_POST['new_password']);
		$hash_new_password = md5($new_password);

		$confirm_password = trim($_POST['confirm_password']);
		$hash_confirm_password = md5($confirm_password);
		$user_id = $_SESSION['user_id'];
		$select_password = mysqli_query($conn,"select * from user where id = '$user_id' and password = '$hash_password'");
		$count_password = mysqli_num_rows($select_password);
		$fetch_password = mysqli_fetch_assoc($select_password);
		if ($count_password == 0) {
			echo "<script>alert('Your current password is wrong !')</script>";
		}
		elseif ($new_password != $confirm_password) {
			echo "<script>alert('Your password not match !')</script>";
		}
		else{
			$update = mysqli_query($conn,"update user set password='$hash_confirm_password' where id='$user_id'");
			if ($update) {
				echo "<script>alert('Your password update successfully!')</script>";
				echo "<script>window.open(window.location.href,'_self')</script>";
			}
			else{
				echo "<script>alert('databas query failed')</script>";
			}
		}
	}

 ?>

	
</body>
</html>