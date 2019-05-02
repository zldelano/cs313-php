<header>
    <nav>
        <h3>AlphaCo.</h3>
        <ul>
            <?php
                $file = $_SERVER['PHP_SELF'];
                $home = "";
                $login = "";
                $about = "";
                if ($file == "/week02/home.php"){
                    $home = "highlight";
                }
                else if ($file == "/week02/about-us.php"){
                    $about = "highlight";
                }
                else if ($file == "/week02/login.php"){
                    $login = "highlight";
                }
                echo "<li class='$home'><a href='./home.php'>Home</a></li>";
                echo "<li class='$login'><a href='./login.php'>Login</a></li>";
                echo "<li class='$about'><a href='./about-us.php'>About</a></li>";
            ?>
        </ul>
    </nav>
</header>