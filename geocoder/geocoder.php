<?php

header("content-type:application/json");

//var_dump($_POST);

$url = $_POST["url"];
//$response = http_get($url);
$xml = file_get_contents($url);


echo json_encode($xml);


//move_uploaded_file($tmpName,"test.jpg");

?>