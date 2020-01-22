<!DOCTYPE html>
<html lang="en">
<?php
    $page = array(
        "title" => "Setting - Teacher Review",
        "js" => ["js/custom-component/setting-validate.js"]
    );  
    include_once "../component/head.php"; 
    include_once "../php.class/user.php";

    if(!isset($_SESSION["name"])){
        header("Location:reviews");
    }
    $user = new User();
    $user_data = $user->get_user_data($_SESSION["name"]);
    $image = "dir/user/".$_SESSION["name"].".jpg";
    $image_exist = file_exists("../".$image);
?>
<body>
    <?php include_once "../component/nav.php"; ?>
    <div class="page-wrapper">
        <form onsubmit="return Setting.validate(event)" method="post" action="setting">
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