<?php
   session_start();
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <?php
      require 'nav.php';
      require 'products.php';

      // if the query parameter is a product, remove it from the cart.
      if (isset($_GET['product'])) {
         unset($_SESSION["cart"][$_GET['product']]);
      }
   ?>
   <h1>Shopping Cart</h1>
   <p>
   <?php
      foreach ($_SESSION['cart'] as $tie_name => $quantity) {
         $price = $products[$tie_name]["price"];
         $alt = $products[$tie_name]["alt"];
         $src = $products[$tie_name]["src"];
         echo "<img src=$src height=\"200\" width=\"200\" alt=$alt><br>";
         echo "<a href=\"shopping_cart.php?product=$tie_name\">Remove from Cart</a><br>";
         // echo "$tie_name is a total of $price<br>";
         // <img src="img/ties/87933513_650_main.jpg" id="tie1" height="200" width="200" alt="Pink and Blue Checkered">
      }
   ?>
   </p>
 
</body>
</html>