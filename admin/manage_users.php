<?php
include "includes/connection.php";

include "includes/admin_header.php"
?>
    <div class="content-wrapper">
        <div class="content">
            <div class="container d-flex flex-column justify-content-between vh-100 align-items-center justify-content-center">
                <div class="col-lg-9 mt-2">
                    <div class="card card-default">

                        <div class="card-body">
                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "select * from users";
                                /** @var TYPE_NAME $conn */
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td scope='row'>{$row['user_id']}</td>";
                                    echo "<td><img width='40px' height='40px' class='rounded-circle' src='../images/{$row['user_image']}' alt='customer image'></td>";
                                    echo "<td>{$row['user_name']}</td>";
                                    echo "<td>{$row['user_email']}</td>";
                                    echo "<td><a href='user_delete.php?id={$row['user_id']}' class='btn btn-danger'>Delete</a></td>";
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