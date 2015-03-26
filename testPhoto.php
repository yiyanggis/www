<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname="test";

//header("Content-type: text/xml");

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully<br/>";

$sql = "SELECT image from phototable where id = 13";
$result = $conn->query($sql);
  $row = mysql_fetch_assoc($result);
  mysql_close($conn);

  header("Content-type: image/jpeg");
  echo $row['image'];

//echo "<id>1</id>";

?>