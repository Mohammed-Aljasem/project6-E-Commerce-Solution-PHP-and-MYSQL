<?php
require('includes/connection.php');

if (isset($_POST['submit'])) {
    $category_name = $_POST['category_name'];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "../images/" . $filename;


    $query = "INSERT INTO categories(category_name, category_image)
	         values('$category_name', '$filename')";

    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
    /** @var TYPE_NAME $conn */
    mysqli_query($conn, $query);
    header("location:manage_categories.php");

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
                            <h4 class="text-dark mb-5">Register A New Category</h4>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" class="form-control input-lg" id="name" name="category_name"
                                               aria-describedby="nameHelp" placeholder="Full Name">
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="file" accept="image/*" id="image" name="image" placeholder="Image"
                                               class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-inline-block mr-3">
                                        </div>
                                        <button type="submit" name="submit"
                                                class="btn btn-lg btn-primary btn-block mb-4">Add Category
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
                <div class="container-fluid mt-4 col-10">
                    <div class="card-header justify-content-center card-header bg-primary" style="border-radius: 5px 5px 0 0;
                     box-shadow: 1px 1px 10px gray">
                        <h2 style="color: white">Categories</h2>
                    </div>
                                <div class="col-lg-12">
                            <div class="row p-3" style="background: white; display: flex; align-items: center;
                            justify-content: center; border-radius: 0 0 5px 5px;
                             box-shadow: 1px 1px 10px gray">
                    <?php
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <div class='col-lg-4 m-2 p-3' style='border: 2px solid #4C84FF; border-radius: 5px; box-shadow: 1px 1px 10px gray'>                          
                        <div  style='margin: 0' class='media d-flex mb-0'>                                <div class='media-image align-self-center mr-3 rounded'>
                                    <img width='150px' height='auto' src='../images/{$row['category_image']}' alt='customer image'>
                                </div>
                                <div class='media-body align-self-center'>
                                    <h6 class='mb-3 text-dark font-weight-medium'> {$row['category_name']}</h6>
                                    
                                    <p class='mb-0'>
                                        <a href='category_edit.php?id={$row['category_id']}' class='btn btn-info p-1'><i class='mdi mdi-circle-edit-outline'></i></a>
                                        <a href='category_delete.php?id={$row['category_id']}' class='btn btn-danger p-1'><i class='mdi mdi-delete-forever'></i></a>
                                    </p>
                                </div>
                            </div>
                            </div>
                        ";
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php include "includes/admin_footer.php" ?>
