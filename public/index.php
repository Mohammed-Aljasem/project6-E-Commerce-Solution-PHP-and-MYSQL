<?php
    require("includes/db_connection.php");
    require("includes/public_header.php");
?>

<!-- alert -->
<!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> -->
<!-- end alert -->

<!-- Main Slider Start -->
<div class="header">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="header-slider normal-slider">
                    
                    <div class="header-slider-item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/home/01142021/HP-KV_Galaxy-Buds-Pro_D-new.JPG?$ORIGIN_JPG$"
                            alt="Slider Image" />
                        <div class="header-slider-caption" style=' height: 10rem;'>
                            <p>Super tech deals</br>
                                Geek out over smart deals up to 40% off</p>
                            <a class="btn" href="product-list.php"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                        </div>
                    </div>
                    <div class="header-slider-item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/home/012821/hp-ot-d.jpg?$ORIGIN_JPG$"
                            alt="Slider Image" />
                        <div class="header-slider-caption" style=' height: 10rem;'>
                              <p>  You hate your iphone device ? it is fine we have got a big sale on android
                                devices you can change your phone any time and with a cheap price.</p>
                            <a class="btn" href="product-list.php"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->  
        
        <!-- Brand Start -->
        <div class="brand">
            <div class="container-fluid">
                <div class="brand-slider">
                    <?php
                     $query="SELECT sub_cat_image FROM sub_cat";
                     $result=mysqli_query($conn,$query);
                     while($row=mysqli_fetch_assoc($result)){
                         echo '<div class="brand-item"><img src="../images/'.$row['sub_cat_image'].'" alt=""></div>';}
                    ?>
    
                </div>
            </div>
        </div>
        <!-- Brand End -->      
        
        <!-- Feature Start-->
        <div class="feature">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fas fa-money-bill-wave"></i>
                            <h2>Cash on Delivery</h2>
                            <p>
                                You can pay for your orders when it receives at your door steps.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-truck"></i>
                            <h2>Worldwide Delivery</h2>
                            <p>
                                We can deliver it anywhere and anytime to you!
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-sync-alt"></i>
                            <h2>90 Days Return</h2>
                            <p>
                                You don't like what you bought ? it is fine there is 90 Days return grantee.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-comments"></i>
                            <h2>24/7 Support</h2>
                            <p>
                                Don't even worry, our support team is here 24/7 at your service.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End-->      
        
        <!-- Category Start-->
        <div class="category">
            <div class="container-fluid">
                <div class="row">

                <?php  
            $query="SELECT * FROM categories";
            $result=mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($result)){
                echo '
                    <div class="col-md-3">
                        <div class="category-item ch-400">
                            <img src="../images/'.$row["category_image"].' "/>
                            <a class="category-name" href="subcategory.php?id='.$row["category_id"].'">
                                <p><h1 style="color: white;">'.$row["category_name"].'</h1></p>
                            </a>
                        </div>
                    </div>';
                    }?>
                </div>
            </div>
        </div>
        <!-- Category End-->       
        
        <!-- Call to Action Start -->
        <div class="call-to-action">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1>Call us for any question</h1>
                    </div>
                    <div class="col-md-6">
                        <a href="tel:0123456789">+962-777-7777</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->       

        
<!-- Hot Product Start -->
<div class='featured-product product'>
    <div class='container-fluid'>
        <div class='section-header'>
            <h1>Hot Product</h1>
        </div>
        <div class='nrow alig-items-center product-slider product-slider-4'>
            <?php 
                    $query = "SELECT * FROM products WHERE type = 'hotproduct'";

                   $result = mysqli_query($conn, $query); 
                           while ($row = mysqli_fetch_assoc($result)){
                               $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                               $image_result = mysqli_query($conn, $query1);
                               $image_row = mysqli_fetch_assoc($image_result);
                            $old_price = $row['product_price'];
                              $percent = $row['discount_per'];
                            $new_price = $old_price-(($old_price*$percent)/100); 
                if($percent != 0){

                echo "<div class='col-lg-3'>
                    <div class='product-item'>
                         <div class='product-title'>
                            <a href='#'>".$row['product_name']."</a>
                           </div>
                           <div class='product-image'>
                              <a href='product-detail.html'>
                                 <img src='../images/".$image_row['image_name']."' alt='Product Image'  >
                               </a>
                               <div class='product-action'>
                               <a href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."'><i class='fa fa-cart-plus'></i></a>
                               <a href='add_wish.php?id=".$row["product_id"]."'><i class='fa fa-heart'></i></a>
                               <a href='product.php?id=".$row["product_id"]."&sub=".$row["sub_cat_id"]."'><i class='fa fa-search'></i></a>
                           </div>
                           </div>
                          <div class='product-price' style=' position:relative; '>
                         <h3><span>JD</span> ".$new_price." </h3><span style = 'text-decoration:line-through; color:#a5a5a7;'><span>JD</span> ".$old_price."</span>
                          <a class='btn' href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
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
                                 <img src='../images/".$image_row['image_name']."' alt='Product Image' >
                               </a>
                               <div class='product-action'>
                               <a href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."'><i class='fa fa-cart-plus'></i></a>
                               <a href='add_wish.php?id=".$row["product_id"]."'><i class='fa fa-heart'></i></a>
                               <a href='product.php?id=".$row["product_id"]."&sub=".$row["sub_cat_id"]."'><i class='fa fa-search'></i></a>
                           </div>
                           </div>
                          <div class='product-price' style=' position:relative; '>
                         <h3><span>JD</span> ".$new_price." </h3>
                          <a class='btn' href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
                           </div>
                       </div>
                   </div>";

            }
            
            }

                 ?>
        </div>
    </div>
</div>
<!-- Hot Product End -->

<!-- line Start -->
<div class="newsletter">
    <div class="container-fluid"></div>
</div>
<!-- line End -->

<!-- On Sale Product -->
<div class="recent-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>On Sale Product</h1>
        </div>
        
        <div class="row align-items-center product-slider product-slider-4">
            <?php 
                    $query  = "SELECT * FROM products WHERE discount_per NOT IN (0)";

                          $result = mysqli_query($conn, $query); 
                          while ($row = mysqli_fetch_assoc($result)){
                            $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                            $image_result = mysqli_query($conn, $query1);
                            $image_row = mysqli_fetch_assoc($image_result);

                            $old_price = $row['product_price'];
                            $percent = $row['discount_per'];
                            $new_price = $old_price-(($old_price*$percent)/100);
                         
                            echo "<div class='col-lg-3'>
                            <div class='product-item'>
                                 <div class='product-title'>
                                    <a href='#'>".$row['product_name']."</a>
        
                                   </div>
                                   <div class='product-image'>
                                      <a href='product-detail.html'>
                                         <img src='../images/".$image_row['image_name']."' alt='Product Image'  >
                                       </a>
                                       <div class='product-action'>
                                       <a href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."'><i class='fa fa-cart-plus'></i></a>
                                       <a href='add_wish.php?id=".$row["product_id"]."'><i class='fa fa-heart'></i></a>
                                       <a href='product.php?id=".$row["product_id"]."&sub=".$row["sub_cat_id"]."'><i class='fa fa-search'></i></a>
                                   </div>
                                   </div>
                                  <div class='product-price' style=' position:relative; '>
                                  <h3><span>JD</span> ".$new_price." </h3><span style = 'text-decoration:line-through; color:#a5a5a7;'><span>JD</span> ".$old_price."</span>
                                  <a class='btn' href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
                                   </div>
                               </div>
                           </div>"; };
                    ?>
        </div>
    </div>
</div>
<!-- line Start -->
<div class="newsletter">
    <div class="container-fluid"></div>
</div>
<!-- line End -->

<!-- On sale Product End -->

<!-- Featured Product Start -->
<div class='featured-product product'>
    <div class='container-fluid'>
        <div class='section-header'>
            <h1>Featured Product</h1>
        </div>
        <div class='nrow alig-items-center product-slider product-slider-4'>
            <?php 
                    $query = "SELECT * FROM products WHERE type = 'featuredproduct'";

                   $result = mysqli_query($conn, $query); 
                           while ($row = mysqli_fetch_assoc($result)){
                            $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                            $image_result = mysqli_query($conn, $query1);
                            $image_row = mysqli_fetch_assoc($image_result);

                            $old_price = $row['product_price'];
                              $percent = $row['discount_per'];
                            $new_price = $old_price-(($old_price*$percent)/100); 
                if($percent != 0){

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
                               <a href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."'><i class='fa fa-cart-plus'></i></a>
                               <a href='add_wish.php?id=".$row["product_id"]."'><i class='fa fa-heart'></i></a>
                               <a href='product.php?id=".$row["product_id"]."&sub=".$row["sub_cat_id"]."'><i class='fa fa-search'></i></a>
                           </div>
                           </div>
                          <div class='product-price' style=' position:relative; '>
                          <h3><span>JD</span> ".$new_price." </h3><span style = 'text-decoration:line-through; color:#a5a5a7;'><span>JD</span> ".$old_price."</span>
                          <a class='btn' href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
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
                                 <img src='../images/".$image_row['image_name']."' alt='Product Image' >
                               </a>
                               <div class='product-action'>
                               <a href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."'><i class='fa fa-cart-plus'></i></a>
                               <a href='add_wish.php?id=".$row["product_id"]."'><i class='fa fa-heart'></i></a>
                               <a href='product.php?id=".$row["product_id"]."&sub=".$row["sub_cat_id"]."'><i class='fa fa-search'></i></a>
                           </div>
                           </div>
                          <div class='product-price' style=' position:relative; '>
                         <h3><span>JD</span> ".$new_price." </h3>
                          <a class='btn' href='add_to_cart.php?id=".$row["product_id"]."&price=".$new_price."' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
                           </div>
                       </div>
                   </div>";

            }
            
            }

                 ?>
        </div>
    </div>
</div>
<!-- Featured Product End -->

<!-- Review Start -->
<div class="review">
    <div class="container-fluid">
        <div class="row align-items-center review-slider normal-slider">
            <div class="col-md-6">
                <div class="review-slider-item">
                    <div class="review-img">
                        <img src="https://avatars.githubusercontent.com/u/8956330?s=460&u=c95e024d171e8d081502da6a831d52e2bb218d35&v=4"
                            alt="Image">
                    </div>
                    <div class="review-text">
                        <h2>Alaa Mohammad</h2>
                        <h3>Customer</h3>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>
                            Great shop - staff very friendly and knowledgeable. Wide array of products and good price
                            range 👍 will be sure to revisit</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="review-slider-item">
                    <div class="review-img">
                        <img src="https://avatars.githubusercontent.com/u/3540856?s=460&u=57dd783bd0d954a6e4724a0db10a5de975dc94ae&v=4"
                            alt="Image">
                    </div>
                    <div class="review-text">
                        <h2>Salameh Yasin</h2>
                        <h3>Customer</h3>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>
                            Fantastic local shop. As a family we try to support local. This is our go to shop for any
                            tech needs. Staff were helpful in supplying the correct leads and advising me on how to
                            network my house.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="review-slider-item">
                    <div class="review-img">
                        <img src="https://avatars.githubusercontent.com/u/51743814?s=460&u=3142a01a71848e58798c21f18f8c894fb75d8c43&v=4"
                            alt="Image">
                    </div>
                    <div class="review-text">
                        <h2>Ayham Zaid</h2>
                        <h3>Customer</h3>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>
                            Great service. Took time to explain the options. Very professional yet friendly. Highly
                            recommend to anyone
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Review End -->
       
<?php
    require("includes/public_footer.php");
?>
