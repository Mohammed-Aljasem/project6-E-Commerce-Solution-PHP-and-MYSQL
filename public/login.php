<?php
include('includes/db_connection.php');
session_start();
if (isset($_POST['login'])){

    if(!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["name"])){

        $name    =$_POST['name'];
        $password=$_POST['password'];
        $email   =$_POST['email'];
        $query = "INSERT INTO users (user_email,user_password,user_name)
        values('$email','$password','$name')";
        /** @var TYPE_NAME $conn */
        mysqli_query($conn,$query);

        $query4="SELECT user_id FROM users WHERE user_email='$email'";
        $result4=mysqli_query($conn,$query4);
        $user=mysqli_fetch_assoc($result4);
        // die(print_r($user));
        $_SESSION["user_id"]=$user["user_id"];
        header("location: my-account.php");
    }else{
        $error="Please enter your all data";
    }

}

if(isset($_POST["signIn"])){
    if(!empty($_POST["Semail"]) && !empty($_POST["Spassword"])){
        $Semail=$_POST["Semail"];
        $Spassword=$_POST["Spassword"];
        $query1="SELECT * FROM users WHERE user_email='$Semail' AND user_password='$Spassword'";
        $result1=mysqli_query($conn,$query1);
        $user=mysqli_fetch_assoc($result1);
        if(isset($user["user_id"])){
            $_SESSION["user_id"]=$user["user_id"];
            $_SESSION['username']= $user['user_name'];
            header("location:index.php");
        }
        else{
            $error1="User Not found.";
        }
    }
    else{
        $error1="Please enter your Email and Password.";
    }
}
include('includes/public_header.php');
//include('includes/public_header.php');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>E Store - eCommerce HTML Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="eCommerce HTML Template Free Download" name="keywords">
        <meta content="eCommerce HTML Template Free Download" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

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
        
        <!-- Breadcrumb Start -->
<!--        <div class="breadcrumb-wrap">-->
<!--            <div class="container-fluid">-->
<!--                <ul class="breadcrumb">-->
<!--                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>-->
<!--                    <li class="breadcrumb-item active">Login & Register</li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
        <!-- Breadcrumb End -->
        
        <!-- Login Start -->
        <div class="login" >
            <div class="container-fluid" style="margin-top: 5%;">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="register-form" style="height: 55vh;">
                            <form action=" " method="post" > 
                            <?php if(isset($error)){ echo"<div class='alert alert-danger'> $error</div>";}  ?>
                            <div class="row">
                                <div style="margin-bottom: 1rem">
                                <h2>Register</h2>
                                </div>
                                <div class="col-md-12">
                                    <label>Name</label>
                                    <input class="form-control" name="name" type="text" placeholder="First Name">
                                </div>
                               
                                <div class="col-md-12">
                                    <label>E-mail</label>
                                    <input class="form-control"  type="email" name="email" placeholder="E-mail">
                                </div>
                                
                                <div class="col-md-12">
                                    <label>Password</label>
                                    <input class="form-control"  type="password" name="password" placeholder="Password">
                                </div>
                              
                                <div class="col-md-12" >
                                <button class="btn col-md-12" type="submit" name="login">sign up</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6" >
                        <div class="login-form"  style="height: 55vh;">
                         <form action="" method="post">  
                            <?php if(isset($error1)){ echo"<div class='alert alert-danger'> $error1</div>";}  ?>

                            <div class="row" >
                                <div style="margin-bottom: 1rem">
                                <h2>Sign in</h2>
                                </div>
                                <div class="col-md-12">
                                    <label>E-mail </label>
                                    <input class="form-control" type="email" name="Semail" placeholder="E-mail / Username">
                                </div>
                                <div class="col-md-12">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="Spassword" placeholder="Password">
                                </div>
                                
                                <div class="col-md-12" style="text-align:center;">
                                    <button class="btn col-md-12"  name="signIn">Sign in</button>
                                </div>
                            </div>
                         </form>
                           <h5 class="mt-5">Or check our <a href="product-list.php"> <i class="fa fa-shopping-cart"></i>Products</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login End -->
        
        
        <!-- Footer Bottom End -->       
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
