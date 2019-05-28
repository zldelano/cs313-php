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
   <!-- <input type="checkbox" name="" id=""> -->
   <?php
      require 'nav.php';

      try
      {
         require 'db_connect.php';

         // execute statement to get topics
         $stmt = $db->prepare('SELECT id, name FROM teach06_topic');
         $stmt->execute();
         $rows_topic = $stmt->fetchAll(PDO::FETCH_ASSOC);

         echo "<form action='index.php' method='post'>";
         echo "<table style='width:80%'>";
         echo "<tr>";
         echo "<td>Book</td><td><input type='text' name='newscrip_book'></td>";
         echo "<td>Chapter</td><td><input type='text' name='newscrip_chapter'></td>";
         echo "<td>Verse</td><td><input type='text' name='newscrip_verse'></td>";
         echo "<td>Content</td><td><textarea name='newscrip_verse'>Content of scripture...</textarea></td>";
         echo "<td>Topics</td><td>";
         foreach ($rows_topic as $topic) {
            $topic_name = $topic['name'];
            $topic_id = $topic['id'];
            echo "<input type='checkbox' name='$topic_name' id='$topic_id'><br>";
         }
         echo "</td>";
         echo "</tr>";
         echo "</table>";
         echo "</form>";
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