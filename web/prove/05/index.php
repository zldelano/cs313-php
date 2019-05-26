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

         // get the list of technicians the advisor can select from
         $stmt = $db->prepare('SELECT name_first, name_second, username FROM service_employee WHERE role=\'technician\'');
         $stmt->execute();
         $service_employee_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
      echo "The list of jobs and technicians<br>";

      $ji_length=sizeof($service_job_info_rows);
      for ($i = 1; $i <= $ji_length; $i++) {
         // jobs
         echo "Job:<br>";
         echo "<select name=$job_name_field>";
         echo "<option value=0>None</option>";
         foreach ($service_job_info_rows as $ji)
         {
            $job_name=$ji['job_name'];
            echo "<option value=$i>$job_name</option>";
         }
         echo "</select><br>";

         // technicians
         echo "Assigned Technician";
         echo "<select name=$tech_name_field>";
         echo "<option value=0>None</option>";
         foreach ($service_employee_rows as $tech)
         {
            $tech_name_first=$tech['name_first'];
            $tech_name_second=$tech['name_second'];
            echo "<option value=$i>$tech_name_second, $tech_name_first</option>";
         }
         echo "</select><br><br>";
      }
      // echo "Job #1:         <input type=\"text\" name=$job_name_field><br>";
      // echo "Job #1 Tech:    <input type=\"text\" name=$tech_name_field><br>";
      echo "</form>"
   ?>
</body>
</html>