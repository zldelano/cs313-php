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

      try
      {
         if (isset($_POST['newcust_email']))
         {
            // set up variables for binding
            $newcust_email           = htmlspecialchars($_POST['newcust_email']);
            $newcust_name_first      = htmlspecialchars($_POST['newcust_name_first']);
            $newcust_name_second     = htmlspecialchars($_POST['newcust_name_second']);
            $newcust_phone_primary   = htmlspecialchars($_POST['newcust_phone_primary']);
            $newcust_phone_secondary = htmlspecialchars($_POST['newcust_phone_secondary']);
            $newcust_address_id      = htmlspecialchars($_POST['newcust_address_id']);

            $stmt = $db->prepare("INSERT INTO service_customer (customer_email, name_first, name_second, phone_primary, phone_secondary, address_id)
                                  VALUES (:email, :name_first, :name_second, :phone_primary, :phone_secondary, :address_id)");
            $stmt->bindParam(':email', $newcust_email);
            $stmt->bindParam(':name_first', $newcust_name_first);
            $stmt->bindParam(':name_second', $newcust_name_second);
            $stmt->bindParam(':phone_primary', $newcust_phone_primary);
            $stmt->bindParam(':phone_secondary', $newcust_phone_secondary);
            $stmt->bindParam(':address_id', $newcust_address_id);
            $stmt->execute();
         }
         if (isset($_POST['newaddr_street']))
         {
            //
         }

         // generate a list of customers for the user to use as reference in an input box
         $stmt = $db->prepare('SELECT * FROM service_address');
         $stmt->execute();
         $rows_service_address = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      catch (PDOException $ex)
      {
         echo 'Error!: ' . $ex->getMessage();
         die();
      }

      // make a datalist of addresses
      $datalist_name_addresses = "addresses";
      echo "<datalist id=$datalist_name_addresses>";
      foreach ($rows_service_address as $row_address)
      {
         $address_id = $row_address['address_id'];
         $street     = $row_address['street'];
         $city       = $row_address['city'];
         $zip        = $row_address['zip'];
         $state      = $row_address['state'];
         $apt_number = $row_address['apt_number'];
         echo "<option value=$address_id>$street $city, $state $zip</option>";
      }
      echo "</datalist>";
   ?>
   <h1>New Customer</h1>
   <form action="new_car.php" method="post">
      <table>
         <tr>
            <td>Email:</td>            <td><input type="text" name="newcust_email" required></td>
         </tr>
         <tr>
            <td>First name:</td>       <td><input type="text" name="newcust_name_first" required></td>
         </tr>
         <tr>
            <td>Second name:</td>      <td><input type="text" name="newcust_name_second" required></td>
         </tr>
         <tr>
            <td>Phone (primary):</td>  <td><input type="text" name="newcust_phone_primary" required></td>
         </tr>
         <tr>
            <td>Phone (secondary):</td><td><input type="text" name="newcust_phone_secondary" required></td>
         </tr>
         <tr>
            <td>Address:</td>          <td><input type="text" name="newcust_address_id" list="addresses" required></td>
         </tr>
      </table>
      <input type="submit"><br>
   </form>
   <h1>New Address</h1>
   <form action="new_car.php" method="post">
      <table>
      <tr>
         <td>Street:</td>           <td><input type="text" name="newaddr_street" required></td>
      </tr>
      <tr>
         <td>City:</td>             <td><input type="text" name="newaddr_city" required></td>
      </tr>
      <tr>
         <td>Zip:</td>              <td><input type="text" name="newaddr_zip" required></td>
      </tr>
      <tr>
         <td>State:</td>            <td><input type="text" name="newaddr_state" required></td>
      </tr>
      <tr>
         <td>Apartment Number:</td> <td><input type="text" name="newaddr_apt_number"></td>
      </tr>
      </table>
      <input type="submit"><br>
   </form>
</body>
</html>