<?php
	session_start();
	require("includes/db_connection.php");
	$total_price=0;
	function calculate_total($price){
		$GLOBALS['total_price'] += $price;
		if($GLOBALS["total_price"] != 0){
			$_SESSION["total_price"]=$GLOBALS["total_price"];
		}
	}
// $_SESSION["user"]=1;

	if(isset($_POST["checkout"])){
        if(isset($_SESSION["user_id"])){
            if(isset($_SESSION["order_products"])){
                $user_id=$_SESSION["user_id"];
				$total = $_SESSION["total_price"];
				$query="INSERT INTO orders(user_id,order_total) VALUES($user_id,$total)";
				mysqli_query($conn,$query);

			$last_id = mysqli_insert_id($conn);
				foreach($_SESSION["order_products"] as $k =>$order){
                    // die(print_r($order));
                    $query2="INSERT INTO orders_products(order_id,product_id,user_id) VALUES($last_id,$k,$user_id)";
					mysqli_query($conn,$query2);
				
				}
				
                unset($_SESSION["order_products"]);
			header("location:index.php");
                
			}
		}
		else{
			header("location:login.php");
		}
		}
		require("includes/public_header.php");
		?>
 
        
        <!-- Breadcrumb Start -->

        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product-list.php">Product List</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                    <?php
						if(isset($_SESSION["order_products"])){
							foreach($_SESSION["order_products"] as $product =>$value){
								$query="SELECT * FROM products WHERE product_id=$product";
								$result=mysqli_query($conn,$query);
                                $row=mysqli_fetch_assoc($result);
                                $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                                $image_result = mysqli_query($conn, $query1);
                                $image_row = mysqli_fetch_assoc($image_result);
                                $after_discount_total = $row['product_price']-($row['product_price']*$row['discount_per']/100);
                                calculate_total($_SESSION["order_products"][$row["product_id"]]["total"]);
                                
                                echo'
                                    <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="../images/'.$image_row['image_name'].'" alt="Image"></a>
                                            <p>'.$row['product_name'].'</p>
                                        </div>
                                    </td>
                                    <td>'.$after_discount_total.'</td>
                                    <td>

                                    <form action="update_cart.php?id='.$row["product_id"].'&price='.$after_discount_total.'" method="post">
                                    
                                    <input name= "qyt" type="number" value="'.$_SESSION["order_products"][$row["product_id"]]["quantity"].'" min="1">
                                    <button type="submit" name="submit"><i class="fas fa-sync-alt"></i></button>
                                    </form>
                                    </td>
                                    <td>'.$_SESSION["order_products"][$row["product_id"]]["total"].'</td>
                                    <form action="delete_cart.php?id='.$row["product_id"].'" method="post">
                                    <td><button type="submit" name="delete"><i class="fa fa-trash"></i></button></td>
                                    </form>
                                </tr>
                                ';
                                
                            }
                            // print_r($_SESSION['qyt']);
                        }
						?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Cart Summary</h1>
                                            <p>Sub Total<span><?php echo $total_price;?></span></p>
                                            <p>Shipping Cost<span><?php $shipping = 2; echo $shipping;?></span></p>
                                            <h2>Grand Total<span><?php echo $total_price + $shipping; ?></span></h2>
                                        </div>
                                        <div class="cart-btn">
                                            
                                            <form action="" method="POST" >
                                            <!-- <button>Update Cart</button> -->
                                            <button class="btn btn-block" style="margin: 10px auto; "type="submit" name="checkout">Checkout</button>
                                             </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
        
<?php
    require("includes/public_footer.php");
?>