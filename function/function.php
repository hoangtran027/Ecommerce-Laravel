<?php 
	$conn = mysqli_connect("localhost","root","","electronic-shop");


function total_item(){
	global $conn;
	$ip = get_ip();
	$sql = "select * from cart where ip_address = '$ip'";
	$res = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($res);
	echo $count;
}

function total_price(){
	global $conn;
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
		}
	}
	echo $total;
}

function cart(){
	global $conn;
	if (isset($_GET['add_cart'])) {
		$product_id = $_GET['add_cart'];
		$ip = get_ip();
		$run_check_pro = mysqli_query($conn,"select * from cart where product_id='$product_id'");
		$count = mysqli_num_rows($run_check_pro);
		if ($count >0) {
			echo "";
		}
		else{
			$fetch_pro = mysqli_query($conn,"select * from products where product_id='$product_id'");
			$fetch_pro = mysqli_fetch_assoc($fetch_pro);
			$pro_title = $fetch_pro['product_title'];

			$run_insert_pro = mysqli_query($conn,"insert into cart (product_id,product_title,ip_address) values ('$product_id','$pro_title','$ip')");
			echo "<script>window.open('index.php','_self')</script>";

		}
	}
}


function get_ip(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



function getCats(){
	global $conn;
	$get_cats ="select * from categories";		
	$run_cats = mysqli_query($conn, $get_cats);
	
	while($row_cats=mysqli_fetch_array($run_cats)){
	    $cat_id = $row_cats['cat_id'];									
		$cat_title = $row_cats['cat_title'];
		echo "
			<a class='dropdown-item' href='index.php?cat=$cat_id'>$cat_title</a>
		";
	}
}	

function getBrand(){
	global $conn;
	$get_brand ="select * from brands";
		
	$run_brand = mysqli_query($conn, $get_brand);
	
	while($row_cats=mysqli_fetch_array($run_brand)){
	    $brand_id = $row_cats['brand_id'];									
		$brand_title = $row_cats['brand_title'];
		echo "
			<a class='dropdown-item' href='index.php?brand=$brand_id'>$brand_title</a>
		";
	}
}


function getPro(){
	if(!isset($_GET['cat'])) {
		if (!isset($_GET['brand'])) {
		global $conn;
		$get_pro = "select * from products order by RAND() LIMIT 0,3";
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
	}


function get_pro_by_cat_id(){
	global $conn;
	if (isset($_GET['cat'])) {
		$cat_id = $_GET['cat'];
		$get_cat_pro = "select * from products where product_cat = '$cat_id' LIMIT 3";
		$run_cat_pro = mysqli_query($conn,$get_cat_pro);
		$count_cats = mysqli_num_rows($run_cat_pro);
		if ($count_cats==0) {
			echo "<script>alert('No product found in category')</script>";
		}
		while ($row_cat_pro = mysqli_fetch_assoc($run_cat_pro)) {
		$product_id = $row_cat_pro['product_id'];
	$product_cat = $row_cat_pro['product_cat'];
	$product_brand = $row_cat_pro['product_brand'];
	$product_title = $row_cat_pro['product_title'];
	$product_desc = $row_cat_pro['product_desc'];
	$product_price = $row_cat_pro['product_price'];
	$product_image = $row_cat_pro['product_image'];

	echo "
		<div class='card'>
		    <img class='card-img-top' src='admin/images/product_image/$product_image' alt='Card image cap' width='180' height='180'>
		    <div class='card-body'>
		      <h5 class='card-title'>$product_title</h5>
		      <p class='card-text'>$product_desc</p>
		      <p class='card-text'><small class='text-muted'>Last updated 3 mins ago</small></p>
		      <a href='detai.php?pro_id=$product_id' class='btn btn-outline-dark'>More Detail</a>
		      <a href='index.php?add_cart=$product_id' class='btn btn-outline-danger'>Add to Cart</a>
		      
		    </div>
		  </div>

	";
		}
	}
}

function get_pro_by_brand_id(){
	global $conn;
	if (isset($_GET['brand'])) {
 		$brand_id = $_GET['brand'];
 		$get_brand_pro = "select * from products where product_brand = '$brand_id' LIMIT 3";
 		$run_brand_pro = mysqli_query($conn,$get_brand_pro);
 		$count_brand = mysqli_num_rows($run_brand_pro);
 		if ($count_brand==0) {
 			echo "<script>alert('No product found in brands')</script>";
 		}
 		while ($row_brand_pro = mysqli_fetch_assoc($run_brand_pro)) {
 		$product_id = $row_brand_pro['product_id'];
		$product_cat = $row_brand_pro['product_cat'];
		$product_brand = $row_brand_pro['product_brand'];
		$product_title = $row_brand_pro['product_title'];
		$product_desc = $row_brand_pro['product_desc'];
		$product_price = $row_brand_pro['product_price'];
		$product_image = $row_brand_pro['product_image'];

		echo "
			<div class='card'>
			    <img class='card-img-top' src='admin/images/product_image/$product_image' alt='Card image cap' width='180' height='180'>
			    <div class='card-body'>
			      <h5 class='card-title'>$product_title</h5>
			      <p class='card-text'>$product_desc</p>
			      <p class='card-text'><small class='text-muted'>Last updated 3 mins ago</small></p>
			      <a href='detai.php?pro_id=$product_id' class='btn btn-outline-dark'>More Detail</a>
			      <a href='index.php?add_cart=$product_id' class='btn btn-outline-danger'>Add to Cart</a>
			      
			    </div>
			  </div>

		";
 		}
 	}


}



 ?>