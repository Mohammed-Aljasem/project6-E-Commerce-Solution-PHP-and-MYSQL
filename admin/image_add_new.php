<?php
require('includes/connection.php');

/** @var TYPE_NAME $conn */

$query  = "select * from products where product_id = {$_GET['id']}";
$pro_result = mysqli_query($conn,$query);
$pro_row    = mysqli_fetch_assoc($pro_result);


if(isset($_POST['submit'])){

    if($filename = $_FILES["image"]["name"]) {

        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../images/" . $filename;

    }



    $query = "INSERT INTO products_images (image_name, product_id) VALUES ('$filename', '{$_GET["id"]}')";

    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
    /** @var TYPE_NAME $conn */
    mysqli_query($conn,$query);
    header("location:product_edit.php?id={$_GET['id']}");

}



include('includes/admin_header.php');  ?>


    <div class="content-wrapper">
    <div class="content">
        <div class="container d-flex flex-column justify-content-between vh-100 align-items-center justify-content-center">
            <div class="row justify-content-center mt-8">
                <div class="col-xl-8 col-lg-8 col-md-10">
                    <div class="card">
                        <div style="display: flex; justify-content: center" class="card-header bg-primary" >
                        </div>
                        <div class="card-body p-5">
                            <h4 class="text-dark mb-5 text-lg-center">Add New Image For <?php echo $pro_row['product_name']?></h4>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="file" accept="image/*" id="image" name="image" placeholder="Image"
                                               class="form-control">
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
        </div>
    </div>



<?php include "includes/admin_footer.php" ?>