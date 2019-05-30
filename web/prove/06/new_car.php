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
      
      if (len($_POST) > 0)
      {
         try
         {
            // only connect if the user submitted a form
            require 'db_connect.php';

            $newcar_stmt = $db->prepare("INSERT INTO service_vehicle
                                       (vin, color, make, model, year, owner)
                                       VALUES (:vin, :color, :make, :model, :year, :owner)");
            $newscrip_stmt->bindParam(':vin', htmlspecialchars($_POST['newcar_vin']));
            $newscrip_stmt->bindParam(':color', htmlspecialchars($_POST['newcar_color']));
            $newscrip_stmt->bindParam(':make', htmlspecialchars($_POST['newcar_make']));
            $newscrip_stmt->bindParam(':model', htmlspecialchars($_POST['newcar_model']));
            $newscrip_stmt->bindParam(':year', htmlspecialchars($_POST['newcar_year']));
            $newscrip_stmt->bindParam(':owner', htmlspecialchars($_POST['newcar_owner']));
            $newscrip_stmt->execute();
            echo "New vehicle successfully added!";
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
   <form action="new_car.php" method="post">
      <table>
         <tr>
            <td>VIN:</td>         <td><input type="text" name="newcar_vin"   required><br></td>
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
            <td>Year:</td>        <td><input type="text" name="newcar_year"  required><br></td>
         </tr>
         <tr>
            <td>Owner email:</td> <td><input type="text" name="newcar_owner" required><br></td>
         </tr>
      </table>
      <input type="submit"><br>
   </form>
</body>
</html>