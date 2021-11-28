<form action="" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" required>
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <label class="form-check-label" for="gridCheck">
        <span>Don't have account</span>
        <a href="register.php">Register Here</a>
      </label>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <label class="form-check-label" for="gridCheck">
        <a href="checkout.php?forgot_pass">Forgot Password</a>
      </label>
    </div>
  </div>
  <button type="submit" name="login" class="btn btn-primary">Login</button>
</form>

<?php 
  if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $run_login = mysqli_query($conn,"select * from user where password ='$password' AND email ='$email'");
    $check_login = mysqli_num_rows($run_login);
    $row_login = mysqli_fetch_assoc($run_login);


    if ($check_login == 0) {
      echo "<script>alert('password or email is incorrect , please try again')</script>";
      exit();
    }
    $ip = get_ip();
    $run_cat = mysqli_query($conn,"select * from cart where ip_address ='$ip'");
    $check_cart = mysqli_num_rows($run_cat);


    if ($check_login >0 AND $check_cart == 0) {
      $_SESSION['user_id'] = $row_login['id'];
      $_SESSION['role'] = $row_login['role'];

      $_SESSION['email'] = $email;
      echo "<script>alert('You has logged in successfully')</script>";
      echo "<script>window.open('myaccount.php','_self')</script>";
    }

    else{
      $_SESSION['user_id'] = $row_login['id'];
      $_SESSION['role'] = $row_login['role'];
      $_SESSION['email'] = $email;
      echo "<script>alert('You has logged in successfully')</script>";
      echo "<script>window.open('checkout.php','_self')</script>";

    }
  }

 ?>

 