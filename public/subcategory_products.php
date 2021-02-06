<?php
    require("includes/db_connection.php");
    require("includes/public_header.php");
    $id=$_GET['id'];
?>

  
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product-list.php">Products</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Product List Start -->
        <div class="product-view">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-view-top">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="product-search">
                                                <input type="email" value="Search">
                                                <button><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="product-short">
                                                <div class="dropdown">
                                                    <div class="dropdown-toggle" data-toggle="dropdown">Product short by</div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item">Newest</a>
                                                        <a href="#" class="dropdown-item">Popular</a>
                                                        <a href="#" class="dropdown-item">Most sale</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="product-price-range">
                                                <div class="dropdown">
                                                    <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item">$0 to $50</a>
                                                        <a href="#" class="dropdown-item">$51 to $100</a>
                                                        <a href="#" class="dropdown-item">$101 to $150</a>
                                                        <a href="#" class="dropdown-item">$151 to $200</a>
                                                        <a href="#" class="dropdown-item">$201 to $250</a>
                                                        <a href="#" class="dropdown-item">$251 to $300</a>
                                                        <a href="#" class="dropdown-item">$301 to $350</a>
                                                        <a href="#" class="dropdown-item">$351 to $400</a>
                                                        <a href="#" class="dropdown-item">$401 to $450</a>
                                                        <a href="#" class="dropdown-item">$451 to $500</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  
                            <?php  
                            $query="SELECT * FROM products WHERE sub_cat_id=$id ";
                            $result=mysqli_query($conn,$query);
                            
                            while($row=mysqli_fetch_assoc($result)){
                                $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                                $image_result = mysqli_query($conn, $query1);
                                $image_row = mysqli_fetch_assoc($image_result);
                                $after_discount_total = $row['product_price']-($row['product_price']*$row['discount_per']/100);
                                if($row['discount_per'] != 0){

                                    echo "<div class='col-lg-3'>
                                        <div class='product-item'>
                                             <div class='product-title'>
                                                <a href='#'>".$row['product_name']."</a>
                                               </div>
                                               <div class='product-image'>
                                                  <a href='product-detail.html'>
                                                     <img src='../images/".$image_row['image_name']."' alt='Product Image' >
                                                   </a>
                                                   <div class='product-action'>
                                                   <a href='add_to_cart.php?id=".$row["product_id"]."&price=".$after_discount_total."'><i class='fa fa-cart-plus'></i></a>
                                                   <a href='add_wish.php?id=".$row["product_id"]."'><i class='fa fa-heart'></i></a>
                                                   <a href='product.php?id=".$row["product_id"]."&sub=".$row["sub_cat_id"]."'><i class='fa fa-search'></i></a>
                                               </div>
                                               </div>
                                              <div class='product-price' style=' position:relative; '>
                                             <h3><span>JD</span> ".$after_discount_total." </h3><span style = 'text-decoration:line-through; color:#a5a5a7;'><span>JD</span> ".$row['product_price']."</span>
                                              <a class='btn' href='' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
                                               </div>
                                           </div>
                                       </div>";
                                    } 
                    
                                else{
                    
                                    echo "<div class='col-lg-3'>
                                        <div class='product-item'>
                                             <div class='product-title'>
                                                <a href='#'>".$row['product_name']."</a>
                                               </div>
                                               <div class='product-image'>
                                                  <a href='product-detail.html'>
                                                     <img src='../images/".$image_row['image_name']."' alt='Product Image'>
                                                   </a>
                                                   <div class='product-action'>
                                                   <a href='add_to_cart.php?id=".$row["product_id"]."&price=".$after_discount_total."'><i class='fa fa-cart-plus'></i></a>
                                                   <a href='add_wish.php?id=".$row["product_id"]."'><i class='fa fa-heart'></i></a>
                                                   <a href='product.php?id=".$row["product_id"]."&sub=".$row["sub_cat_id"]."'><i class='fa fa-search'></i></a>
                                               </div>
                                               </div>
                                              <div class='product-price' style=' position:relative; '>
                                             <h3><span>JD</span> ".$after_discount_total." </h3>
                                              <a class='btn' href='' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
                                               </div>
                                           </div>
                                       </div>";
                    
                                }
                            }?>

                        </div>
                        
                    </div>           
                    
                </div>
            </div>
        </div>
        <!-- Product List End -->  
        

<?php
    require("includes/public_footer.php");
?>
