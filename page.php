<?php

$host = $_SERVER['HTTP_HOST'];
if ($host == 'localhost') {
   // Local database credentials
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $dbname = "recipes";
}
else {
  // Remote database credentials
  $dbhost = "localhost";
  $dbuser = "kwbbahmy_recipe";
  $dbpass = "R@lphie_0930!";
  $dbname = "kwbbahmy_recipeasy";
}

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


  // Check the connection is good with no errors
  //   array_push($subtitle, strval(var_export($row[0])));
  if (mysqli_connect_errno()) {
    die ("Database connection failed: " .
      mysqli_connect_error() .
      " (" . mysqli_connect_errno() . ")"
    );
  }


  if(isset($_GET["data"]))
  {
      $data = $_GET["data"];
  }

  echo $data;

  // Step 2: Preform Database Query
$query = "SELECT * FROM `table 1`";
$result = mysqli_query($connection, $query);


$title = array();
$subtitle = array();
$description = array();
$cook_time = array();
$servings = array();
$cal_per_serving = array();
$proteine = array();
$main_img = array();
$ingredients_img = array();
$step_imgs = array();
$all_ingredients = array();
$all_steps= array();

$directory = "assets/img";
$img_path = scandir($directory);


while ($row = mysqli_fetch_row($result)) {
   array_push($title, $row[0]);
   array_push($subtitle, $row[1]);
   array_push($description, $row[2]);
   array_push($cook_time, $row[3]);
   array_push($servings, $row[4]);
   array_push($cal_per_serving, $row[5]);
   array_push($proteine, $row[6]);
   array_push($main_img, $row[7]);
   array_push($ingredients_img, $row[8]);
   array_push($step_imgs,  explode('*', $row[9]));
   array_push($all_ingredients, str_replace('*', "<br>", $row[10]));
   array_push($all_steps,  explode('*', $row[11]));
   
}

mysqli_close($connection);

?>

<!DOCTYPE html>
<div id="bg">
   <canvas></canvas>
   <canvas></canvas>
   <canvas></canvas>
 </div>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Recipeasy</title>
      <link type="text/css" rel="stylesheet" href="assets\css\page.css">
      <link href="https://fonts.googleapis.com/css?family=Lato|Merriweather&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@1,562&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100&display=swap" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
      <script src="assets/js/main.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   </head>

   <div class="body">

      <a id="navbar" href="index.php">
         <img src="../assets/svg/back.svg"></img>
      </a>
         
         <div class="card">
            <div class="grid-container">
               <?php
                  echo "<div class='grid-item'>";
                     echo "<div class='wrapper'>";
                        echo "<img class='header image-padding' src='../assets/img/all-images/$main_img[$data]'></img>";
                        echo "<h1 class='name'>$title[$data] $subtitle[$data]</h1>";
                        echo "<h1 class='subtitle'>Serving Size: $servings[$data] | Cal per Serving: $cal_per_serving[$data] | Cook Time: $cook_time[$data]</h1>";
                        echo "<div class='border'></div>";
                        echo "<p class='info'>$description[$data]</p>";

                        echo "<div class='display-container'>";
                           echo "<div class='grid-item'>";
                           echo "<img class='header' src='../assets/img/all-images/$ingredients_img[$data]'></img>";
                           echo "<h1 class='name'>Ingredients</h1>";
                           echo "<h1 class='subtitle'>$subtitle[$data]</h1>";
                           echo "<div class='border'></div>";
                           echo "<p class='info'>$all_ingredients[$data]</p>";
                           echo "</div>";

                           for ($i = 0; $i < sizeof($step_imgs[$data]); $i++) {
                                 
                              $step_imgs_split = $step_imgs[$data][$i];


                              $step_title = $all_steps[$data][$i*2];
                              $step_description = $all_steps[$data][($i*2)+1];

                              echo "<div class='grid-item'>";
                              echo "<img class='header' src='../assets/img/all-images/$step_imgs_split'></img>";
                              echo "<h1 class='name'>Step $step_title</h1>";
                              echo "<h1 class='subtitle'></h1>";
                              echo "<div class='border'></div>";
                              echo "<p class='info'>$step_description</p>";
                              echo "</div>";

                           }
                        echo "</div>";
                     echo "</div>";
                  echo "</div>";
               ?>
            </div> 
         </div>
      </div>
   </div>
</html>
