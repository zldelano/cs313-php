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

      // set session vars
      $_SESSION['user'] = htmlspecialchars($_POST['user']);

      // set these up for saving user input upon error
      $dummy_vin = "00000000000000000";
      $input_vin   = $dummy_vin;
      $input_email = "";
      $input_notes = "";
      $input_tech  = "";
      
      // this is how we check if at least one of the checkboxes was selected
      if (isset($_POST['new_service_vin']) && !isset(_POST['new_service_jobs']))
      {
         echo '<div class="error">No jobs selected for service.</div>';
         
            // save the user's input if they made a mistake
            $input_vin = $_POST['new_service_vin'];
            $input_email = $_POST['new_service_email'];
            $input_notes = $_POST['new_service_notes'];
            $input_tech = $_POST['new_service_tech'];
      }
      else
      {
         try {
            $ns_id    = gen_uuid();
            $ns_vin   = $_POST['new_service_vin']; // ns stands for "new service"
            $ns_email = $_POST['new_service_email'];
            $ns_notes = $_POST['new_service_notes'];
            $ns_tech  = $_POST['new_service_tech'];

            // set up the statement
            $stmt = $db->prepare('INSERT INTO service_service
                                 VALUES (:id, :vin, :email, :notes, :tech)');
            $stmt->bindParam(':id', htmlspecialchars($ns_id));
            $stmt->bindParam(':vin', htmlspecialchars($ns_vin));
            $stmt->bindParam(':email', htmlspecialchars($ns_email));
            $stmt->bindParam(':notes', htmlspecialchars($ns_notes));
            $stmt->bindParam(':tech', htmlspecialchars($ns_tech));
            $stmt->execute();
         }
         catch (PDOException $ex)
         {
            echo 'Error!: ' . $ex->getMessage();
            die();
         }
      }
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

      if ($input_vin==$dummy_vin)
         $input_vin="";

      echo '<form action="index.php" method="post">';
      echo '<table>';
      echo "<tr><td>VIN:</td>            <td><input type=\"text\" name=\"new_service_vin\" value=$input_vin required></td></tr>";
      echo "<tr><td>Customer email:</td> <td><input type=\"text\" name=\"new_service_email\" value=$input_email required></td></tr>";
      echo "<tr><td>Notes:</td>          <td><textarea name=\"new_service_notes\" id=\"notes\" value=$input_notes required></textarea></td></tr>";

      // technician row
      echo '<tr><td>Technician:</td><td>';
      // technician row: fill in right cell with technician options
      echo "<select name=$tech_name_field required>";
      echo '<option value="">None</option>';
      foreach ($rows_service_employee as $tech)
      {
         $tech_name_first=$tech['name_first'];
         $tech_name_second=$tech['name_second'];
         $tech_username=$tech['username'];
         $tech_is_selected="";
         if ($input_tech==$tech_username)
            $tech_is_selected="selected=\"selected\"";
         echo "<option value=$tech_username $tech_is_selected>$tech_name_second, $tech_name_first</option>";
      }
      echo "</select></td></tr>";

      // jobs row
      echo '<tr><td>Jobs:</td><td>';
      // jobs row: fill in right cell with job options
      // echo '<div class="checkbox-group required">';
      foreach ($rows_service_job_info as $ji)
      {
         $job_name=$ji['job_name'];
         echo "<input type='checkbox' name='new_service_jobs[]' value='$job_name'>$job_name<br>";
      }
      // echo '</div>';
      echo "</td></tr>";
      echo '</table><input type="submit">';
      echo '</form>';
   ?>
</body>
</html>