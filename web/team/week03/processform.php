<?php
$name = $_POST["name"];
$email = $_POST["email"];
$major = $_POST["major"];
$comments = $_POST["comments"];
$continents = $_POST["continents"];

echo "Name:\t$name <br>";
echo "Email:\t<a href=\"mailto:$email\">$email</a><br>";
echo "Major:\t$major<br>";
echo "Comments:\t$comments<br><br>";
echo "<b>Continents visited:</b><br>";
$continents_map = array("na" => "North America",
                        "sa" => "South America",
                        "eu" => "Europe",
                        "as" => "Asia",
                        "au" => "Australia",
                        "af" => "Africa",
                        "an" => "Antarctica");
foreach ($continents as $continent) {
   echo "\t\t$continents_map[$continent]<br>";
}
?>