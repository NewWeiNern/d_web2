<?php
session_start();

include_once "../php.class/user.php";
$user = new User();
$login = $user->login($_POST["name"], $_POST["pass"]);

if(!isset($_POST["email"])){
    if($login){
        echo '{"res" : 1}';
        $_SESSION["name"] = $_POST["name"];
        $user->logged_in($_POST["name"], 1);
        $_SESSION["admin"] = $user->select("privilege", "db_users", "name = '".$_POST['name']."'")['privilege'] == 1 ? true : false;
    }
    else{
        echo '{"res" : 0, "error" : "Password or Username is wrong!"}';
    }    
}
// else{
//     if($login){
//         echo '{"res" : 0, "error" : "User already exists!"}';
//     }
//     else{
//         if($set($_POST["name"]) && $set($_POST["pass"]) && $set($_POST["pass_1"]) && $set($_POST["email"]) && $_POST["email"] != ""){
//             if($_POST["pass"] === $_POST["pass_1"]){
//                 $user->add_user($_POST["name"], $_POST["pass"], $_POST["email"], 1);
//                 echo '{"res" : 1}';                
//             }else{
//                 echo '{"res" : 0, "error" : "Password does not matched!"}';
//             }
            
//         }else{
//             echo '{"res" : 0, "error" : "Form is incomplete!"}';
//         }
        
//     }
// }
// $folder = "../dir/user/";

$user->close_db();
?>