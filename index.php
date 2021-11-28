<?php 
	include ('includes/header.php');
 ?>
		<div class="container" style="margin-top: 40px;">
			<div class="row">
				<?php 
					if (!isset($_GET['action'])) {
				 ?>
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

			<?php 
				cart();
			 ?>

			<div class="col-sm-9">	
				<div class="card-deck" style="padding:15px 0;">
					<?php 
						getPro();
					 ?>

					 <?php 	
					 	get_pro_by_cat_id();
					  ?>

					  <?php 	
					 	get_pro_by_brand_id();
					  ?>
					  
				</div>
			</div>
		<?php } else{ ?>
		<?php 
			include ('login.php');
		}
		 ?>

		</div>
		</div>
	
<?php include('includes/footer.php'); ?>