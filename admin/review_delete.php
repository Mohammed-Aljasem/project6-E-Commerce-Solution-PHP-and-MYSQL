<?php
require('includes/connection.php');

$query = "delete from product_review where review_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
mysqli_query($conn,$query);

header("location:manage_reviews.php");

?>