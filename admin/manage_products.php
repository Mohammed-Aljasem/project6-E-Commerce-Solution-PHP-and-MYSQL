<?php
require('includes/connection.php');

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 4;
$offset = ($pageno - 1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM products";
/** @var TYPE_NAME $conn */
$result = mysqli_query($conn, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);


if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $selected_category = $_POST['selected_sub_category'];
    $selected_type = $_POST['selected_product_type'];
    $product_des = $_POST['product_des'];
    $product_price = $_POST['product_price'];
    $product_sale = $_POST['product_sale'];
    $filename = array_filter($_FILES["files"]["name"]);
//    $tempname = $_FILES["image"]["tmp_name"];
    $targetDir = "../images/";


    $query = "INSERT INTO products(sub_cat_id,product_name, product_price, product_desc, type, discount_per )
	          values('$selected_category', '$product_name', '$product_price', '$product_des', '$selected_type', '$product_sale')";
    /** @var TYPE_NAME $conn */
    mysqli_query($conn, $query);
    $id = $conn->insert_id;
    $last_id = mysqli_insert_id($conn);


    if (!empty($filename)) {
        foreach ($_FILES['files']['name'] as $key => $val) {
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                $query = "INSERT INTO products_images (image_name, product_id) VALUES ('$fileName', '$last_id')";
                mysqli_query($conn, $query);
            }
        }
    }


    header("location:manage_products.php");

}

include('includes/admin_header.php'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container d-flex flex-column justify-content-between vh-100 align-items-center justify-content-center">
            <div class="row justify-content-center mt-8">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="card">
                        <div class="card-header bg-primary">

                        </div>
                        <div class="card-body p-5">
                            <h4 class="text-dark mb-5">Add A New Product</h4>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" class="form-control input-lg" id="name" name="product_name"
                                               aria-describedby="nameHelp" placeholder="Product Name">
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <textarea class="form-control" placeholder="Enter Product Description"
                                                  name="product_des" id="exampleFormControlTextarea1"
                                                  rows="3"></textarea>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="number" class="form-control input-lg" id="name"
                                               name="product_price"
                                               aria-describedby="nameHelp" placeholder="Product Price">
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="number" min="0" max="100" class="form-control input-lg" id="name"
                                               name="product_sale"
                                               aria-describedby="nameHelp" placeholder="Product Sale percentage">
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="file" accept="image/*" id="image" name="files[]" multiple
                                               placeholder="Image"
                                               class="form-control">
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <select name="selected_sub_category" class="form-control"
                                                id="exampleFormControlSelect1">
                                            <option>Select A Subcategory...</option>
                                            <?php
                                            $query = "select * from sub_cat";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['sub_cat_id']}'>{$row['sub_cat_name']}</option>";
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <select name="selected_product_type" class="form-control"
                                                id="exampleFormControlSelect1">
                                            <option>Select Product Type...</option>
                                            <option value="normal">Normal Product</option>
                                            <option value="hotproduct">Hot Product</option>
                                            <option value="featuredproduct">Featured Product</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-inline-block mr-3">
                                        </div>
                                        <button type="submit" name="submit"
                                                class="btn btn-lg btn-primary btn-block mb-4">Add Product
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-header bg-primary">
                    </div>
                </div>
            </div>
            <!--            End of the form-->

            <!-- Top Products -->

            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div style='border: 2px solid #4C84FF; border-radius: 5px; box-shadow: 1px 1px 10px gray;
                         color: black; background: white'
                             class="card-header card-header-border-bottom">
                            <h2>Our Products</h2>
                        </div>
                        <div style="background: white" class="row">
                            <?php
                            $query = "SELECT * FROM products LIMIT $offset, $no_of_records_per_page";
                            $result = mysqli_query($conn, $query);


                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $query = "SELECT * FROM products_images WHERE product_id = {$row['product_id']}";
                                $image_result = mysqli_query($conn, $query);

                                $sub_cat_query = "SELECT * FROM sub_cat WHERE sub_cat_id = {$row['sub_cat_id']}";
                                $sub_cat_data = mysqli_query($conn, $sub_cat_query);
                                $sub_cat_row = mysqli_fetch_assoc($sub_cat_data);

                                echo "
                            <div  class='col-lg-6 p-3'>
                            <div class='card-body' style='border: 2px solid #4C84FF; border-radius: 5px; box-shadow: 1px 1px 10px gray' >
                            <h3 class='p-2' style='color: black; text-align: center'>{$row['product_name']}</h3>                          
                            <div style='display: flex; justify-content: center; ' class='mt-1 mb-1'>    
                                         <img width='30px' height='30px' class='rounded-circle' src='../images/{$sub_cat_row['sub_cat_image']}' alt='customer image'>                            
                                         <span class='mb-2 mr-2 badge badge-pill badge-primary'>{$sub_cat_row['sub_cat_name']}</span>
                            </div>
                            <p style='text-align: center'>{$row['product_desc']}</p>";
                                if ($row['discount_per'] == 0) {
                                    echo "<p class='mb-0' style='text-align: center'>
                                    <span class='text-dark ml-3'>{$row['product_price']}</span>
                                      </p>";
                                } else {
                                    $after_discount_total = $row['product_price'] - ($row['product_price'] * $row['discount_per'] / 100);
                                    echo "<p class='mb-0' style='text-align: center'>
                                    <del>{$row['product_price']}</del>
                                    <span class='text-dark ml-3'>{$after_discount_total}</span>
                                </p>";
                                }
                                echo "<div style='display: flex; justify-content: center; align-items: center'>
                                        <a href='product_edit.php?id={$row['product_id']}' class='btn btn-info p-2 m-1'>Edit</a>
                                        <a href='product_delete.php?id={$row['product_id']}' class='btn btn-danger p-2 m-1'>Delete</a>
                            </div>
                            <div id='carouselExampleCaptions{$row['product_id']}' class='carousel slide' data-ride='carousel'>
                                
                                <div class='carousel-inner'>";
                                while ($image_row = mysqli_fetch_assoc($image_result)) {

                                    if ($i == 0) {
                                        echo "<div class='carousel-item bg-gradient-dark active'>
                                        <img class='d-block w-100' width='auto' height='350px' src='../images/{$image_row['image_name']}' alt='First slide'>
                                        </div>";
                                    } else {
                                        echo "<div class='carousel-item bg-gradient-dark'>
                                            <img class='d-block w-100' width='auto' height='350px' src='../images/{$image_row['image_name']}' alt='Second slide'>
                                        </div>";
                                    }
                                    $i++;
                                }
                                $i = 0;
//                        $query = "";
//                        $image_result = [];

                                echo "</div>
                                <a class='carousel-control-prev' href='#carouselExampleCaptions{$row['product_id']}' role='button' data-slide='prev'>
                                    <span class='mdi mdi-chevron-left mdi-36px' aria-hidden='true'></span>
                                    <span class='sr-only'>Previous</span>
                                </a>
                                <a class='carousel-control-next' href='#carouselExampleCaptions{$row['product_id']}' role='button' data-slide='next'>
                                    <span class='mdi mdi-chevron-right mdi-36px' aria-hidden='true'></span>
                                    <span class='sr-only'>Next</span>
                                </a>
                            </div>
                        </div>
                        </div>
                        <hr>
                        ";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'includes/pagination.php'?>

</div>
</div>


<?php include "includes/admin_footer.php" ?>
