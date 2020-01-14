<?php
/**
 * Checks whether post fulfills the criteria of containing from the 4 datas.
 * Also help check if logged in user has previously submitted a review
 */

session_start();
include_once "../php.class/review.php";

$review = new Review();
$posted = $review->find_user_post(isset($_SESSION["name"]) ? $_SESSION["name"] : "", $_POST["teacher"]);
$match = ["clear", "helpful", "knowledgable", "pacing", "text"];

if(isset($_SESSION["name"]) && count(array_intersect($match, array_keys($_POST))) >= 5 && count($posted) == 0){
    echo '{"res" : 1}';
}
else{
    if(!isset($_SESSION["name"])){
        echo '{"res" : 0, "err" : 0}';
    }
    else if(count(array_intersect($match, array_keys($_POST))) !== 5){
        echo '{"res" : 0, "err" : 1}'; 
    }
    else if(count($posted) > 0){
        echo '{"res" : 0, "err" : 2}'; 
    }
}
$review->close_db();
?>