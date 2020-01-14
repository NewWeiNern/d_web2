<?php

    session_start();
    if(!isset($_SESSION["name"])){
        exit;
    }
    include_once "../php.class/user.php";
    include_once "../php.class/review.php";
    $user = new User();
    $id = $_SESSION["admin"] && isset($_GET["user"]) ? $_GET["user"] : $user->get_user_id($_SESSION["name"])["id"];

    $review = new Review();
    $review->delete_review($id, $_GET["teacher"]);
    $user->close_db();
    header("location: ".$_SESSION["prev_page"]);
?>