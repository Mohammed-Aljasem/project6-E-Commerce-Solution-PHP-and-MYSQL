<?php
include "includes/connection.php";

include "includes/admin_header.php"
?>
    <div class="content-wrapper">
        <div class="content">
            <div class="container d-flex flex-column justify-content-between vh-100 align-items-center justify-content-center">
                <div class="col-lg-12 mt-2">
                    <div class="card card-default">

                        <div class="card-body">
                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Review</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "select * from product_review INNER JOIN products ON product_review.product_id = products.product_id";
                                /** @var TYPE_NAME $conn */
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td scope='row'>{$row['product_name']}</td>";
                                    echo "<td>{$row['user_name']}</td>";
                                    echo "<td>{$row['review']}</td>";
                                    echo "<td>{$row['timestamp']}</td>";
                                    echo "<td><a href='review_edit.php?id={$row['review_id']}' class='btn btn-info'>Edit</a></td>";
                                    echo "<td><a href='review_delete.php?id={$row['review_id']}' class='btn btn-danger'>Delete</a></td>";
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