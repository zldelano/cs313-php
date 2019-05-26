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
   <h1>Adam's Service Drive</h1>
   
   <form action="index.php" method="post">
   VIN:            <input type="text" name="new_service_vin"><br>
   Customer phone: <input type="text" name="new_service_phone"><br>
   <textarea name="new_service_notes" id="notes">Notes</textarea><br>
   </form>
 
   <?php
      // not sure what I'm going to put here
   ?>
</body>
</html>