<?php 
if(session_status() == PHP_SESSION_NONE){
  session_start();
}
$_SESSION["prev_page"] = $_SERVER["REQUEST_URI"]; // for use in returning to previous page upon logging out
?>

<head>
  <meta charset="utf-8">
  <base href="/d_web2/"/>
  <title><?= isset($page['title']) ? $page["title"] : "Teacher Review" ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/component.css">
  <?php
    if(isset($page["css"])){
      for($i = 0; $i < count($page["css"]); $i++){
        echo '<link href='.$page["css"][$i].' rel="stylesheet"/>';
      }
    }
  ?>
  <meta name="theme-color" content="#fafafa">
  
  <script src="js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/custom-component/form-validate.js" async></script>
  <script src="js/custom-component/log-modal.js" async></script>
  <script src="js/main.js" async></script>
  <!-- Due to type="module" not supported in iPhone, code has been changed! -->
  <?php
    if(isset($page["js"])){
      for($i = 0; $i < count($page["js"]); $i++){
        echo '<script src='.$page["js"][$i].' async></script>';
      }
    }
  ?>
</head>