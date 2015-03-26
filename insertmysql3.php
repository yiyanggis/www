<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname="test";

//header("Content-type: text/xml");

//$dom = new DOMDocument("1.0");
//$node = $dom->createElement("markers");
//$parnode = $dom->appendChild($node);

header("content-type:application/json");

var_dump($_POST);

foreach($_FILES as $file)
    {
        move_uploaded_file($file['tmp_name'], 'test.jpg');

    }

//move_uploaded_file($tmpName,"test.jpg");

?>