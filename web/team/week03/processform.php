<?php
$name = $_POST["name"];
$email = $_POST["email"];
$major = $_POST["major"];
$comments = $_POST["comments"];
$continents = $_POST["continents"];

echo "$name <br>";
echo "<a href=\"mailto:$email\">$email</a><br>";
echo "$major<br>";
echo "$comments<br>";
foreach ($continents as $continent) {
   echo "$continent<br>";
}
?>