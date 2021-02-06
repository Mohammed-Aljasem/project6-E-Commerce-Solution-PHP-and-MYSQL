<?php
require('includes/connection.php');

$query  = "select * from products where product_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
$result = mysqli_query($conn,$query);
$row    = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $selected_category = $_POST['selected_sub_category'];
    $selected_type = $_POST['selected_product_type'];
    $product_des = $_POST['product_des'];
    $product_price = $_POST['product_price'];
    $product_sale = $_POST['product_sale'];
    $filename = array_filter($_FILES["files"]["name"]);
    $targetDir = "../images/";


    $query = "INSERT INTO products(sub_cat_id,product_name, product_price, product_desc, type, discount_per )
	          values('$selected_category', '$product_name', '$product_price', '$product_des', '$selected_type', '$product_sale')";

    $query = "UPDATE products SET sub_cat_id = '$selected_category', product_name = '$product_name',
                    product_price = '$product_price', 
                    product_desc = '$product_des', type = '$selected_type', 
                    discount_per =  '$product_sale' WHERE product_id = {$_GET['id']} ";
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
                                               aria-describedby="nameHelp" placeholder="Product Name" value="<?php echo $row['product_name'] ?>" >
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <textarea class="form-control" placeholder="Enter Product Description"
                                                  name="product_des" id="exampleFormControlTextarea1"
                                                  rows="3"><?php echo $row['product_desc'] ?></textarea>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="number" class="form-control input-lg" id="name"
                                               name="product_price"
                                               aria-describedby="nameHelp" value="<?php echo $row['product_price'] ?>" placeholder="Product Price">
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="number" class="form-control input-lg" id="name" name="product_sale"
                                               aria-describedby="nameHelp" value="<?php echo $row['discount_per'] ?>" placeholder="Product Sale percentage">
                                    </div>

<!--                                    <div class="form-group col-md-12 mb-4">-->
<!--                                        <input type="file" accept="image/*" id="image" name="files[]" multiple-->
<!--                                               placeholder="Image"-->
<!--                                               class="form-control">-->
<!--                                    </div>-->

                                    <div class="form-group col-md-12 mb-4">
                                        <select name="selected_sub_category" class="form-control"
                                                id="exampleFormControlSelect1">
                                            <option>Select A Subcategory...</option>
                                            <?php
                                            $query = "select * from sub_cat";
                                            $result = mysqli_query($conn, $query);
                                            while ($sub_row = mysqli_fetch_assoc($result)) {
                                                if($row['sub_cat_id'] == $sub_row['sub_cat_id']) {
                                                    echo "<option selected value='{$sub_row['sub_cat_id']}'>{$sub_row['sub_cat_name']}</option>";
                                                }else{
                                                    echo "<option value='{$sub_row['sub_cat_id']}'>{$sub_row['sub_cat_name']}</option>";
                                                }
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <select name="selected_product_type" class="form-control"
                                                id="exampleFormControlSelect1">
                                            <?php
                                           echo "<option>Select Product Type...</option>";
                                           if($row['type'] == 'normal'){
                                           echo "<option selected value='normal'>Normal Product</option>";
                                            }else{
                                            echo "<option value='normal'>Normal Product</option>";
                                            }
                                           if($row['type'] == 'hotproduct'){
                                               echo "<option selected value='hotproduct'>Hot Product</option>";
                                           }else{
                                               echo "<option value='hotproduct'>Hot Product</option>";
                                           }
                                           if($row['type'] == 'featuredproduct') {
                                               echo " <option selected value='featuredproduct'>Featured Product</option>";
                                            }else{
                                               echo " <option  value='featuredproduct'>Featured Product</option>";
                                           }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-inline-block mr-3">
                                        </div>
                                        <button type="submit" name="submit"
                                                class="btn btn-lg btn-primary btn-block mb-4">Save
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
            <div class="card card-default mt-4">
                <div class="card-header card-header-border-bottom">
                    <h2> Your Products Images </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                           </div>

                        <?php
                        $query = "SELECT * FROM products_images WHERE product_id = {$_GET['id']}";
                        $image_result = mysqli_query($conn, $query);

                        while ($image_row = mysqli_fetch_assoc($image_result)){

                            echo"<div class='col-md-12 col-lg-6 col-xl-4'>
                            <div class='card mb-1 bg-gradient-dark'>
                                <img height='300px' class='card-img-top' src='../images/{$image_row['image_name']}'>
                                <div class='card-img-overlay absolute-bottom'>
                                 <div style='display: flex; justify-content: center; align-items: center'>                               
                                        <a href='image_edit.php?id={$image_row['image_id']}&product_id={$_GET['id']}' class='btn btn-info p-2 m-1'>Edit</a>
                                        <a href='image_delete.php?id={$image_row['image_id']}&product_id={$_GET['id']}' class='btn btn-danger p-2 m-1'>Delete</a>
                                 </div>
                                </div>
                            </div>
                        </div>";
                        }

                        ?>
                    </div>
                <div style="height: 60px;">
                </div>
                <a href="image_add_new.php?id=<?php echo $_GET['id']?>">
                <span style="position: absolute; right: 1rem; bottom: 1rem; margin-top: 2rem">
                <i style="font-size: 4rem; color: green; cursor: pointer" class="mdi mdi-image-plus"></i>
                </span>
                </a>
                </div>
            </div>

        </div>

    </div>
</div>


<?php include "includes/admin_footer.php" ?>
