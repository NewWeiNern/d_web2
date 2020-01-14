<!DOCTYPE html>
<html lang="en">
<?php
    $page = array(
        "title"=>"Welcome to Teacher Review!", // set page name 
    ); 
    include_once "component/head.php";
?>
<body>
<?php include_once "component/nav.php"; ?>
  <div class="page-wrapper">
    <section class="intro flex-lg-sm-col flex-lg">
      <div class="text col-lg">
        <h1 class="unique">Share And Review Teachers.</h1>
        <p>Teacher Review provides an outlet for students to rate and comment on the teacher</p>
        <input type="submit" value="Sign Up Now" class="btn blue-btn" data-type="signup" />
        <!-- if user is logined, value will changed to Review Now-->
      </div>
      <img src="img/intro-01.png" alt="intro">
    </section>
    <section class="how-to">
      <h1 class="unique">How To Rate Your Teacher?</h1>
      <div class="row flex-lg flex-flow-wrap-reverse container">
        <div class="steps col-md">
          <img src="img/how-to-animation-01.svg"/>
          <p><strong>Step 1:</strong> Search for Your Teacher's Name</p>
        </div>
        <div class="steps col-md">
          <img src="img/how-to-animation-02.svg"/>
          <p><strong>Step 2:</strong> Rate Your Teacher</p>
        </div>
        <div class="steps col-md">
          <img src="img/how-to-animation-03.svg">
          <p><strong>Step 3:</strong> Post A Comment And Start a Discussion With The Community</p>
        </div>        
      </div>
    </section>
    <section class="find-teacher">
      <h1 class="unique">Find Your Teacher</h1>
      <input type="text" name="search-teacher" id="search-teacher">
      <div class="btn-container">
        <input type="submit" name="submit" value="Search" id="submit" class="btn blue-btn">
      </div>
      <img src="assets/bg-1.png" />
    </section>
  </div>

</body>
</html>