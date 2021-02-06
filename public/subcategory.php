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
                    <li class="breadcrumb-item active">Vendors</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

<div class="category">
            <div class="container-fluid">
                <div class="row" >

                <?php  
            $query="SELECT * FROM sub_cat WHERE category_id=$id ";
            $result=mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($result)){
                echo '
                    <div class="col-md-3">
                        <div class="category-item ch-400">
                            <img src="../images/'.$row["sub_cat_image"].'" />
                            <a class="category-name" href="subcategory_products.php?id='.$row["sub_cat_id"].'">
                                <p><h1 style="color: white;">'.$row["sub_cat_name"].'</h1></p>
                            </a>
                        </div>
                    </div>';
                    }?>
                </div>
            </div>
        </div>

<?php
    require("includes/public_footer.php");
?>
