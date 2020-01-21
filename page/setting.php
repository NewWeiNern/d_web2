<!DOCTYPE html>
<html lang="en">
<?php
    $page = array(
        "title" => "Setting - Teacher Review",
        "js" => []
    );  
    include_once "../component/head.php"; 
?>
<body>
    <?php include_once "../component/nav.php"; ?>
    <div class="page-wrapper">
        <section class="setting container flex flex-sm-d-row flex-wrap">
            <input type="file" name="image" id="image"/>
            
            <div class="col-sm side-bar"><label for="image"><div class="img"></div></label></div>
            
            <div class="col-sm-3 content">
                <h1>Edit Profile</h1>
                <label for="name"><strong>Name:</strong> <input type="text" name="name" id="name"/></label>
                <label for="pass"><strong>Password:</strong> <input type="password" name="pass" id="pass"/></label>
                <label for="email"><strong>Email:</strong> <input type="email" name="email" id="email"/></label>
                <input type="submit" value="Save" class="btn blue-btn"/>
            </div>
        </section>
    </div>
</body>
</html>