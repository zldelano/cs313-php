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

      $service_job_info_rows = null;
      try {
         // get the list of jobs the advisor can select from
         $stmt = $db->prepare('SELECT job_name, cost FROM service_job_info');
         $stmt->execute();
         $service_job_info_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      catch (PDOException $ex)
      {
         echo 'Error!: ' . $ex->getMessage();
         die();
      }

      echo '<form action="index.php" method="post">';
      echo 'VIN:            <input type="text" name="new_service_vin"><br>';
      echo 'Customer phone: <input type="text" name="new_service_phone"><br>';
      echo '<textarea name="new_service_notes" id="notes">Notes</textarea><br>';
      
      $ji_length=sizeof($service_job_info_rows);
      echo "the length of the query is $ji_length<br>";
      for ($i = 1; i <= $ji_length; $i++) {
         echo "<select name=$job_name_field>";
         foreach ($service_job_info_rows as $ji)
         {
            $option_value=$ji['job_name'];
            echo "<option value=$i>$option_value</option>";
         }
         echo "</select>";
      echo "test";
      }
      // echo "Job #1:         <input type=\"text\" name=$job_name_field><br>";
      // echo "Job #1 Tech:    <input type=\"text\" name=$tech_name_field><br>";
      echo "</form>"
   ?>
</body>
</html>