<?php
include_once "../php.class/user.php";

$user = new User();
$user_data = $user->get_user_data($_SESSION["name"]);

if($user_data["pass"] === $_POST["c_pass"] || (strlen($_POST["n_pass"]) == 0 && strlen($_POST["c_pass"]) == 0)){
    echo '{"res" : 1}';
}
else{
    echo '{"res" : 0, "error" : "Current password field is wrong!"}';
}
$user->close_db();
?>