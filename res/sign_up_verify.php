<?php
session_start();

include_once "../php.class/user.php";
$user = new User();
$login = $user->login($_POST["name"], $_POST["pass"]);
if($login){return;}
else{
    $user->add_user($_POST["name"], $_POST["pass"], $_POST["email"], 1);
    $_SESSION["name"] = $_POST["name"];
    $user->logged_in($_POST["name"], 1);
    $_SESSION["admin"] = $user->select("privilege", "db_users", "name = '".$_POST['name']."'")['privilege'] == 1 ? true : false;
    $file = $_FILES["image"];
    $f_name = $file["name"];
    $f_tmp_name = $file["tmp_name"];
    $f_size = $file["size"];
    $f_err = $file["error"];
    $f_type = $file["type"];

    $folder = "../dir/user/";
    $max_byte = 1000000;

    $f_ext = explode(".", $f_name);
    $f_ext = strtolower(end($f_ext));
    $allowed = array("jpg", "jpeg", "png");

    if(in_array($f_ext, $allowed)){
        if($f_err === 0){
            $f_name = $_POST["name"].".jpg";
            $f_des = $folder.$f_name;

            move_uploaded_file($f_tmp_name, $f_des);
            
        }
    }
}
$user->close_db();
header("location: ".$_SESSION['prev_page']."");

?>