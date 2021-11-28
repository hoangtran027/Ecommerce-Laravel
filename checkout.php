<?php 
	include ('includes/header.php');
 ?>
		<div class="container" style="margin-top: 40px;">
			<div class="row">
				<?php 
					if (!isset($_SESSION['user_id'])) {
						include('login.php');
					}
					else{
						include('payment.php');
					}
				 ?>
			</div>
		</div>
	
<?php include('includes/footer.php'); ?>