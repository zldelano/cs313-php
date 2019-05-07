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
echo "<b>Continents visited:</b><br>";
$continents_map = array("na" => "North America",
                        "sa" => "South America",
                        "eu" => "Europe",
                        "as" => "Asia",
                        "au" => "Australia",
                        "af" => "Africa",
                        "an" => "Antarctica");
foreach ($continents as $continent) {
   echo "$continents_map[$continent]<br>";
}
?>