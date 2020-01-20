<!doctype html>
<html class="no-js" lang="">

<?php 
include_once "../php.class/review.php";
include_once "../php.class/teacher.php";
  $name = preg_replace("/(_|-)/", " ", substr($_GET["param"], 1));
  $display = "";
  $edit_mode = preg_match("/\/edit/", $_SERVER["REQUEST_URI"]) ? true : false;
  if(strlen($name) == 0){
    // This only dsplays the page of user personal comment.
    include_once "../php.class/user.php";
    $display = "user_review";
    $user = new User();
    $teacher = new Teacher();
    $user_data = $user->exist("db_users", "name", isset($_SESSION["name"]) ? $_SESSION["name"] : "");
    $review = new Review();
    $review_data = $review->find_user_post($user_data["name"]);

    $decode_result = function($str, $ind){return json_decode($str)[$ind];};
  }
  else{
    // This only deploy when theres text after reviews/?
    $display = "teacher_review";
    $teacher = new Teacher();
    $write_to_scr = "";
    $teacher_data = $teacher->exist("db_teachers", "name", $name);
    
    $review = new Review();
    $review_data = $review->find_review($teacher_data["id"]);

    $total_user = count($review_data);
    $total_review_rating = [0,0,0,0];

    for($i = 0; $i < $total_user; $i++){
      if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
        if(isset($_GET["user"])){
          if($edit_mode && $review_data[$i]["user_name"] === $_GET["user"]){
            $write_to_scr = $review_data[$i]["rating"];
            $users_selected = $review_data[$i];
          }
        }
        else{
          if($edit_mode && $review_data[$i]["user_name"] === $_SESSION["name"]){
            $write_to_scr = $review_data[$i]["rating"];
            $users_selected = $review_data[$i];
          }
        }
      }
      else{
        if($edit_mode && $review_data[$i]["user_name"] === $_SESSION["name"]){
          $write_to_scr = $review_data[$i]["rating"];
          $users_selected = $review_data[$i];
        }
      }

      $decoded = json_decode($review_data[$i]["rating"]);
      $total_review_rating[0] += $decoded[0];
      $total_review_rating[1] += $decoded[1];
      $total_review_rating[2] += $decoded[2];
      $total_review_rating[3] += $decoded[3];
    }

    $avg = function($rating, $users){
      return ($rating / (5 * $users)) * 100;
    };
    
  }

  $sess_name = isset($_SESSION["name"]) ? $_SESSION["name"].'\'s Review': "Log in to Review";
  $page = array(
    "title"=>$_GET["param"] === "" ? $sess_name: substr(preg_replace("/_|-/"," ",$_GET["param"]),1)." - Teacher Review",
    "js"=>["js/custom-component/rate.js","js/reviews.js", "js/custom-component/form-verify.js"],
    "css"=>["https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"]
  );
  include_once "../component/head.php"; 
  if(!isset($_SESSION["name"]) && $edit_mode){
    header("location:../");
  }
  if(!isset($users_selected) && $edit_mode){
    header("location:./");
  }
  echo isset($write_to_scr) && $write_to_scr != ""? "<script>var __user_result = $write_to_scr</script>" : NULL;
?>
<!-- Please close db -->
<body>
  <?php include_once "../component/nav.php"; ?>

  <div class="page-wrapper">
    <?php if($display === "teacher_review"): ?>
      <?php if($teacher_data): ?>
        <section class="review container flex flex-sm-d-row flex-wrap">
          <h1><?= $teacher_data["name"];?></h1>
          <div class="col-sm side-bar">
            <div class="img" <?= file_exists("../dir/teacher/".preg_replace("/ /", "_",$name).".jpg") ? "style='background-image:url(dir/teacher/".preg_replace("/ /", "_",$name).".jpg)'" : ""?>></div>
            
            <div class="details">
                <div class="works" data-label="school"><?= $teacher_data["cur_school"];?></div>
                <div class="country" data-label="location">Singapore</div>
                <div class="teaches" data-label="subject">
                <?= join(array_map(function($a){return "<span>$a</span>";}, explode(", ", $teacher_data["subject"])));?>
                </div>
                <div class="portfolio" data-label="portfolio"> <?=$teacher_data["portfolio"];?></div>
            </div>
          </div>
          <div class="col-sm-3 content">
              <form action="<?= !$edit_mode ? "res/review.php" : "res/edit_reviews.php".($_SESSION["admin"] && isset($_GET["user"]) ? "?user=".$_GET["user"] : "")?>" class="review-form flex flex-wrap" <?= !$edit_mode ? "onSubmit='Verify.validate(event)'" : ""?><?= !isset($_SESSION["name"]) ? 'data-type="login"' : "";?> method="post">
                <div class="col-md star-container"><h1>Rate Your Teacher</h1></div>
                <div class="col-md reviews-container">
                    <h1>Teacher's Score</h1>
                    <?php 
                        $arr = ["clear", "helpful", "knowledgable", "pacing"];
                        for($i = 0; $i < count($arr); $i++):
                    ?>
                    <div class="<?=$arr[$i]; ?> bar-rating-container">
                        <div class="stick-left"><?= number_format($total_review_rating[$i] / ($total_user > 0 ? $total_user : 1), 1);?> Stars Avg</div>
                        <div class="stick-right">
                            <div class="bar-filled" style="width:<?= $avg($total_review_rating[$i], $total_user > 0 ? $total_user : 1);?>%"><?= str_repeat("<span></span>",5);?></div>
                            <div class="bar-empty"><?= str_repeat("<span></span>",5);?></div>
                        </div>
                    </div>
                    <?php
                        endfor;
                        unset($arr);
                        unset($i);
                    ?>
                </div>
                <h1>Write A Review</h1>
                <textarea name="text"><?= $edit_mode ? $users_selected["post"] : NULL?></textarea>
                <input type="hidden" name="teacher" value="<?=$name;?>"/>
                <!-- <input type="submit" class="btn blue-btn send-btn" <?=!isset($_SESSION["name"]) ? "onclick='event.preventDefault()'" : ""?>/> -->
                <input type="submit" class="btn blue-btn send-btn" name="submit" />
              </form>
          </div>
        </section>
        <section class="comments">
          <div class="container">
            <h1>All Users Reviews ( <?=$total_user;?> )</h1>
            <?php for($i = 0; $i < $total_user; $i++): ?>
            <div class="comment-container">
              <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"] || isset($_SESSION["name"]) && $_SESSION["name"] == $review_data[$i]["user_name"]):?>
              <div class="options">
                <i class="fa icon-ellipsis-horizontal"></i>
                <ul>
                  <li><a href="reviews/<?=preg_replace("/ /", "_", $teacher_data["name"]);?>/edit<?=$_SESSION["admin"] ? "?user=".$review_data[$i]["user_name"] : ""?>">Edit</a></li>
                  <li><a href="res/delete_review.php?teacher=<?=$review_data[$i]["teacher_id"]."&user=".$review_data[$i]["user_id"];?>">Delete</a></li>
                </ul>
              </div>
              <?php endif; ?>
              <div class="comment-info">
                <div class="img" style="background-image:url(dir/user/<?=$review_data[$i]["user_name"]?>.jpg);"></div>
                <!-- <img src="dir/user/<?=$review_data[$i]["user_name"]?>.jpg" alt=""> -->
                <div>
                  <h4 class="user_name"><?=$review_data[$i]["user_name"];?></h4>
                  <p class="date"><?= date_format(date_create($review_data[$i]["date"]), "d F Y");?></p>              
                </div>
              </div>
              <p class="text"><?= $review_data[$i]["post"];?></p>
            </div>
            <?php endfor;?>
          </div>
        </section>
      <?php else:?>
        <section class="not-found flex flex">
          <h1>404 Not Found</h1>
          <p>The Person you are looking for does not exists!</p>
        </section>
      <?php endif;?>
    <?php else: ?>
      <?php if(isset($_SESSION["name"])):?>
        <section class="user-review container">
          <div class="underline-deco">
            <img src="img/star.png"/>
          </div>
          <div class="user-img" style="background-image: url(dir/user/<?=$_SESSION['name'];?>.jpg)"></div>
          <h1 class="user-name"><?= $user_data["name"];?></h1>
          <div class="text">Total Post: <?= count($review_data);?></div>
          <div class="comments">
          <?php for($i = 0; $i < count($review_data); $i++): ?>
            <div class="comment-container">
              <div class="options">
                <i class="fa icon-ellipsis-horizontal"></i>
                <ul>
                  <li><a href="reviews/<?=preg_replace("/ /", "_", $review_data[$i]["teacher"]);?>/edit">Edit</a></li>
                  <li><a href="res/delete_review.php?teacher=<?=$teacher->find_teacher_id($review_data[$i]["teacher"])["id"];?>">Delete</a></li>
                </ul>
              </div>
              <em><strong>Review on <?= $review_data[$i]["teacher"];?>:</strong></em>
              <p class="text"><?= $review_data[$i]["post"];?></p>
              <p>
                <strong>Clear <?=$decode_result($review_data[$i]["rating"],0);?></strong>
                <strong>Helpful <?=$decode_result($review_data[$i]["rating"],1);?></strong>
                <strong>Knowledgable <?=$decode_result($review_data[$i]["rating"],2);?></strong>
                <strong>Pacing <?=$decode_result($review_data[$i]["rating"],3);?></strong>
              </p>
            </div>
            <?php endfor;?>
          </div>
        </section>
      <?php else:?>
        <section class="please-log">
        <h1 class="add_underline">Please <a href="javascript:void(0)" data-type="login" onclick="modal.toggleModal(event)">log in</a> to continue</h1>
        </section>
      <?php endif;?>
    <?php endif; ?>
  </div>

</body>

</html>
