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
   <h1>New Customer</h1>
   <form action="new_car.php" method="post">
      <table>
         <tr>
            <td>Email:</td>            <td><input type="text" name="newcust_email"></td>
         </tr>
         <tr>
            <td>First name:</td>       <td><input type="text" name="newcust_name_first"></td>
         </tr>
         <tr>
            <td>Second name:</td>      <td><input type="text" name="newcust_name_second"></td>
         </tr>
         <tr>
            <td>Phone (primary):</td>  <td><input type="text" name="newcust_phone_primary"></td>
         </tr>
         <tr>
            <td>Phone (secondary):</td><td><input type="text" name="newcust_phone_secondary"></td>
         </tr>
      </table>
      <input type="submit"><br>
   </form>
   <h1>New Address</h1>
   <form action="new_car.php" method="post">
      <table>
      <tr>
         <td>Street:</td>           <td><input type="text" name="newaddr_street"></td>
      </tr>
      <tr>
         <td>City:</td>             <td><input type="text" name="newaddr_city"></td>
      </tr>
      <tr>
         <td>Zip:</td>              <td><input type="text" name="newaddr_zip"></td>
      </tr>
      <tr>
         <td>State:</td>            <td><input type="text" name="newaddr_state"></td>
      </tr>
      <tr>
         <td>Apartment Number:</td> <td><input type="text" name="newaddr_apt_number"></td>
      </tr>
      </table>
      <input type="submit"><br>
   </form>
</body>
</html>