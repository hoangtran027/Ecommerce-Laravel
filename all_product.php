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
						if(!isset($_GET['cat'])) {
						if (!isset($_GET['brand'])) {
						$get_pro = "select * from products LIMIT 0,3";
						$run_pro = mysqli_query($conn,$get_pro);
						while ($row_pro = mysqli_fetch_assoc($run_pro)) {
							$product_id = $row_pro['product_id'];
							$product_cat = $row_pro['product_cat'];
							$product_brand = $row_pro['product_brand'];
							$product_title = $row_pro['product_title'];
							$product_desc = $row_pro['product_desc'];
							$product_price = $row_pro['product_price'];
							$product_image = $row_pro['product_image'];

							echo "
								<div class='card'>
								    <img class='card-img-top' src='admin/images/product_image/$product_image' alt='Card image cap' width='180' height='180'>
								    <div class='card-body'>
								      <h5 class='card-title'>$product_title</h5>
								      <p class='card-text'>$product_desc</p>
								      <p class='card-text'><small class='text-muted'>Last updated 3 mins ago</small></p>
								      <a href='detail.php?pro_id=$product_id' class='btn btn-outline-dark'>More Detail</a>
								      <a href='index.php?add_cart=$product_id' class='btn btn-outline-danger'>Add to Cart</a>
								      
								    </div>
								  </div>

							";
								}
							}
						}
					 ?>

					 <?php 	
					 	get_pro_by_cat_id();
					  ?>

					  <?php 	
					 	get_pro_by_brand_id();
					  ?>					 
				</div>

			</div>
		</div>
		</div>
	
<?php include('includes/footer.php'); ?>