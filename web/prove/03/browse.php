<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css?family=Work+Sans:400">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <?php
      require 'nav.php';
   ?>
   <div class="selection" id="selection">
      <h1>Browse</h1>
      <img src="img/ties/87933513_650_main.jpg" id="tie1" height="100" width="100" alt="Pink and Blue Checkered">
      <img src="img/ties/87933732_650_main.jpg" id="tie2" height="100" width="100" alt="Pink Floral">
      <br>
      <img src="img/ties/A7982311_680_main.jpg" id="tie3" height="100" width="100" alt="Dark Blue and Pink Floral">
      <img src="img/ties/K7982238_602_main.jpg" id="tie4" height="100" width="100" alt="Purple">
      <br>
      <img src="img/ties/K7982242_455_main.jpg" id="tie5" height="100" width="100" alt="Blue Vine/Floral">
      <img src="img/ties/K7982242_500_main.jpg" id="tie6" height="100" width="100" alt="Purple Vine/Floral">
   </div>
</body>
</html>