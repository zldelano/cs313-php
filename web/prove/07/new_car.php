<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css?family=Work+Sans:400">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <script src="script.js"></script>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <?php
      require 'nav.php';
      
      if (sizeof($_POST) > 0)
      {
         try
         {
            // only connect if the user submitted a form
            require('db_connect.php');

            // away from db setup and onto statements
            $newcar_stmt = $db->prepare("INSERT INTO service_vehicle
                                       (vin, color, make, model, year, owner)
                                       VALUES (:vin, :color, :make, :model, :year, :owner)");
            $newcar_stmt->bindParam(':vin', htmlspecialchars($_POST['newcar_vin']));
            $newcar_stmt->bindParam(':color', htmlspecialchars($_POST['newcar_color']));
            $newcar_stmt->bindParam(':make', htmlspecialchars($_POST['newcar_make']));
            $newcar_stmt->bindParam(':model', htmlspecialchars($_POST['newcar_model']));
            $newcar_stmt->bindParam(':year', htmlspecialchars($_POST['newcar_year']));
            $newcar_stmt->bindParam(':owner', htmlspecialchars($_POST['newcar_owner']));
            $newcar_stmt->execute();
            echo "New vehicle successfully added!<br>";
         }
         catch (PDOException $ex)
         {
            // GET RID OF THIS AT SOME POINT--DON'T GIVE UP THE WHOLE SHOP
            echo 'Error!: ' . $ex->getMessage();
            die();
         }
      }
   ?>
   <h1>New Car</h1>
   <form action="new_car.php" name="form_car" onsubmit="return validateFormCar()" method="post">
      <table>
         <tr>
            <td>VIN:</td>         <td><input type="text" class="vin" name="newcar_vin" placeholder="17 characters long" required><br></td>
         </tr>
         <tr>
            <td>Color:</td>       <td><input type="text" name="newcar_color" required><br></td>
         </tr>
         <tr>
            <td>Make:</td>        <td><input type="text" name="newcar_make"  required><br></td>
         </tr>
         <tr>
            <td>Model:</td>       <td><input type="text" name="newcar_model" required><br></td>
         </tr>
         <tr>
            <td>Year:</td>        <td><input type="text" name="newcar_year"  placeholder="4 characters long" required><br></td>
         </tr>
         <tr>
            <td>Owner email:</td> <td><input type="email" name="newcar_owner" required><br></td>
         </tr>
      </table>
      <input type="submit"><br>
   </form>
</body>
</html>