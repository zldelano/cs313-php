<?php
   session_start();
   // require ("products.php");
   if (!is_array($_SESSION['cart']))
   {
      $_SESSION['cart'] = array();
   }
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <script src="script.js"></script>
</head>
<body>
   <?php
      require 'nav.php';
      require 'products.php';
      if (isset($_GET['product'])) {
         $_SESSION["cart"][$_GET['product']] = 1;
      }
   ?>
   <div class="selection" id="selection">
      <h1>Browse</h1>
      <div class="imgButtonPair">
         <img src="img/ties/87933513_650_main.jpg" id="tie1" height="200" width="200" alt="Pink and Blue Checkered">
         <!-- <button type="button" class="addToCart">Add to Cart</button> -->
         <a href="browse.php?product=tie1">Add to Cart</a>
      </div>
      <div class="imgButtonPair">
         <img src="img/ties/87933732_650_main.jpg" id="tie2" height="200" width="200" alt="Pink Floral">
         <!-- <button type="button" class="addToCart">Add to Cart</button> -->
         <a href="browse.php?product=tie2">Add to Cart</a>
      </div>
      <br>
      <div class="imgButtonPair">
         <img src="img/ties/A7982311_680_main.jpg" id="tie3" height="200" width="200" alt="Dark Blue and Pink Floral">
         <!-- <button type="button" class="addToCart">Add to Cart</button> -->
         <a href="browse.php?product=tie3">Add to Cart</a>
      </div>
      <div class="imgButtonPair">
         <img src="img/ties/K7982238_602_main.jpg" id="tie4" height="200" width="200" alt="Purple">
         <!-- <button type="button" class="addToCart">Add to Cart</button> -->
         <a href="browse.php?product=tie4">Add to Cart</a>
      </div>
      <br>
      <div class="imgButtonPair">
         <img src="img/ties/K7982242_455_main.jpg" id="tie5" height="200" width="200" alt="Blue Vine/Floral">
         <!-- <button type="button" class="addToCart">Add to Cart</button> -->
         <a href="browse.php?product=tie5">Add to Cart</a>
      </div>
      <div class="imgButtonPair">
         <img src="img/ties/K7982242_500_main.jpg" id="tie6" height="200" width="200" alt="Purple Vine/Floral">
         <!-- <button type="button" class="addToCart">Add to Cart</button> -->
         <a href="browse.php?product=tie6">Add to Cart</a>
      </div>
      <br>
   </div>
</body>
</html>