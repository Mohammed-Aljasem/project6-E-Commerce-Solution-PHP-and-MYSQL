<?php
require('includes/connection.php');

$query = "delete from sub_cat where sub_cat_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
mysqli_query($conn,$query);

header("location:manage_sub_categories.php");

?>