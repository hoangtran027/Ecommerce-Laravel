<?php 
	include ('includes/header.php');
 ?>
		<div class="container" style="margin-top: 40px;">
			<div class="row">
			<div class="col-sm-3">
				<ul class="nav flex-column">
				  <li style="padding: 12px 0;">
				  <div class="btn-group dropright">
					  <button type="button" class="btn" style="background: #fff;">
					    Categories
					  </button>
					  <button type="button" class="btn dropdown-toggle dropdown-toggle-split" style="background: #fff; color: #000;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="sr-only">Toggle Dropright</span>
					  </button>
					  <div class="dropdown-menu">
					    <!-- Dropdown menu links -->
						  <?php
								getCats();
							 ?>
						</div>
					</div>
				  </li>
				  <li style="padding: 12px 0;">
				  <div class="btn-group dropright">
					  <button type="button" class="btn" style="background: #fff;">
					    Brands
					  </button>
					  <button type="button" class="btn dropdown-toggle dropdown-toggle-split" style="background: #fff; color: #000;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="sr-only">Toggle Dropright</span>
					  </button>
					  <div class="dropdown-menu">
					    <!-- Dropdown menu links -->

					    <?php
							getBrand();
							 ?>
					  </div>
					</div>
				  </li>
				</ul>
			</div>
			<div class="col-sm-9">	
				<div class="card-deck" style="padding:15px 0;">
					<?php 
						if (isset($_SESSION['customer_email'])) {
							
						}
						else{

						}

					 ?>
					<form action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
						<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">Remove</th>
					      <th scope="col">Product</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Price</th>
					      <th scope="col"></th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php 
					    	$total =0;
							$ip = get_ip();
							$run_cart = mysqli_query($conn,"select * from cart where ip_address = '$ip'");
							while ($row = mysqli_fetch_assoc($run_cart)) {
								$product_id = $row['product_id'];
								$result_product = mysqli_query($conn,"select * from products where product_id = '$product_id'");
								while($row2 = mysqli_fetch_assoc($result_product)){
									$product_price = array($row2['product_price']);
									$product_title = $row2['product_title'];
									$product_image = $row2['product_image'];
									$sing_price = $row2['product_price'];
									$values = array_sum($product_price);

									$run_qty = mysqli_query($conn,"select * from cart where product_id = '$product_id'");
									$row_qty = mysqli_fetch_assoc($run_qty);
									$qty = $row_qty['quantity'];
									$values_qty = $values*$qty;
									$total += $values_qty;
					     ?>
					     <tr>
					     <th>1</th>
					      <td><?php echo $product_title; ?><br>
					      	<img src="admin/images/product_image/<?php echo $product_image?>" width="100" height="100">
					      </td>
					      <td><input type="text" size="4" name="qty" value="<?php echo $qty; ?>"></td>
					      <th><?php echo $sing_price; ?></th>
					      <th><input type="checkbox" name="remove[]" value="<?php echo $product_id; ?>"></th>
					    </tr>
					<?php }} ?>
						<tr>
					     <th>Total Items:<?php total_item(); ?> </th>
					      <td></td>
					      <td></td>
					      <th scope="row">Total Price : $<?php  total_price();?></th>
					    </tr>

					    <tr>
					    	<td></td>
					      <th><input type="submit" name="update_cart" value="Update cart"></th>
					      <td><input type="submit" name="continue" value="Continue shopping"></td>
					      <td><button><a href="checkout.php" >Check Out</a></button></td>
					    </tr>
					  </tbody>
					</table>
					</form>

					<?php 
						if (isset($_POST['remove'])) {
							foreach($_POST['remove'] as $remove_id) {
								$run_delete = mysqli_query($conn,"delete from cart where product_id ='$remove_id' AND ip_address = '$ip'");
								if ($run_delete) {
									echo "<script>window.open('cart.php','_self')</script>";
								}
							}
						}

						if (isset($_POST['continue'])) {
							echo "<script>window.open('index.php','_self')</script>";
						}

					 ?>


				</div>

			</div>
		</div>
		</div>
<?php include('includes/footer.php'); ?>