<?php
    session_start();
    
    if(isset($_POST["submit"])){
        $product_id=$_GET["id"];
        $total = $_GET["price"] * $_POST["qyt"];
        if(isset($_SESSION["order_products"])){
            $_SESSION["order_products"][$product_id]=["quantity"=>$_POST["qyt"], "total"=> $total ];
        }
        else{
            $_SESSION["order_products"][$product_id]=["quantity"=>$_POST["qyt"], "total"=> $total ];
        }
     
    header("location:cart.php");}
?>