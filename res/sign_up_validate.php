<?php
session_start();

include_once "../php.class/user.php";
$user = new User();
$login = $user->login($_POST["name"], $_POST["pass"]);
$set = function($a){return isset($a);};

if($login){
    echo '{"res" : 0, "error" : "User already exists!"}';
}else{
    if($set($_POST["name"]) && $set($_POST["pass"]) && $set($_POST["pass_1"]) && $set($_POST["email"]) && $_POST["email"] != ""){
        if($_POST["pass"] === $_POST["pass_1"]){
            // $user->add_user($_POST["name"], $_POST["pass"], $_POST["email"], 1);
            echo '{"res" : 1}';                
        }else{
            echo '{"res" : 0, "error" : "Password does not matched!"}';
        }
        
    }else{
        echo '{"res" : 0, "error" : "Form is incomplete!"}';
    }
}

$user->close_db();

?>