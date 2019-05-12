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
   ?>
   <h1>Checkout</h1>
   <p>
   <?php
      // assemble the address
      $street = htmlspecialchars($_POST['street']);
      $city = htmlspecialchars($_POST['city']);
      $state = htmlspecialchars($_POST['state']);
      $zip = htmlspecialchars($_POST['zip']);

      // assemble the products and price
      $total_price = 0;
      foreach ($_SESSION['cart'] as $tie_name => $quantity) {
         $price = $products[$tie_name]["price"];
         $alt = $products[$tie_name]["alt"];
         $src = $products[$tie_name]["src"];
         $total_price += $price;
         echo "<img src=$src height=\"200\" width=\"200\" alt=$alt><br>";
         echo "<a href=\"shopping_cart.php?product=$tie_name\">Remove from Cart</a><br>";
      }
      echo "<br><br>Total price: $total_price<br><br>";
      echo "These products will be sent to $street, $city $state $zip<br><br>";
      unset($_SESSION['cart']);
      session_end();
   ?>
   </p>
 
</body>
</html>