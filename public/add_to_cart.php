<?php
    session_start();
    
        $product_id=$_GET["id"];
        $product_price=$_GET["price"];
        // $total = (int)$_GET["price"] * (int)$_POST["qyt"];
        if(isset($_SESSION["order_products"])){
            $_SESSION["order_products"][$product_id]=["quantity"=> 1, "total"=> $product_price ];
        }
        else{
            $_SESSION["order_products"][$product_id]=["quantity"=> 1, "total"=> $product_price ];
        }     
    header("location:cart.php");
?>