<?php

header("content-type:application/json");

#print_r($_POST);

#var_dump($_POST);

#$path=$_POST["path"];

$date = new DateTime('now');

var_dump($_POST);

var_dump($date);

#$lat=floatval($_POST["lat"]);
#$lon=floatval($_POST["lon"]);
#$desc=$_POST["desc"];

echo "{'test':'value'}"


?>