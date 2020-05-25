<?php
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $dbname = "recipes";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


  // Check the connection is good with no errors
  //   array_push($subtitle, strval(var_export($row[0])));
  if (mysqli_connect_errno()) {
    die ("Database connection failed: " .
      mysqli_connect_error() .
      " (" . mysqli_connect_errno() . ")"
    );
  }


  // Step 2: Preform Database Query
$query = "SELECT * FROM `table 1`";
$result = mysqli_query($connection, $query);


$title = array();
$subtitle = array();
$description = array();
$cook_time = array();
$main_img = array();

$directory = "assets/img";
$img_path = scandir($directory);


while ($row = mysqli_fetch_row($result)) {
   array_push($title, $row[0]);
   array_push($subtitle, $row[1]);
   array_push($description, $row[2]);
   array_push($cook_time, $row[3]);
   array_push($main_img, $row[7]);
}



mysqli_close($connection);



$cook_times = "45min";
$titles = "Ancho-Orange Chicken";
$subtitles = "with Kale Rice & Roasted Carrots";
$descriptions = "Weʼre amping up chicken breasts with a glaze of smoky ancho chile paste and fresh orange juice in this recipe. On the side, roasted carrots and lightly creamy, golden raisin-studded rice perfectly accent the sweetness of the glaze.";

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
      <link type="text/css" rel="stylesheet" href="assets\css\main.css">
      <link href="https://fonts.googleapis.com/css?family=Lato|Merriweather&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@1,562&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100&display=swap" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
      <script src="assets/js/main.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   </head>

   <div class="body">
         <header class="header" id="header">
            <img src="assets/img/header-background-2.png" alt="Lillian Raphael's Portfolio"></img>
            <div class="title-search">
               <h2>Recipeasy</h2>
               <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for recipes.." title="Type in a name">
            </div>
         </header>
         
         <div class="card">
            <div class="grid-container">
               <?php
                  for ($i = 1; $i < sizeof($title); $i++) {
                     $b = $i + 1;
                     echo "<div class='grid-item'>";
                        echo "<a class='wrapper' href=''>";
                           echo "<div class='ribbon'>$cook_time[$i]</div>";
                           echo "<img class='header' src='../assets/img/all-images/$main_img[$i]'></img>";
                           echo "<h1 class='name'>$title[$i]</h1>";
                           echo "<h1 class='subtitle'>$subtitle[$i]</h1>";
                           echo "<div class='border'></div>";
                           echo "<p class='info'>$description[$i]</p>";
                           echo "<div class='grey-border'></div>";
                        echo "</a>";
                     echo "</div>";
                  }
               ?>

<!--
<div class="grid-item">
<a class="wrapper" href="/pages/IDM241/IDM-241-hub.html">

   <div class="ribbon">1</div>
   <img class="header" src="assets/img/test1.jpg"></img>
   <h1 class="name">TEST TEST TEST</h1>
   <h1 class="subtitle">TEST TEST TEST</h1>
   
   <div class="border"></div>
   
   <p class="info">TEST TEST TEST</p>
   
   <div class="grey-border"></div>
   
</a>
</div> -->


            </div> 
         </div>
      </div>
   </div>
</html>
