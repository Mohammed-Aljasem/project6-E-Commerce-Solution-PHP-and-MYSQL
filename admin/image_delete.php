<?php
require('includes/connection.php');

$query = "delete from products_images where image_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
mysqli_query($conn,$query);

header("location:product_edit.php?id={$_GET['product_id']}");

?>