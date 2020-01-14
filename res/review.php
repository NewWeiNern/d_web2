<?php
    include_once "../php.class/review.php";    
    $review = new Review();
    $review->add_review(
        $_SESSION["name"], 
        $_POST["teacher"], 
        [
            $_POST["clear"],
            $_POST["helpful"],
            $_POST["knowledgable"],
            $_POST["pacing"]
        ],
        $_POST["text"]
    );
    $review->close_db();
    header("location: ".$_SESSION['prev_page']."");
?>