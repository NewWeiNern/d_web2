<?php
session_start();
$p = $_SESSION["prev_page"];
include_once "../php.class/user.php";
$user = new User();
$user->logged_in($_SESSION["name"], 0);
$user->close_db();
session_destroy();
header("location: ".$p);
?>