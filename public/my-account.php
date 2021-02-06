<?php 
session_start();

include('includes/db_connection.php'); 

// die($_SESSION["user_id"]);

$query  = "select * from users where user_id = {$_SESSION["user_id"]}";
$result = mysqli_query($conn,$query);
$row    = mysqli_fetch_assoc($result);
$userPassword =  $row['user_password'];
$userName =  $row['user_name'];
$userEmail =  $row['user_email'];
$userImage =  $row['user_image'];

$image_source = $row['user_image'];

if(isset($_POST['update'])){
    
    if($filename = $_FILES["image"]["name"]) {
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../images/" . $filename;
    }else {
        $filename = $image_source;
    }
    
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $name     = $_POST['name'];
    $query    = "UPDATE users SET user_email   = '$email',
                                user_password = '$password',
                                user_name     = '$name',
                                user_image = '$filename'
                               
                               WHERE user_id = {$_SESSION["user_id"]} ";

if (move_uploaded_file($tempname, $folder))  {
    $msg = "Image uploaded successfully";
}else{
    $msg = "Failed to upload image";
}
mysqli_query($conn,$query);

if($name != $_SESSION['username']){
    $_SESSION['username'] = $name;
}

header("location: my-account.php") ;  
}


include('includes/public_header.php');
?>
    

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">My Account</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- My Account Start -->
    <div class="my-account">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="user_accout" data-toggle="pill" href="#user-tab" role="tab"><i
                                class="fa fa-user"></i>My Account</a>

                        <a class="nav-link" id="orders-nav" data-toggle="pill" href="#reviews-tab" role="tab"><i
                                    class="fa fa-comment"></i>My Reviews</a>

                        <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i
                                class="fa fa-shopping-bag"></i>My Orders</a>

                        <a class="nav-link" id="account-nav" data-toggle="pill" href="#edit-tab" role="tab"><i
                                class="fa fa-user-edit"></i>Edit My Account</a>

                        <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">

                        <div class="tab-pane show fade active" id="user-tab" role="tabpanel" aria-labelledby="orders-nav" style="overflow:hidden;">
                            <div class="table-responsive" style="overflow:hidden;">
                            <h4>My Account</h4>
                                <div class="row" >
                                    <div class="col-md-4" >
                                       <img src="../images/<?php echo $userImage ?>" class="rounded-circle" height="100px"/>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Name:</h5> <p><?php echo $userName ?></p>
                                        <h5>Email:</h5>  <p><?php echo $userEmail ?></p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $query3="SELECT * FROM orders_products where user_id={$_SESSION["user_id"]} ";
                                        $query  = "SELECT * FROM products INNER JOIN orders_products  
                                         on products.product_id = orders_products.product_id where user_id={$_SESSION["user_id"]}";
                                        $result3=mysqli_query($conn,$query);
                                        while($row2=mysqli_fetch_assoc($result3)){
                                            
                                                
                                                echo '
                                        
                                                <tr>
                                                    <td>'.$row2["orders_products_id"].'</td>
                                                    <td>'.$row2["product_name"].'</td>
                                                    <td>'.$row2["product_price"].'</td>
                                                    
                                                    
                                                </tr>
                                                ';
                                            }   
                                        
                                        ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="reviews-tab" role="tabpanel" aria-labelledby="orders-nav">
                        <?php require 'manage_reviews.php'?>
                        </div>
                      

                        <div class="tab-pane fade" id="edit-tab" role="tabpanel" aria-labelledby="account-nav">
                            <h4>Account Details</h4>
                            <form action="" method='post' enctype="multipart/form-data">
                                <div class="row">
                                <div class="col-md-12">
                                    <label>Name</label>
                                    <input class="form-control" name="name" type="text" placeholder="First Name" value="<?php echo $userName ?>">
                                </div>
                               
                                <div class="col-md-12">
                                    <label>E-mail</label>
                                    <input class="form-control"  type="email" name="email" placeholder="E-mail" value="<?php echo $userEmail ?>">
                                </div>
                                
                                <div class="col-md-12">
                                    <label>Password</label>
                                    <input class="form-control"  type="password" name="password" placeholder="Password" value="<?php echo $userPassword  ?>">
                                </div>

                                <div class="col-md-12">
									<label for="cc-payment" class="control-label mb-1">User image</label>
									<input  name="image" type="file" class="form-control">
								</div>
                              
                                <div class="col-md-12">
                                <button class="btn col-md-12" type="submit" name="update">update</button>
                                </div>
                                </div>
                                       
                            </form>     
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
                                        </div>
   
    <!-- My Account End -->

    <?php 
 
include('includes/public_footer.php');  
?>
