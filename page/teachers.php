<!doctype html>
<html class="no-js" lang="">
<?php 
  include_once "../php.class/teacher.php";
  $teacher = new Teacher();
  $search = isset($_GET["search"]);
  $search_text = $search ? $_GET["search"] : "";
  $school_isset = isset($_GET["school"]);
  $school_text = $school_isset ? $_GET["school"] : "*";
  $teacher_result = $teacher->find_match($search_text, $school_text);

  $school = json_decode(file_get_contents("../json/school-list.json"));
  usort($school, function($a,$b){return strcmp($a->name,$b->name);});
  $page = array(
    "title"=>"Search Teacher Review",
    "js"=>[]
  );
  include_once "../component/head.php"; 
?>
<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
  <?php include_once "../component/nav.php"; ?>
  <div class="page-wrapper">
    <section class="search">
        <form>
            <div class="search-container flex-wrap container">
                <input type="text" name="search" id="search" value="<?= $search ? $search_text : "";?>">
                <select name="school" id="school">
                    <option value="*">All</option>
                    <?php foreach($school as $key => $value) {echo '<option value="'.$value->name.'" '.($school_isset && $school_text === $value->name ? "selected" : "").'>'.$value->name.'</option>';} ?>
                </select>
                <input type="submit" value="Search" class="btn blue-btn">
            </div>
        </form>
    </section>
    <section class="results">
    <?= $search ? "<h1 class=\"container\">Search Result : $search_text </h1>" : ""; ?>
          <div class="container teachers">
          <?php foreach($teacher_result as $key =>$value){
            echo "
            <a href='reviews/".preg_replace("/\s/", "_",$value["name"])."'>
              <div class='list-info'>
                  <h1>".$value['name']."</h1>
                  <p>
                    <span>Teaching in: </span>".$value["cur_school"]."
                  </p>
              </div>
            </a>
            ";
          }
          ?>
          </div>
    </section>
  </div>
</body>

</html>
<?php $teacher->close_db();?>