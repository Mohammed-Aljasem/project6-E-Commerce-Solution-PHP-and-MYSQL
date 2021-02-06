<?php
    require("includes/db_connection.php");
    session_start();
    $product_id=$_GET["id"];
    $user_id=$_SESSION["user_id"];
    $query="DELETE FROM wish_list WHERE user_id = $user_id AND product_id = $product_id";
    $result=mysqli_query($conn,$query);

    header("location:wish_list.php");

?>