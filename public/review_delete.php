<?php
require('includes/db_connection.php');

$query = "delete from product_review where review_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
mysqli_query($conn,$query);

header("location:my-account.php");

?>