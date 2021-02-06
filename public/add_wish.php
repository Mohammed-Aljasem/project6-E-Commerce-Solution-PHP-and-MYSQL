<?php
    require("includes/db_connection.php");
    session_start();

    if (isset($_SESSION["user_id"])){
      $user_id=$_SESSION["user_id"];
      $id = $_GET["id"];

      $query="SELECT * FROM wish_list WHERE user_id = $user_id AND product_id = $id";
      $result=mysqli_query($conn,$query);
      $row=mysqli_fetch_assoc($result);
      if (!$row){
        $query1="insert into wish_list (user_id,product_id) values ('$user_id', '$id')";
        mysqli_query($conn,$query1);
      }
			header("location:wish_list.php");

          }

    else {
			header("location:login.php");
    }