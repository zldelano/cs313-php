<?php
   if (isset($_POST['user']))
   {
      $_SESSION['user'] = htmlspecialchars($_POST['user']);
   }
?>
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

      // if (is_null($post_user))
      //    echo "post_user is null right now<br>";
      
      // if (isset($post_user))
      //    echo "post_user is set right now<br>";

      // set these up for saving user input upon error
      $dummy_vin = "00000000000000000";
      $input_vin   = $dummy_vin;
      $input_email = "";
      $input_notes = "";
      $input_tech  = "";
      
      // this is how we check if at least one of the checkboxes was selected
      if (isset($_POST['new_service_vin']) && !isset($_POST['new_service_jobs']))
      {
         echo '<div class="error">No jobs selected for service.</div>';
         
            // save the user's input if they made a mistake
            $input_vin = $_POST['new_service_vin'];
            $input_email = $_POST['new_service_email'];
            $input_notes = $_POST['new_service_notes'];
            $input_tech = $_POST['new_service_tech'];
      }
      else if (isset($_POST['new_service_jobs']))
      {
         try {
            // set up vars for service
            $ns_id      = gen_uuid();
            $ns_vin     = (int)filter_var($_POST['new_service_vin'], FILTER_SANITIZE_NUMBER_INT); // ns stands for "new service"
            $ns_email   = htmlspecialchars($_POST['new_service_email']);
            $ns_notes   = htmlspecialchars($_POST['new_service_notes']);
            $ns_advisor = $_SESSION['user'];

            // set up the statement for inserting a service
            $stmt = $db->prepare("INSERT INTO service_service (service_id, vin, customer_email, notes, advisor)
                                  VALUES (:id, to_number(:vin, '99999999999999999'), :email, :notes, :advisor)");
            $stmt->bindParam(':id', $ns_id);
            $stmt->bindParam(':vin', $ns_vin);
            $stmt->bindParam(':email', $ns_email);
            $stmt->bindParam(':notes', $ns_notes);
            $stmt->bindParam(':advisor', $ns_advisor);
            $stmt->execute();

            // set up vars for jobs
            $nj_tech = htmlspecialchars($_POST['new_service_tech']);
            $ns_jobs = $_POST['new_service_jobs'];

            // insert the jobs
            foreach ($ns_jobs as $ns_job)
            {
               $nj_id = gen_uuid();
               $nj_time = time();
               $stmt = $db->prepare("INSERT INTO service_job (job_id, service_id, technician, job_name, time_start)
                                    VALUES (:nj_id, :ns_id, :nj_tech, :ns_job, :nj_time)");
               $stmt->bindParam(':nj_id', $nj_id);
               $stmt->bindParam(':ns_id', $ns_id);
               $stmt->bindParam(':nj_tech', $nj_tech);
               $stmt->bindParam(':ns_job', $ns_job);
               $stmt->bindParam(':nj_time', $nj_time);
               $stmt->execute();
            }
         }
         catch (PDOException $ex)
         {
            echo 'Error!: ' . $ex->getMessage();
            die();
         }
         catch (Exception $e)
         {
            echo "Error!: $e";
            die();
         }
      }
   ?>
   <h1>New Service</h1>
   <?php
      $job_name_field='new_service_jobs[]';
      $tech_name_field='new_service_tech';

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
         $input_vin=null;

      echo '<form action="index.php" method="post">';
      echo '<table>';
      echo "<tr><td>VIN:</td>            <td><input type=\"number\" name=\"new_service_vin\"  required value=$input_vin></td></tr>";
      echo "<tr><td>Customer email:</td> <td><input type=\"email\" name=\"new_service_email\" required value=$input_email></td></tr>";
      echo "<tr><td>Notes:</td>          <td><textarea name=\"new_service_notes\" id=\"notes\" required>$input_notes</textarea></td></tr>";
      // https://www.w3schools.com/tags/tag_datalist.asp for the future for customer emails

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
            $tech_is_selected="selected";
         echo "<option name=$tech_username value=$tech_username $tech_is_selected>$tech_name_second, $tech_name_first</option>";
         echo "$tech_username<br>";
      }
      echo "</select></td></tr>";
      
      // jobs row
      echo '<tr><td>Jobs:</td><td>';
      // jobs row: fill in right cell with job options
      foreach ($rows_service_job_info as $ji)
      {
         $job_name=$ji['job_name'];
         echo "<input type='checkbox' name='$job_name_field' value='$job_name'>$job_name<br>";
      }
      echo "</td></tr>";
      echo '</table><input type="submit">';
      echo '</form>';
   ?>
</body>
</html>