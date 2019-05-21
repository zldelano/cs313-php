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
   <h1>Scripture Resources</h1>
   <?php
      require 'nav.php';

      try
      {
         $book = '*';
         if (isset($_POST['book'])) {
            $book =  htmlspecialchars($_POST['book']);
         }

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
         foreach ($db->query('SELECT book, chapter, verse, content FROM teach04_scripture WHERE book=$book') as $row)
         {
            echo '<b>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</b> - ' . $row['content'] . '<br>';
            echo '<br/>';
         }
      }
      catch (PDOException $ex)
      {
         echo 'Error!: ' . $ex->getMessage();
         die();
      }
      ?>
      <form action="index.php" method="post">
         Book: <input type="text" name="book">
      </form>
 
</body>
</html>