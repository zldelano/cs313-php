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
      require 'nav_login.php';
      require 'db_connect.php';

      // logout if logged in
      if (isset($_SESSION['user']))
      {
         unset($_SESSION['user']);
         session_destroy();
      }

      // upon login...
      session_set_cookie_params(7200); // 2 hours, not 2 seconds
      session_start();
   ?>
   <h1>Login</h1>

   <form action="index.php" method="post">
   Username: <input type="text" name="user">
   </form>
 
</body>
</html>