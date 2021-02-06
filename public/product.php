<?php
    require("includes/db_connection.php");
    require("includes/public_header.php");
    $id=$_GET['id'];
    $sub=$_GET['sub'];
    if (isset($_SESSION['user_id']) && isset($_SESSION['username']) ){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['username'];}
    
    if(isset($_POST['submit_review'])){
        $review_text = $_POST['review'];

        if(!empty($review_text)){

            
      $query="SELECT * FROM product_review WHERE user_id = $user_id AND product_id = $id";
      $result=mysqli_query($conn,$query);
      $row=mysqli_fetch_assoc($result);
      if (!$row){
        $query1="INSERT INTO product_review (product_id, user_id, user_name, review) 
        VALUES ('$id', $user_id, '$user_name', '$review_text')";
        mysqli_query($conn,$query1);
      }
            // $query = "INSERT INTO product_review (product_id, user_id, user_name, review) 
            //           VALUES ('$id', '{$_SESSION['user_id']}', '{$_SESSION['username']}', '$review_text')";
            // /** @var TYPE_NAME $conn */
            // $result=mysqli_query($conn,$query);
        }
    }
?>

 <!-- Breadcrumb Start -->
 <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product-list.php">Product List</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Product Detail Start -->
        <?php  
        $query="SELECT * FROM products WHERE product_id=$id ";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        $after_discount_total = $row['product_price']-($row['product_price']*$row['discount_per']/100);

        echo '
        <div class="product-detail">
            <div class="container-fluid">
                <div class="row" style="justify-content: center;">
                    <div class="col-lg-8">
                        <div class="product-detail-top">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="product-slider-single normal-slider">';
                                    $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                                    $image_result = mysqli_query($conn, $query1);
                                    
                                    while($image_row = mysqli_fetch_assoc($image_result)){

                                       echo  '<img src="../images/'.$image_row["image_name"].'" alt="Product Image"  style="min-height:470px">';
                                        
                                    }
                                  echo "</div>";
                                  $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                                  $image_result = mysqli_query($conn, $query1);
                                  $image_count = mysqli_fetch_assoc($image_result);
                                  $i = 0;

                                  while($image_count = mysqli_fetch_assoc($image_result)){
                                      if($image_count['image_name']){
                                          $i++;                                    
                                     }
                                  }

                                  if($i > 1){
                                  echo '<div class="product-slider-single-nav normal-slider">';

                                  $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                                  $image_result = mysqli_query($conn, $query1);

                                  while($image_row = mysqli_fetch_assoc($image_result)){

                                    echo ' <div class="slider-nav-img"><img src="../images/'.$image_row["image_name"].'" alt="Product Image"></div>';
                                     
                                 }
                                 echo '</div>';
                                }                                    
                               echo '
                               </div>
                                <div class="col-md-7">
                                    <div class="product-content">
                                   
                                        <div class="title"><h2>'.$row["product_name"].'</h2></div>
                                        <div class="price">
                                            <h4>Price:</h4>';

                                            if ($row["discount_per"] != 0){
                                                echo ' <p>'.$after_discount_total.' <span>'.$row["product_price"].'</span></p>';
                                            }
                                            else {
                                                echo '<p>'.$row["product_price"].'</p>';
                                            }
                                          echo '
                                        </div>
                                        <div class="action">
                                            <a class="btn" href="add_to_cart.php?id='.$row["product_id"].' &price='.$after_discount_total.'"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row product-detail-bottom">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                    </li>';

                                    $query= "SELECT COUNT(*) FROM product_review WHERE product_id = '$id'";
                                    $review_count = mysqli_query($conn, $query);
                                    $review_row_count = mysqli_fetch_array($review_count)[0];

                                    echo '<li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#reviews">Reviews '.$review_row_count.'</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="description" class="container tab-pane active">
                                        <h4>Product description</h4>
                                        <p>
                                        '.$row["product_desc"].'
                                        </p>
                                    </div>
                                    
                                    <div id="reviews" class="container tab-pane fade">';
                                    if(isset($_SESSION['user_id'])){

                                  echo'  <div class="reviews-submit">
                                    <h4>Give your Review:</h4>
                                    
                                    <form action="" method="post">
                                    <div class="row form">
                                    <div class="col-sm-12">
                                    <textarea name="review" placeholder="Review"></textarea>
                                    </div>
                                    <div class="col-sm-12">
                                    <button type="submit" name="submit_review">Submit</button>
                                    </div>
                                    </div>
                                    </form>

                                </div>';
                            }else{
                                echo '<div class="alert alert-info fade show" role="alert">
                                     You must be <strong><a href="login.php">Signed In</a></strong> to write a review :( ...                                             
                                    </div>';
                            }

                                
                                $query2 = "SELECT * FROM product_review WHERE product_id = '$id'";
                                $review_result = mysqli_query($conn, $query2);
                                if($review_row_count == 0){
                                    echo '<div class="alert alert-info fade show" role="alert">
                                         no reviews yet for this products.                                             
                                        </div>';
                                }else {
                                    while ($review_row = mysqli_fetch_assoc($review_result)) {

                              echo '<hr>
                                    <div class="reviews-submitted" >
                                        <div class="reviewer" >'.$review_row['user_name'].' - <span >'.$review_row['timestamp'].'</span ></div >
                                        <p >
                                        '.$review_row['review'].'
                                        </p >
                                    </div >';
                                    }
                                }
                                    
                                   echo' </div>
                                </div>
                            </div>
                            </div>
                        ';


                    ?>
                        
                        <div class="product">
                            <div class="section-header">
                                <h1>Related Products</h1>
                            </div>

                            <div class="row">
                                <!-- related products -->
                                <?php
                                    
                                    $query="SELECT * FROM products WHERE sub_cat_id=$sub ";
                                    $result=mysqli_query($conn,$query);
                                    while($row=mysqli_fetch_assoc($result)){
                                        $query1 = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                                        $image_result = mysqli_query($conn, $query1);
                                        $image_row = mysqli_fetch_assoc($image_result);
                                        $after_discount_total = $row['product_price']-($row['product_price']*$row['discount_per']/100);
                                        if($row['discount_per'] != 0){
            
                                            echo "<div class='col-lg-4'>
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
                                                     <h3><span>JD</span> ".$after_discount_total." </h3><span style = 'text-decoration:line-through; color:#a5a5a7;'><span>JD</span> ".$row['product_price']."</span>
                                                      <a class='btn' href='' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
                                                       </div>
                                                   </div>
                                               </div>";
                                            } 
                            
                                        else{
                            
                                            echo "<div class='col-lg-4'>
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
            
                                
                                }
                                    ?>
                              

                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
        <!-- Product Detail End -->
        
        
<?php
    require("includes/public_footer.php");
?>