<?php
    include_once "../php.class/review.php";
    include_once "../php.class/user.php";
    include_once "../php.class/teacher.php";

    
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    if($_SESSION["admin"] && isset($_GET["user"])){
        $edit_user = $_GET["user"];
    }

    $review = new Review();
    $teacher = new Teacher();
    $user = new User();
    $edit_user = isset($edit_user) ? $edit_user : $_SESSION["name"];
    $review->edit_review(
        $user->get_user_data($edit_user)["id"], 
        $teacher->find_teacher_id($_POST["teacher"])["id"],
        [
            $_POST["clear"],
            $_POST["helpful"],
            $_POST["knowledgable"],
            $_POST["pacing"]
        ],
        $_POST["text"]
    );

    $teacher->close_db();
    $review->close_db();
    $user->close_db();

    unset($_GET["user"]);
    header("location: ".str_replace("/edit", "",strtok($_SESSION['prev_page'], "?")));

?>