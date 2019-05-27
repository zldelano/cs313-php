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
   <h1>Unfinished Services</h1>
   <?php
      try {
         // get the list of jobs the advisor can select from
         $stmt = $db->prepare('SELECT * FROM unfinished_services');
         $stmt->execute();
         $unfinished_service_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      catch (PDOException $ex)
      {
         echo 'Error!: ' . $ex->getMessage();
         die();
      }

      // initialize these now so we can check for them right away in the loop
      $us_time_end         = null;
      $us_customer_email   = null;
      $us_technician       = null;

      // go over the unfinished services
      echo '<table style="width:80%">';
      echo '<tr><th>Customer</th><th>Job</th><th>Technician</th></tr>';
      foreach ($unfinished_service_rows as $unfinished_service)
      {
         $us_time_end         = $unfinished_service['time_end'];
         $us_customer_email   = $unfinished_service['customer_email'];
         $us_job_name         = $unfinished_service['job_name'];
         $us_technician       = $unfinished_service['technician'];
         $us_job_id           = $unfinished_service['job_id'];

         // populate the table cells
         echo "<tr>";
         echo "<td>$us_customer_email</td>";
         echo "<td>$us_job_name</td>";
         echo "<td>$us_technician</td>";
         echo "<td><form action=\"unfinished_services.php\" method=\"post\"><input type=\"submit\" name=$job_id value=\"finish job\"></form></td>";
         echo "</tr>";
      }
      echo '</table>';
   ?>
</body>
</html>