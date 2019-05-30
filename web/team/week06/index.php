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
      echo "<h1>Scripture Resources</h1>";
      
      try
      {
         require 'db_connect.php';
         $book = '';
         $the_id = null;

         if (isset($_POST['book'])) {
            $book =  htmlspecialchars($_POST['book']);
         }

         if (isset($_GET['id'])) {
            $the_id = htmlspecialchars($_GET['id']);
         }

         if ($book == '')
            $the_query = 'SELECT id, book, chapter, verse, content FROM teach06_scripture';
         else
            $the_query = "SELECT id, book, chapter, verse, content FROM teach06_scripture WHERE book='$book'";

         // queries
         foreach ($db->query($the_query) as $row)
         {
            $id = $row['id'];
            $topics_query = "SELECT s.book AS book, s.chapter AS chapter, s.verse AS verse, jst.scripture_id AS scripture_id, t.name AS name
                             FROM teach06_scripture AS s
                             JOIN teach06_join_scripture_topic AS jst
                             ON s.id=jst.scripture_id
                             JOIN teach06_topic AS t
                             ON jst.topic_id=t.id
                             WHERE jst.scripture_id='$id'";
            $scripture = $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'];
            echo "<a href=index.php?id=$id>" . $scripture . '</a>' .'<br>';
            foreach ($db->query($topics_query) as $topics_row)
            {
               echo $topics_row['name'] . ", ";
            }
            echo '<br/>';
         }
         
         if (!is_null($the_id))
         {
            $stmt = $db->prepare('SELECT content, book, chapter, verse FROM teach06_scripture WHERE id=:id');
            $stmt->bindValue(':id', $the_id, PDO::PARAM_STR);
            $stmt->execute();
            $the_row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<h2>Content</h2>";
            $the_book    = $the_row[0]['book'];
            $the_chapter = $the_row[0]['chapter'];
            $the_verse   = $the_row[0]['verse'];
            $the_content = $the_row[0]['content'];
            echo "<h3>$the_book $the_chapter:$the_verse</h3>";
            echo "<p>$the_content</p>";
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