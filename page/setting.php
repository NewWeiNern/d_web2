<!DOCTYPE html>
<html lang="en">
<?php

    $page = array(
        "title" => "Setting - Teacher Review",
        "js" => ["js/custom-component/setting-validate.js", "js/custom-component/add-image.js"]
    );  
    include_once "../component/head.php"; 
    include_once "../php.class/user.php";

    if(!isset($_SESSION["name"])){
        header("Location:reviews");
    }
    $mysqli = new mysqli("localhost","root", "", "db_teacher_review");
    $user = new User();
    $set_arr = array();
    $set_val = array();
    $user_data = $user->get_user_data($_SESSION["name"]);
    $image = "dir/user/".$_SESSION["name"].".jpg";
    $image_exist = file_exists("../".$image);

    if(isset($_POST["submit"])){
        $update_stmt = "UPDATE db_users SET ";
        $cur_pass = $user_data["pass"];
        $old_pass = $_POST["c_pass"];
        $new_pass = $_POST["n_pass"];

        $email = $user_data["email"] === $_POST["email"] ? false : $_POST["email"];
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
                $f_des = "../".$image;
                move_uploaded_file($f_tmp_name, $f_des);
            }
        }
        
        if($cur_pass === $old_pass && $cur_pass !== $new_pass){
            //update 
            $set_arr[] = "pass = ?";
            $set_val[] = $new_pass;
        }
        if($email){
            $set_arr[] = "email = ?";
            $set_val[] = $email;
        }
        if(count($set_arr) > 0){
            $update_stmt.= implode(", ", $set_arr)." WHERE name = ?";
            $stmt = $mysqli->prepare($update_stmt);
            $set_val[] = $_SESSION["name"];
            $stmt->bind_param(str_repeat("s", count($set_arr))."s", ...$set_val);
            $stmt->execute();
            $stmt->close();

            $user_data["email"] = $email;

            unset($set_arr);
            unset($set_val);
        }
    }
    $user->close_db();
?>
<body>
    <?php include_once "../component/nav.php"; ?>
    <div class="page-wrapper">
        <form onsubmit="return Setting.validate(event)" method="post" action="setting" enctype="multipart/form-data">
            <section class="setting container flex flex-sm-d-row flex-wrap">
                <input type="file" name="image" id="image"/>
                
                <div class="col-sm side-bar"><label for="image"><div class="img" <?=$image_exist ? "style='background-size:cover; background-image:url($image)'" : null?>></div></label></div>
                
                <div class="col-sm-3 content">
                    <h1>Edit Profile</h1>
                    <label for="c_pass"><strong>Current Password:</strong> <input type="password" name="c_pass" id="c_pass"/></label>
                    <label for="n_pass"><strong>New Password:</strong> <input type="password" name="n_pass" id="n_pass"/></label>
                    <label for="email"><strong>Email:</strong> <input type="email" name="email" id="email" value="<?=$user_data["email"]?>"/></label>
                    <input type="submit" value="Save" name="submit" class="btn blue-btn"/>
                </div>
            </section>
        </form>
    </div>
</body>
</html>