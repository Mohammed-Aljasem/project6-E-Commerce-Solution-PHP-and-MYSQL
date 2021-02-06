<?php

session_start();
    if (isset($_SESSION["user_id"])) {
      $user_id=$_SESSION["user_id"];
    }else {
        header("location:login.php");
    }
    require("includes/db_connection.php");
    require("includes/public_header.php");

?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product-list.php">Products</a></li>
                    <li class="breadcrumb-item active">Wishlist</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Wishlist Start -->
        <div class="wishlist-page">
            <div class="container-fluid">
                <div class="wishlist-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Add to Cart</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                    <?php  
                                    $query="SELECT * FROM  wish_list  INNER JOIN products  
                                    on products.product_id = wish_list.product_id where user_id=$user_id";
                                    $result=mysqli_query($conn,$query);
                                    while($row=mysqli_fetch_assoc($result)){
                                      $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                                      $image_result = mysqli_query($conn, $query1);
                                      $image_row = mysqli_fetch_assoc($image_result);
                                    $after_discount_total = $row['product_price']-($row['product_price']*$row['discount_per']/100);
                                    echo ' <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="../images/'.$image_row['image_name'].'" alt="Image"></a>
                                            <p>'.$row['product_name'].'</p>
                                        </div>
                                    </td>
                                    <td>'.$after_discount_total.'</td>
                                    <td><a href="add_to_cart.php?id='.$row["product_id"].'&price='.$after_discount_total.'"><button class="btn-cart">Add to Cart</button></a></td>
                                    <td><a href="delete_wish.php?id='.$row["product_id"].'"><button><i class="fa fa-trash"></i></button></a></td>
                                </tr>';
                                    
                                    
                                    }?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Wishlist End -->
<?php
    require("includes/public_footer.php");
?>