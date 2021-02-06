<?php
require('includes/connection.php');

if (isset($_POST['submit'])) {
    $sub_category_name = $_POST['sub_category_name'];
    $selected_category = $_POST['selected_category'];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "../images/" . $filename;


    $query = "INSERT INTO sub_cat(sub_cat_name, sub_cat_image, category_id)
	          values('$sub_category_name', '$filename', '$selected_category')";

    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
    /** @var TYPE_NAME $conn */
    mysqli_query($conn, $query);
    header("location:manage_sub_categories.php");

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
                                        <input type="text" class="form-control input-lg" id="name" name="sub_category_name"
                                               aria-describedby="nameHelp" placeholder="Category Name">
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="file" accept="image/*" id="image" name="image" placeholder="Image"
                                               class="form-control">
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <select name="selected_category" class="form-control" id="exampleFormControlSelect1" >
                                            <option>Select A Category...</option>
                                            <?php
                                            $query = "select * from categories";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-inline-block mr-3">
                                        </div>
                                        <button type="submit" name="submit"
                                                class="btn btn-lg btn-primary btn-block mb-4">Add Subcategory
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
                        <h2 style="color: white">Subcategories</h2>
                    </div>
                                <div class="col-lg-12">
                            <div class="row p-3" style="background: white; display: flex; align-items: center;
                            justify-content: center; border-radius: 0 0 5px 5px;
                             box-shadow: 1px 1px 10px gray">
                        <?php
                        $query = "SELECT * FROM sub_cat";
                        $result = mysqli_query($conn, $query);

                        function fetchCatData ($cat_id, $conn){

                            $query = "SELECT * FROM categories WHERE category_id = {$cat_id}";
                            $result = mysqli_query($conn, $query);
                            $cat_data = mysqli_fetch_assoc($result);

                            return $cat_data;
                        }

                        while ($row = mysqli_fetch_assoc($result)) {

                            $cat_result =  fetchCatData($row['category_id'], $conn);
                            echo "                          
                            <div class='col-lg-4 m-2 p-3' style='border: 2px solid #4C84FF; border-radius: 5px; box-shadow: 1px 1px 10px gray'>                          
                             <div  style='margin: 0' class='media d-flex mb-0'>
                                <div class='media-image align-self-center mr-3 rounded'>
                                    <img width='150px' height='auto' src='../images/{$row['sub_cat_image']}' alt='customer image'>
                                </div>
                                <div style='display: flex; justify-content: center; align-items: center; flex-direction: column' class='media-body align-self-center'>
                                    <h6 style='text-align: center' class='mb-3 text-dark font-weight-medium'> {$row['sub_cat_name']}</h6>
                                    <div style='display: flex; justify-content: center; align-items: center; flex-direction: column' class='mt-1 mb-1'>    
                                         <img width='30px' height='30px' class='rounded-circle' src='../images/{$cat_result['category_image']}' alt='customer image'>                            
                                         <span class='mb-2 mr-2 badge badge-pill badge-primary'>{$cat_result['category_name']}</span>
                                    </div>
                                    
                                     <p class='mb-0'>
                                        <a href='sub_category_edit.php?id={$row['sub_cat_id']}' class='btn btn-info p-1'><i class='mdi mdi-circle-edit-outline'></i></a>
                                        <a href='sub_category_delete.php?id={$row['sub_cat_id']}' class='btn btn-danger p-1'><i class='mdi mdi-delete-forever'></i></a>
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
