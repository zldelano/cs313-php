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
   <h1>Shopping Cart</h1>
   <?php
      foreach ($_SESSION['cart'] as $tie_name => $tie_quantity) {
         echo "$tie_name is set to $tie_quantity";
      }
   ?>
 
</body>
</html>