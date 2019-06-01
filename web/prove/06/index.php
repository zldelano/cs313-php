<!DOCTYPE html>
<html lang="en">
<head>
   <link href="https://fonts.googleapis.com/css?family=Work+Sans:400">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <link rel="stylesheet" href="style.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <script src="script.js"></script>
</head>
<body>
   <?php
      require 'nav.php';
      require 'db_connect.php';

      // set session vars
      $_SESSION['user'] = htmlspecialchars($_POST['user']);
   ?>
   <h1>New Service</h1>
   <?php
      $job_name_field='newservice_jobs[]';
      $tech_name_field='new_service_job_tech[]';

      $rows_service_job_info = null;
      $rows_service_employee = null;
      try {
         // get the list of jobs the advisor can select from
         $stmt = $db->prepare('SELECT job_name, cost FROM service_job_info');
         $stmt->execute();
         $rows_service_job_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

         // get the list of technicians the advisor can select from
         $stmt = $db->prepare('SELECT name_first, name_second, username FROM service_employee WHERE role=\'technician\'');
         $stmt->execute();
         $rows_service_employee = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      catch (PDOException $ex)
      {
         echo 'Error!: ' . $ex->getMessage();
         die();
      }

      echo '<form action="index.php" method="post">';
      echo '<table>';
      echo '<tr><td>VIN:</td>            <td><input type="text" name="new_service_vin"></td></tr>';
      echo '<tr><td>Customer email:</td> <td><input type="text" name="new_service_email"></td></tr>';
      echo '<tr><td>Notes:</td>          <td><textarea name="new_service_notes" id="notes"></textarea></td></tr>';

      // technician row
      echo '<tr><td>Technician:</td><td>';
      // technician row: fill in right cell with technician options
      echo "<select name=$tech_name_field>";
      echo '<option value=0>None</option>';
      foreach ($rows_service_employee as $tech)
      {
         $tech_name_first=$tech['name_first'];
         $tech_name_second=$tech['name_second'];
         echo "<option value=$i>$tech_name_second, $tech_name_first</option>";
      }
      echo "</select></td></tr>";

      // jobs row
      echo '<tr><td>Jobs:</td><td>';
      // jobs row: fill in right cell with job options
      echo '<div class="checkbox-group required">';
      foreach ($rows_service_job_info as $ji)
      {
         $job_name=$ji['job_name'];
         echo "<input type='checkbox' name='new_service_jobs[]' value='$job_name'>$job_name<br>";
      }
      echo '</div>';
      echo "</td></tr>";
      echo '</table>';
      echo '</form>';
   ?>
</body>
</html>