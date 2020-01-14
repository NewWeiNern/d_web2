<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    include_once "../lib/db.php";
    class Review extends DB{
        function __construct(){
            parent::__construct();
        }
        function add_review($name, $teacher, $rating, $post){
           $res = $this->select("
                teacher.id AS t_id, 
                user.id AS u_id
            ",
            "
                db_teachers teacher,
                db_users user
            ",
            "
                user.name = '$name' AND
                teacher.name = '$teacher'
            "
            );

            $this->insert("db_reviews", "user_id, teacher_id, rating, post", $res["u_id"].",".$res["t_id"].",'".json_encode($rating, JSON_NUMERIC_CHECK)."','".$post."'");
        }
        function edit_review($user, $teacher, $rating, $post){
            $res = $this->update(
                "db_reviews", 
                "
                rating = '".json_encode($rating, JSON_NUMERIC_CHECK)."',
                post = '$post'
                ",
                "
                teacher_id = '$teacher' AND
                user_id = '$user'
                "
            );
        }
        function delete_review($user, $teacher){
            $this->delete("db_reviews", "user_id = '$user' AND teacher_id = '$teacher'");
        }
        function find_user_post($name, $teacher = ""){
            if($teacher != ""){
                $teacher = "AND teacher = '$teacher'";
            }
            $db = $this->connect->query("SELECT *, (SELECT name from db_users WHERE db_users.id = db_reviews.user_id) AS name, (SELECT name from db_teachers WHERE db_teachers.id = db_reviews.teacher_id) AS teacher FROM db_reviews HAVING name = '$name' $teacher");
            $res = $db->fetch_all(MYSQLI_ASSOC);
            $db->close();
            return $res;
        }
        function find_review($id){
            if(!$id)return array();
            $db = $this->connect->query("SELECT *,(SELECT name from db_users WHERE db_reviews.user_id = id) AS user_name FROM db_reviews WHERE teacher_id = $id");
            $res = $db->fetch_all(MYSQLI_ASSOC);
            $db->close();
            return $res;
        }
    }
?>