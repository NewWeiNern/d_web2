<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    include_once "../lib/db.php";
    class User extends DB{
        function __construct(){
            parent::__construct();
        }
        function login($name, $pass){
            $a = $this->find("db_users", "name = '".$_POST["name"]."' AND pass = '".$_POST["pass"]."'");
            return is_countable($a) ? count($a) > 0 : FALSE;
        }
        function logged_in($user, $v){
            $this->update("db_users", "logged_in = '$v'", "name = '".$_SESSION['name']."'");
        }
        function get_user_data($name){
            return $this->find("db_users", "name = '".$name."'");
        }
        function get_user_id($name){
            return $this->select("id", "db_users", "name = '$name'");
        }
        function add_user($name, $pass, $email, $logged_in){
            $this->insert("db_users", "name, pass, email, logged_in", "'$name','$pass','$email',$logged_in");
        }
    }
?>