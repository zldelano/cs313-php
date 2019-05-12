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
      <h2>Enter your address</h2>
      <form action="confirmation.php">
         Street: <input type="text" name="street" required><br>
         State:  <input type="text" name="state" required><br>
         ZIP:  <input type="text" name="zip" required><br>
         <input type="submit" value="Submit">
      </form>
   <?php
      $total_price = 0;
      foreach ($_SESSION['cart'] as $tie_name => $quantity) {
         $total_price += $price;
      }
      echo "<br><br>Total price: $total_price"
   ?>
   </p>
 
</body>
</html>