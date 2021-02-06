<?php
    require("includes/db_connection.php");
    require("includes/public_header.php");


    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 8;
    $offset = ($pageno - 1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM products";
/** @var TYPE_NAME $conn */
    $result = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);



if(isset($_GET['sub_cat_id'])){
         $sub_id = $_GET['sub_cat_id'];
    }
    $search = '';
    if(isset($_GET['search'])){
        $search = $_GET['search'];
    }
    if(isset($_POST['submit'])){
        $search = $_POST['search'];
    }
?>

  
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Product List</li>
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
                                    <div class="row" style="display: flex; justify-content: center">
                                        <div class="col-md-4">
                                            <div class="product-search">
                                                <form action="" method="post" >
                                                    <input type="text" name="search" placeholder="Search">
                                                    <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="product-short">
                                                <div class="dropdown">
                                                    <div class="dropdown-toggle" data-toggle="dropdown">Sort By Vendor</div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href='product-list.php' class='dropdown-item'>All products</a>
                                                        <?php
                                                        $query = "SELECT * FROM sub_cat";
                                                        /** @var TYPE_NAME $conn */
                                                        $results = mysqli_query($conn, $query);

                                                        while ($row = mysqli_fetch_assoc($results)){

                                                        echo  "<a href='product-list.php?sub_cat_id={$row['sub_cat_id']}' class='dropdown-item'>{$row['sub_cat_name']}</a>";
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<!--                                        <div class="col-md-4">-->
<!--                                            <div class="product-price-range">-->
<!--                                                <div class="dropdown">-->
<!--                                                    <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>-->
<!--                                                    <div class="dropdown-menu dropdown-menu-right">-->
<!--                                                        <a href="#" class="dropdown-item">$0 to $50</a>-->
<!--                                                        <a href="#" class="dropdown-item">$51 to $100</a>-->
<!--                                                        <a href="#" class="dropdown-item">$101 to $150</a>-->
<!--                                                        <a href="#" class="dropdown-item">$151 to $200</a>-->
<!--                                                        <a href="#" class="dropdown-item">$201 to $250</a>-->
<!--                                                        <a href="#" class="dropdown-item">$251 to $300</a>-->
<!--                                                        <a href="#" class="dropdown-item">$301 to $350</a>-->
<!--                                                        <a href="#" class="dropdown-item">$351 to $400</a>-->
<!--                                                        <a href="#" class="dropdown-item">$401 to $450</a>-->
<!--                                                        <a href="#" class="dropdown-item">$451 to $500</a>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                    </div>
                                </div>
                            </div>
                  
                            <?php
                            if(!empty($sub_id)){
                                $query= $search ?  "SELECT * FROM products WHERE sub_cat_id =
                             $sub_id AND product_name LIKE '%$search%' LIMIT $offset, $no_of_records_per_page"
                                    : "SELECT * FROM products WHERE sub_cat_id = $sub_id  LIMIT $offset, $no_of_records_per_page";
                            }else{
                                $query= $search ? "SELECT * FROM products WHERE product_name LIKE '%$search%' 
                                LIMIT $offset, $no_of_records_per_page" : "SELECT * FROM products  LIMIT $offset, $no_of_records_per_page";
                            }
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
                                          <a class='btn' href='add_to_cart.php?id=".$row["product_id"]."&price=".$after_discount_total."' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
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
                                          <a class='btn' href='add_to_cart.php?id=".$row["product_id"]."&price=".$after_discount_total."' style=' position:absolute; bottom:9%; right: 3%; '><i class='fa fa-shopping-cart'></i>Buy Now</a>
                                           </div>
                                       </div>
                                   </div>";
                
                            }

                            }
                            ?>

                            <?php

                            $check = isset($_GET['sub_cat_id']);
                            $search || $check ?   : include 'includes/pagination.php';

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product List End -->  
        

<?php
    require("includes/public_footer.php");
?>
