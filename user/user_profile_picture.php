
<?php 
	$user_id = $_SESSION['user_id'];
	$select_user = mysqli_query($conn,"select * from user where id = '$user_id'");
	$fetch_user = mysqli_fetch_assoc($select_user);

 ?>
	<div class="container" style="margin-top: 40px;">
			<div class="row">
				<form action="" method="POST" enctype="multipart/form-data" style="width:80%;">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Image</label>
					    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="image" required>
					    <div>
					    	<img src="images/customer_images/<?php echo $fetch_user['image'] ?>" width="100" height="100">
					    </div>
					  </div>
					  
				  <button type="submit" name="change" class="btn btn-primary">Update</button>
				</form>

			</div>
		</div>

<?php 
	if (isset($_POST['change'])) {
			$image = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$target_file = "./images/customer_images/".$image;
			$uploadOk = 1;
			$message = '';
			$user_id = $_SESSION['user_id'];

			if ($_FILES['image']['size'] < 5098888) {

			if (file_exists($target_file)) {
				$uploadOk = 0;
				$message .= "sorry , file already exist";
			}
			else{
				if (move_uploaded_file($image_tmp, $target_file)) {
					$upload_image = mysqli_query($conn,"update user set image = '$image' where id='$user_id'");
					$message .= "the file " .basename($image)."has been uploaded";
				}
				else{
					$message .= "sorry , there was an error uploading your file";
				}
			}
		}
		else{
			$message .= "File max 5mb";
		}
	}


 ?>

	
</body>
</html>

<p style="color:red;">
	<?php if (isset($message)) {
		echo $message;
	} ?>
</p>