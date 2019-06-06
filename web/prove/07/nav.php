<header>
    <div class="container">
        <img src="img/logo_black.png" alt="logo" class="logo" width="147px" height="18px">
        <nav>
            <ul>
                <?php
                    echo "<li><a href='./new_customer.php'>New Customer</a></li>";
                    echo "<li><a href='./new_car.php'>New Car</a></li>";
                    echo "<li><a href='./index.php'>New Service</a></li>";
                    echo "<li><a href='./unfinished_services.php'>Unfinished Services</a></li>";
                    echo "<li><a href='./login.php'>Logout</a></li>";
                ?>
            </ul>
        </nav>
    </div>
</header>
<?php
    $curr_file = basename($_SERVER['PHP_SELF']);
    if (!isset($_SESSION['user']) && $curr_file != "login.php")
    {
        echo "not logged in... redirecting";
        header('Location: login.php');
        die();
    }
?>