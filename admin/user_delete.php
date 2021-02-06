<?php
require('includes/connection.php');

$query = "delete from users where user_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
mysqli_query($conn,$query);

header("location:manage_users.php");

?>