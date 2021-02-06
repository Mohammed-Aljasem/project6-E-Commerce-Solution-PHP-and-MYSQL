<?php
require('includes/connection.php');

// fetch old data
$query  = "select * from categories where category_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
$result = mysqli_query($conn,$query);
$row    = mysqli_fetch_assoc($result);
$image_source = $row['category_image'];

if(isset($_POST['submit'])){
    $cat_name = $_POST['category_name'];
    if($filename = $_FILES["image"]["name"]) {

        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../images/" . $filename;

    }else {
        $filename = $image_source;
    }




    $query = "UPDATE categories SET category_name = '$cat_name',
	                           category_image = '$filename'
	                           WHERE category_id = {$_GET['id']}";

    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
    /** @var TYPE_NAME $conn */
    mysqli_query($conn,$query);
    header("location:manage_categories.php");

}



include('includes/admin_header.php');  ?>


    <div class="content-wrapper">
        <div class="content">
            <div class="container d-flex flex-column justify-content-between vh-100 align-items-center justify-content-center">
                <div class="row justify-content-center mt-8">
                    <div class="col-xl-6 col-lg-8 col-md-10">
                        <div class="card">
                            <div style="display: flex; justify-content: center" class="card-header bg-primary" >
                            <img  width="100px" height="auto" src="../images/<?php echo $image_source ?>">
                            </div>
                            <div class="card-body p-5">
                                <h4 class="text-dark mb-5 text-lg-center">Edit <?php echo $row['category_name']?> Category</h4>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="text" class="form-control input-lg" id="name" name="category_name"
                                                   aria-describedby="nameHelp" value="<?php echo $row['category_name'] ?>" placeholder="Category Name">
                                        </div>
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