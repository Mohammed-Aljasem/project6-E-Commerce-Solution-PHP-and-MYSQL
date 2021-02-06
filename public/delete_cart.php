<?php
    session_start();
    
    if(isset($_POST["delete"])){
        $product_id=$_GET["id"];
        unset($_SESSION['order_products'][$product_id]);
    header("location:cart.php");}
?>