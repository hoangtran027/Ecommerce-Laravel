<?php 
	include ('includes/header.php');
 ?>
		<div class="container" style="margin-top: 40px;">
			<?php 
				if (isset($_SESSION['user_id'])) {
			 ?>
			<div class="row">
				<div class="col-sm-9">
					<?php 
						if (isset($_GET['action'])) {
							$action = $_GET['action'];
						}
						else{
							$action = '';
						}
						switch($action) {
							case 'my_order':
								echo $action;
								break;
							case 'edit_account':
								include ('user/edit_account.php');
								break;
							case 'change_email':
								include ('user/change_email.php');
								break;
							case 'change_picture':
								include ('user/user_profile_picture.php');
								break;
							case 'change_password':
								include ('user/change_password.php');
								break;	
							default:
								echo "Do something";
								break;
						}

					 ?>
				</div>
				<div class=" col-sm-3">
					<div class="dropdown-menu" style="display: block;top: 10%;">
					  <a class="dropdown-item" href="myaccount.php?action=my_order">My Order</a>
					  <a class="dropdown-item" href="myaccount.php?action=edit_account">Edit Account</a>
					  <a class="dropdown-item" href="myaccount.php?action=change_email">Change Email</a>
					  <a class="dropdown-item" href="myaccount.php?action=change_picture">Change picture</a>
					  <a class="dropdown-item" href="myaccount.php?action=change_password">Change password</a>
					  <a class="dropdown-item" href="logout.php">LogOut</a>
					</div>
				</div>
			</div>
			<?php 
				}else{
			 ?>
			 <h1>Account Setting page</h1>
		<h5><a href="index.php?action=login">Login</a>to your account</h5>
			 <?php 
			 	}
			  ?>
		</div>

<?php include('includes/footer.php'); ?>