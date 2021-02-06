<?php
if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['submit'])){
    header("location:product-list.php?search={$_POST['search']}");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>E Store - eCommerce</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="eCommerce HTML Template Free Download" name="keywords">
        <meta content="eCommerce HTML Template Free Download" name="description">

        <!-- Favicon -->
        <link href="https://cdn3.iconfinder.com/data/icons/shopping-2-20/130/51-512.png" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Top bar Start -->
        <div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-envelope"></i>
                        support@estore.com
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-phone-alt"></i>
                        +962-777-7777
                    </div>
                </div>
            </div>
        </div>
        <!-- Top bar End -->
        
        <!-- Nav Bar Start -->
        <div class="nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="product-list.php" class="nav-item nav-link">Products</a>
                            <a href="cart.php" class="nav-item nav-link">Cart</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                                <div class="dropdown-menu">
                                <?php
                                require_once ('db_connection.php');
                                $query="SELECT * FROM categories";
                                $result=mysqli_query($conn,$query);
                                while($row=mysqli_fetch_assoc($result)){
                                    echo '
                                    <a href="subcategory.php?id='.$row["category_id"].'" class="dropdown-item">'.$row["category_name"].'</a>';
                                    }?>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-nav ml-auto">
                          

                                <?php 
                            if (isset($_SESSION["user_id"])){
                            echo' <a href="my-account.php" class="nav-item nav-link">'.$_SESSION['username'].'</a>';
                            echo' <a href="logout.php" class="nav-item nav-link">Logout</a>
                            ';}
                            else {
                            echo' <a href="login.php" class="nav-item nav-link">Register or Login</a>';
                            }
                            ?>
                                   
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->      
        
        <!-- Bottom Bar Start -->
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="index.php">
                                <img src="img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search">
                            <form method="post" action="">
                            <input name="search" type="text" placeholder="Search">
                            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            <a href="wish_list.php" class="btn wishlist">
                                <i class="fa fa-heart"></i>                            </a>
                            <a href="cart.php" class="btn cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span><?php if(isset($_SESSION["order_products"])){ echo count($_SESSION['order_products']);}else{echo "0";}?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Bar End -->       
        