<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include 'nav.php';
        if (isset($_POST['logout'])){
            unset($_SESSION['user']);
        }
    ?>
    <h1>Login</h1>
    <form action="home.php" method="post">
        <input type="text" name="username">
        <br>
        <input type="text" name="password">
        <input type="submit" value="Login">
    </form>
</body>
</html>