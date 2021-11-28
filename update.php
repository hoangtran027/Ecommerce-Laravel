<?php 
	$id = $_GET['id'];
	$edit_product = mysqli_query($conn,"select * from products where product_id='$id'");
	$fetch_edit = mysqli_fetch_assoc($edit_product);

 ?>
    	<form action="" method="POST" style="padding:12px;width: 80%;" enctype="multipart/form-data">
    		<div class="form-group">
			    <label for="inputAddress">Product Title</label>
			    <input type="text" class="form-control" id="inputAddress" value="<?php echo $fetch_edit['product_title']; ?>" name="product_title">
		  	</div>
		  	<div class="form-group">
			    <label for="inputAddress">Product Description</label>
			    <textarea class="form-control" name="product_desc" rows="4" cols="50" ><?php echo $fetch_edit['product_desc']; ?></textarea>
		  	</div>
		  	<div class="form-group">
			    <label for="inputAddress">Product Price</label>
			    <input type="text" class="form-control" id="inputAddress" value="<?php echo $fetch_edit['product_price'] ?>" name="product_price" required>
		  	</div>
		  	<div class="form-group">
			    <label for="">Product Image</label>
			    <input type="file" class="form-control" name="product_image">
			    <div class="edit_image">
			    	<img src="images/product_image/<?php echo $fetch_edit['product_image'];?>" style="width: 100; height: 70;">
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="">Product Keywords</label>
			    <input type="text" class="form-control" name="product_keywords" value="<?php echo $product_keywords ?>;">
		  	</div>
		  	<div class="form-group">
			    <label for="inputAddress">Category</label>
			     <select name="product_cat">
			     	<?php 
								$sql = "SELECT * FROM categories";
								$res = mysqli_query($conn,$sql);
									while($row = mysqli_fetch_assoc($res)){
										$cat_id = $row['cat_id'];
										$cat_title = $row['cat_title'];
										if ($fetch_edit['product_cat'] == $cat_id) {
											echo "<option value='<?php echo $fetch_edit['product_cat']; ?>' select><?php echo $cat_title; ?></option>";
										}
										else{
											echo "<option value='<?php echo $cat_id; ?>'><?php echo $cat_title; ?></option>";
										}
										?>
									}

						?>
				</select>
		  	</div>
		  	<div class="form-group">
			    <label for="inputAddress">Brands</label>
			     <select name="product_brand">
			     	<?php 
								$sql2 = "SELECT * FROM brands";
								$res2 = mysqli_query($conn,$sql2);
									while($row2 = mysqli_fetch_assoc($res2)){
										$brand_id = $row2['brand_id'];
										$brand_title = $row2['brand_title'];

										if ($fetch_edit['product_cat'] == $brand_id) {
											echo "<option value='<?php echo $fetch_edit['product_cat']; ?>' select><?php echo $brand_title; ?></option>";
										}
										
								else{
									echo "<option value='<?php echo $brand_id; ?>'><?php echo $brand_title; ?></option>";

								}
						?>
				</select>
		  	</div>
		  	  
		  <input type="submit" name="submit" class="btn btn-primary" value="Update Product">
		</form>

<?php 
	if (isset($_POST['submit'])) {
		$product_title = $_POST['product_title'];
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];

		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];

		if (!empty($_FILES['product_image']['name'])) {
			if (move_uploaded_file($product_image_tmp, "images/product_image/$product_image");) {
				$update_product = mysqli_query($conn,"update products set product_cat='$product_cat',product_brand = '$product_brand' ,product_title = '$product_title' , product_price ='$product_price',product_desc = '$product_desc' ,product_image = '$product_image' , product_keywords = '$product_keywords' where product_id = '$id");
			}
		}else{
			$update_product = mysqli_query($conn,"update products set product_cat='$product_cat',product_brand = '$product_brand' ,product_title = '$product_title' , product_price ='$product_price',product_desc = '$product_desc' , product_keywords = '$product_keywords' where product_id = '$id");
		}		

		if ($update_product) {
			echo "<script>alert('product was updare successfully!')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}


	}

 ?>



