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

      try
      {
         $dbUrl = getenv('DATABASE_URL');

         $dbOpts = parse_url($dbUrl);

         $dbHost = $dbOpts["host"];
         $dbPort = $dbOpts["port"];
         $dbUser = $dbOpts["user"];
         $dbPassword = $dbOpts["pass"];
         $dbName = ltrim($dbOpts["path"],'/');

         $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

         // this line makes PDO give us an exception when there are problems,
         // and can be very helpful in debugging! (But you would likely want
         // to disable it for production environments.)
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         // queries
         foreach ($db->query('SELECT name_first, name_second, role FROM service_employee') as $row)
         {
            echo 'First name: ' . $row['name_first'];
            echo 'Last name: ' . $row['name_second'];
            echo 'Role: ' . $row['role'];
            echo '<br/>';
         }
      }
      catch (PDOException $ex)
      {
         echo 'Error!: ' . $ex->getMessage();
         die();
      }
   ?>
   <h1>Assignments</h1>
   <a href="https://damp-reef-55379.herokuapp.com/prove/03/browse.php">Prove 03 - Shopping Cart</a>
 
</body>
</html>