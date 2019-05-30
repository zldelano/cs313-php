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

      echo var_dump($_POST);
   ?>
   <h1>New Car</h1>
   <form action="new_car.php" method="post">
      VIN:           <input type="text" name="newcar_vin"><br>
      Color:         <input type="text" name="newcar_color"><br>
      Make:          <input type="text" name="newcar_make"><br>
      Model:         <input type="text" name="newcar_model"><br>
      Year:          <input type="text" name="newcar_year"><br>
      Owner email:   <input type="text" name="newcar_owner"><br>
      <input type="submit"><br>
   </form>
</body>
</html>