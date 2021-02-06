<?php
include "includes/db_connection.php";
$query1 = "SELECT * FROM product_review WHERE product_id = 41";
$review_result = mysqli_query($conn, $query1);
$review_row = mysqli_fetch_assoc($review_result);

function timeago($date) {
    $timestamp = strtotime($date);

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60","60","24","30","12","10");

    $currentTime = time();
    if($currentTime >= $timestamp) {
        $diff     = time()- $timestamp;
        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        echo $diff . " " . $strTime[$i] . "(s) ago ";
    }
}


echo '<div class="reviews-submitted" >
                                                <div class="reviewer" >'.$review_row['user_name'].' - <span >'.timeago($review_row['timestamp']).'</span ></div >
                                                <p >
                                                '.$review_row['review'].'
                                                </p >
                                            </div >';

