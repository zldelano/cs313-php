<?php
   session_start();
   // require ("products.php");
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
      require 'products.php'
   ?>
   <h1>Shopping Cart</h1>
   <p>
   <?php
      foreach ($_SESSION['cart'] as $tie_name) {
         echo "$tie_name is a total of $products[$tie_name]<br>";
      }
      // foreach ($products as $product => $price) {
      //    echo "$product";
      // }
   ?>
   </p>
 
</body>
</html>