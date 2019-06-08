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
            $newaddr_street = htmlspecialchars($_POST['newaddr_street']);
            $newaddr_city = htmlspecialchars($_POST['newaddr_city']);
            $newaddr_zip = htmlspecialchars($_POST['newaddr_zip']);
            $newaddr_state = htmlspecialchars($_POST['newaddr_state']);
            $newaddr_apt_number = htmlspecialchars($_POST['newaddr_apt_number']);

            $stmt = $db->prepare("INSERT INTO service_address (city, street, zip, state)
                                  VALUES (:city, :street, :zip, :state)");
            if (isset($_POST['newaddr_apt_number']))
            {
               $stmt = $db->prepare("INSERT INTO service_address (city, street, zip, state, apt_number)
                                     VALUES (:city, :street, :zip, :state, :apt_number)");
               $stmt->bindParam(':apt_number', $newaddr_apt_number);
            }
            $stmt->bindParam(':city', $newaddr_city);
            $stmt->bindParam(':street', $newaddr_street);
            $stmt->bindParam(':zip', $newaddr_zip);
            $stmt->bindParam(':state', $newaddr_state);
            $stmt->execute();
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
   <form action="new_customer.php" name="form_customer" onsubmit="return validateFormCustomer()" method="post">
      <table>
         <tr>
            <td>Email:</td>            <td><input type="email" name="newcust_email" required></td>
         </tr>
         <tr>
            <td>First name:</td>       <td><input type="text" name="newcust_name_first" required></td>
         </tr>
         <tr>
            <td>Second name:</td>      <td><input type="text" name="newcust_name_second" required></td>
         </tr>
         <tr>
            <td>Phone (primary):</td>  <td><input type="text" name="newcust_phone_primary" class="phone" placeholder="Ex: '1234567890'" required></td>
         </tr>
         <tr>
            <td>Phone (secondary):</td><td><input type="text" name="newcust_phone_secondary" class="phone" placeholder="Ex: '1234567890'" required></td>
         </tr>
         <tr>
            <td>Address:</td>          <td><input type="text" name="newcust_address_id" list="addresses" required></td>
         </tr>
      </table>
      <input type="submit"><br>
   </form>
   <h1>New Address</h1>
   <form action="new_address.php" name="form_address" onsubmit="return validateFormAddress()" method="post">
      <table>
      <tr>
         <td>Street:</td>           <td><input type="text" name="newaddr_street" required></td>
      </tr>
      <tr>
         <td>City:</td>             <td><input type="text" name="newaddr_city" required></td>
      </tr>
      <tr>
         <td>Zip:</td>              <td><input type="text" name="newaddr_zip" class="zip" placeholder="Ex: '98052', etc." required></td>
      </tr>
      <tr>
         <td>State:</td>            <td><input type="text" name="newaddr_state" class="state" placeholder="Ex: 'WA', 'NY', etc." required></td>
      </tr>
      <tr>
         <td>Apartment Number:</td> <td><input type="text" name="newaddr_apt_number"></td>
      </tr>
      </table>
      <input type="submit"><br>
   </form>
</body>
</html>