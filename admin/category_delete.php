<?php
require('includes/connection.php');

$query = "delete from categories where category_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
mysqli_query($conn,$query);

header("location:manage_categories.php");

?>