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
   ?>
   <h1>Adam's Service Drive</h1>
   <?php
      $job_name_field='newservice_jobs[]';
      $tech_name_field='new_service_job_tech[]';

      // get the list of jobs the advisor can select from
      $stmt = $db->prepare('SELECT job_name, price FROM service_job_info');
      $stmt->execute();
      $service_job_info_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // $the_chapter = $the_row[0]['chapter'];
            // $the_verse   = $the_row[0]['verse'];
            // $the_content = $the_row[0]['content'];
            // echo "<h3>$the_book $the_chapter:$the_verse</h3>";
            // echo "<p>$the_content</p>";

      echo '<form action="index.php" method="post">';
      echo 'VIN:            <input type="text" name="new_service_vin"><br>';
      echo 'Customer phone: <input type="text" name="new_service_phone"><br>';
      echo '<textarea name="new_service_notes" id="notes">Notes</textarea><br>';
      
      $ji_length=sizeof($service_job_info_rows);
      for ($i = 1; i <= $ji_length; $i++) {
         echo "<select name=$job_name_field>";
         foreach ($service_job_info_rows as $ji)
         {
            $option_value=$ji['job_name'];
            echo "<option value=$i>$option_value</option>";
         }
         echo "</select>";
      }
      // echo "Job #1:         <input type=\"text\" name=$job_name_field><br>";
      // echo "Job #1 Tech:    <input type=\"text\" name=$tech_name_field><br>";
      echo "</form>"
   ?>
</body>
</html>