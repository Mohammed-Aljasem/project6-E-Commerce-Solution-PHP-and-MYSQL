<?php
include "includes/connection.php";


if (isset($_POST['submit'])) {
    // getting data from the from and inserting them into the sql admin table
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullName = $_POST['fullName'];

//    echo "<script> console.log({$email})</script>";

    $query = "INSERT INTO admin(admin_email,admin_password,admin_name)
	         values('$email','$password','$fullName')";
    /** @var TYPE_NAME $conn */
    mysqli_query($conn, $query);
    header("location:manage_admins.php");

}


include "includes/admin_header.php"
?>
    <div class="content-wrapper">
        <div class="content">
            <div class="container d-flex flex-column justify-content-between vh-100 align-items-center justify-content-center">
                <div class="row justify-content-center mt-8">
                    <div class="col-xl-6 col-lg-8 col-md-10">
                        <div class="card">
                            <div class="card-header bg-primary">

                            </div>
                            <div class="card-body p-5">
                                <h4 class="text-dark mb-5">Register A New Admin</h4>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="text" class="form-control input-lg" id="name" name="fullName"
                                                   aria-describedby="nameHelp" placeholder="Full Name">
                                        </div>
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="email" class="form-control input-lg" id="email" name="email"
                                                   aria-describedby="emailHelp" placeholder="Email">
                                        </div>
                                        <div class="form-group col-md-12 ">
                                            <input type="password" class="form-control input-lg" id="password"
                                                   name="password" placeholder="Password">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-inline-block mr-3">
                                            </div>
                                            <button type="submit" name="submit"
                                                    class="btn btn-lg btn-primary btn-block mb-4">Sign Up
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-header bg-primary">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 mt-2">
                    <div class="card card-default">

                        <div class="card-body">
                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "select * from admin";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td scope='row'>{$row['admin_id']}</td>";
                                    echo "<td>{$row['admin_name']}</td>";
                                    echo "<td>{$row['admin_email']}</td>";
                                    echo "<td><a href='admin_edit.php?id={$row['admin_id']}' class='btn btn-warning'>Edit</a> </td>";
                                    echo "<td><a href='admin_delete.php?id={$row['admin_id']}' class='btn btn-danger'>Delete</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include "includes/admin_footer.php" ?>