<?php
   session_start();
   $_SESSION['cart'] = array();
   if (!in_array($_SESSION['cart'], $_POST['cart']))
   {
      $_SESSION['cart'][$_POST['cart']] = 1;
   }
   else
   {
      $_SESSION['cart'][$_POST['cart']]++;
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
   ?>
   <div class="selection" id="selection">
      <h1>Browse</h1>
      <div class="imgButtonPair">
         <img src="img/ties/87933513_650_main.jpg" id="tie1" height="200" width="200" alt="Pink and Blue Checkered">
         <button type="button" class="addToCart">Add to Cart</button>
      </div>
      <div class="imgButtonPair">
         <img src="img/ties/87933732_650_main.jpg" id="tie2" height="200" width="200" alt="Pink Floral">
         <button type="button" class="addToCart">Add to Cart</button>
      </div>
      <br>
      <div class="imgButtonPair">
         <img src="img/ties/A7982311_680_main.jpg" id="tie3" height="200" width="200" alt="Dark Blue and Pink Floral">
         <button type="button" class="addToCart">Add to Cart</button>
      </div>
      <div class="imgButtonPair">
         <img src="img/ties/K7982238_602_main.jpg" id="tie4" height="200" width="200" alt="Purple">
         <button type="button" class="addToCart">Add to Cart</button>
      </div>
      <br>
      <div class="imgButtonPair">
         <img src="img/ties/K7982242_455_main.jpg" id="tie5" height="200" width="200" alt="Blue Vine/Floral">
         <button type="button" class="addToCart">Add to Cart</button>
      </div>
      <div class="imgButtonPair">
         <img src="img/ties/K7982242_500_main.jpg" id="tie6" height="200" width="200" alt="Purple Vine/Floral">
         <button type="button" class="addToCart">Add to Cart</button>
      </div>
      <br>
   </div>
</body>
</html>