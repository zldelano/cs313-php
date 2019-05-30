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

      function gen_uuid() {
         return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
             // 32 bits for "time_low"
             mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
     
             // 16 bits for "time_mid"
             mt_rand( 0, 0xffff ),
     
             // 16 bits for "time_hi_and_version",
             // four most significant bits holds version number 4
             mt_rand( 0, 0x0fff ) | 0x4000,
     
             // 16 bits, 8 bits for "clk_seq_hi_res",
             // 8 bits for "clk_seq_low",
             // two most significant bits holds zero and one for variant DCE1.1
             mt_rand( 0, 0x3fff ) | 0x8000,
     
             // 48 bits for "node"
             mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
         );
     }
   
      try
      {
         require 'db_connect.php';

         // execute statement to get topics
         $stmt = $db->prepare('SELECT id, name FROM teach06_topic');
         $stmt->execute();
         $rows_topic = $stmt->fetchAll(PDO::FETCH_ASSOC);

         if (isset($_POST['topics']))
         {
            $newscrip_topics = $_POST['topics'];
            $newscrip_book = $_POST['newscrip_book'];
            $newscrip_chapter = $_POST['newscrip_chapter'];
            $newscrip_verse = $_POST['newscrip_verse'];
            $newscrip_content = $_POST['newscrip_content'];
            $newscrip_id = gen_uuid();
            echo "debug topics: $newscrip_topics<br>";
            echo "debug book: $newscrip_book<br>";
            echo "debug chapter: $newscrip_chapter<br>";
            echo "debug verse: $newscrip_verse<br>";
            echo "debug content: $newscrip_content<br>";
            // echo "debug id: $newscrip_id<br>";

            $newscrip_stmt = $db->prepare("INSERT INTO teach06_scripture (id, book, chapter, verse, content)
                                           VALUES ($newscrip_id, $newscrip_book, $newscrip_chapter, $newscrip_verse, $newscrip_content)
                                           RETURNING id");
            // $newscrip_id_row = pg_fetch_array($newscrip_stmt);
            // $newscrip_id = $newscrip_id_row['id'];

            echo "newscrip_stmt" . var_dump($newscrip_stmt) . "</br>";
            echo "new_scrip_id_row" . var_dump($newscrip_id_row) . "</br>";
            echo "Have we gotten to this? newscrip_id: $newscrip_id<br>";

            foreach ($newscrip_topics as $topic)
            { 
               echo "topic: $topic<br>";
               $scrip_topic_stmt = $db->prepare("INSERT INTO teach06_join_scripture_topic (scripture_id, topic_id)
                                                 VALUES ($newscrip_id, $topic)");
               $scrip_topic_stmt->execute();
            }
         }

         echo "<form action='new_scrip.php' method='post'>";
         echo "<table style='width:80%'>";
         echo "<tr><td>Book</td><td><input type='text' name='newscrip_book'></td></tr>";
         echo "<tr><td>Chapter</td><td><input type='text' name='newscrip_chapter'></td></tr>";
         echo "<tr><td>Verse</td><td><input type='text' name='newscrip_verse'></td></tr>";
         echo "<tr><td>Content</td><td><textarea name='newscrip_content'>Content of scripture...</textarea></td></tr>";
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