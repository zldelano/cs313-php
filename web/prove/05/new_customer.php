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
      require 'db_connect.php';
   ?>
   <h1>New Customer</h1>
   <form action="new_car.php" method="post">
      Email:            <input type="text" name="newcust_email"><br>
      First name:       <input type="text" name="newcust_name_first"><br>
      Second name:      <input type="text" name="newcust_name_second"><br>
      Phone (primary):  <input type="text" name="newcust_phone_primary"><br>
      Phone (secondary):<input type="text" name="newcust_phone_secondary"><br>
      <input type="submit"><br>
   </form>
   <h1>New Address</h1>
   <form action="new_car.php" method="post">
      Street:           <input type="text" name="newaddr_street"><br>
      City:             <input type="text" name="newaddr_city"><br>
      Zip:              <input type="text" name="newaddr_zip"><br>
      State:            <input type="text" name="newaddr_state"><br>
      Apartment Number: <input type="text" name="newaddr_apt_number"><br>
      <input type="submit"><br>
   </form>
</body>
</html>