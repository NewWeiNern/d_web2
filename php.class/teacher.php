<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    include_once "../lib/db.php";
    class Teacher extends DB{
        function __construct(){
            parent::__construct();
        }
        function find_teacher_id($teacher){
            return $this->select("id", "db_teachers", "name = '$teacher'");
        }
        function find_match($str, $sch="*"){
            if($sch !== "*"){
                $text = " AND cur_school = '$sch'";
            }
            $db = $this->connect->query("SELECT name, cur_school FROM db_teachers WHERE name LIKE '%$str%'".(isset($text) ? $text : ""));
            $res = $db->fetch_all(MYSQLI_ASSOC);
            $db->close();
            return $res;
        }
    }
?>