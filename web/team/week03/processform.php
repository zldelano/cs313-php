<?php
$name = $_POST["name"];
$email = $_POST["email"];
$major = $_POST["major"];
$comments = $_POST["comments"];

echo "$name <br>";
echo "<a href=\"mailto:$email\">$email</a><br>";
echo "$major<br>";
echo "$comments<br>";
?>