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
   <!-- <input type="checkbox" name="" id=""> -->
   <?php
      require 'nav.php';
      echo "<h1>Scripture Resources</h1>";      
      try
      {
         require 'db_connect.php';

         // execute statement to get topics
         $stmt = $db->prepare('SELECT id, name FROM teach06_topic');
         $stmt->execute();
         $rows_topic = $stmt->fetchAll(PDO::FETCH_ASSOC);

         if (isset($_POST['topics']))
         {
            echo "Have we hit the condition where topics is set?<br>";
            $newscrip_topics = $_POST['topics'];
            $newscrip_book = $_POST['newscrip_book'];
            $newscrip_chapter = $_POST['newscrip_chapter'];
            $newscrip_verse = $_POST['newscrip_verse'];
            $newscrip_content = $_POST['newscrip_content'];
            $newscrip_stmt = $db->prepare("INSERT INTO teach06_scripture ('book', 'chapter', 'verse', 'content')
                                           VALUES ($newcrip_book, $newscrip_chapter, $newscrip_verse, $newscrip_content)");
            $newscrip_stmt->execute();

            $last_newscrip_id = $db->lastInsertId('id');

            foreach ($newscrip_topics as $topic)
            {
               $scrip_topic_stmt = $db->prepare("INSERT INTO teach06_join_scripture_topic ('scripture_id', 'topic_id')
                                                 VALUES ($last_newscrip_id, $topic)");
               $scrip_topic_stmt->execute();
               echo "$topic was selected<br>";
            }
         }

         echo "<form action='new_scrip.php' method='post'>";
         echo "<table style='width:80%'>";
         echo "<tr><td>Book</td><td><input type='text' name='newscrip_book'></td></tr>";
         echo "<tr><td>Chapter</td><td><input type='text' name='newscrip_chapter'></td></tr>";
         echo "<tr><td>Verse</td><td><input type='text' name='newscrip_verse'></td></tr>";
         echo "<tr><td>Content</td><td><textarea name='newscrip_verse'>Content of scripture...</textarea></td></tr>";
         echo "<tr><td>Topics</td><td>";
         foreach ($rows_topic as $topic) {
            $topic_name = $topic['name'];
            $topic_id = $topic['id'];
            echo "<input type='checkbox' name='topics[]' value='$topic_id'> $topic_name<br>";
         }
         echo "</td></tr>";
         echo "</table>";
         echo "<input type='submit'>";
         echo "</form>";
      }
      catch (PDOException $ex)
      {
         echo 'Error!: ' . $ex->getMessage();
         die();
      }
      ?>
 
</body>
</html>