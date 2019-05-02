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
        if (isset($_POST['username'])){
            session_start();
            $_SESSION['user'] = $_POST['username'];
        }
        if (!isset($_SESSION['user'])){
            header('Location: /week02/login.php');
        }
    ?>
    <h1>Home</h1>
    <form action="login.php" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
    <?php
        if (isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            echo "<h1>Welcome $user!</h1>";
        }
    ?>
</body>
</html>