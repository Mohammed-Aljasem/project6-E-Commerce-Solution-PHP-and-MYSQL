<?php
// open connection
$conn = mysqli_connect("localhost", "root", "123321mm", "project6");
if (!$conn) {
    die('cannot connecto to server');
}
