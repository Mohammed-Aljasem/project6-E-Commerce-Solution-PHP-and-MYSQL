<?php
require('includes/connection.php');

if (isset($_POST['submit'])) {
    // get data from form
    $review = $_POST['review'];


    $query = "UPDATE product_review SET review = '$review'
	                           WHERE review_id = {$_GET['id']}";
    /** @var TYPE_NAME $conn */
    mysqli_query($conn, $query);
    header("location:manage_reviews.php");

}

// fetch old data
$query = "select * from product_review INNER JOIN products ON product_review.product_id = products.product_id WHERE review_id = {$_GET['id']}";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

include('includes/admin_header.php'); ?>


<div class="content-wrapper">
    <div class="content">
        <div class="container d-flex flex-column justify-content-between vh-100 align-items-center justify-content-center">
            <div class="row justify-content-center mt-8">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="card">
                        <div class="card-header bg-primary">

                        </div>
                        <div class="card-body p-5">
                            <h4 class="text-dark mb-5">Edit <?php echo $row['product_name'] ?> Review</h4>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input disabled type="text" class="form-control input-lg" id="name" name="fullName"
                                               aria-describedby="nameHelp" placeholder="Full Name" value="<?php echo $row['user_name'] ?>">
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input disabled type="text" class="form-control input-lg" id="name" name="fullName"
                                               aria-describedby="nameHelp" placeholder="Full Name" value="<?php echo $row['timestamp'] ?>">
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <textarea class="form-control" placeholder="Enter Product Description"
                                                  name="review" id="exampleFormControlTextarea1"
                                                  rows="3"><?php echo $row['review'] ?></textarea>
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
</div>


<?php include "includes/admin_footer.php" ?>
