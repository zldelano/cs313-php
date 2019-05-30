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
      <table>
         <tr>
         <td>VIN:</td>           <td><input type="text" name="newcar_vin"   required><br></td>
         </tr>
         <tr>
         <td>Color:</td>         <td><input type="text" name="newcar_color" required><br></td>
         </tr>
         <tr>
         <td>Make:</td>          <td><input type="text" name="newcar_make"  required><br></td>
         </tr>
         <tr>
         <td>Model:</td>         <td><input type="text" name="newcar_model" required><br></td>
         </tr>
         <tr>
         <td>Year:</td>          <td><input type="text" name="newcar_year"  required><br></td>
         </tr>
         <tr>
         <td>Owner email:</td>   <td><input type="text" name="newcar_owner" required><br></td>
         </tr>
      </table>
      <input type="submit"><br>
   </form>
</body>
</html>