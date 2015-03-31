<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname="test";

//header("Content-type: text/xml");

//$dom = new DOMDocument("1.0");
//$node = $dom->createElement("markers");
//$parnode = $dom->appendChild($node);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully<br/>";

$sql = "SELECT * from phototable";
$result = $conn->query($sql);

$rows=array();
  
  while($row = $result->fetch_assoc()) {
        $rows[]=$row;
    }

$conn->close();

  //header("Content-type: image/jpeg");
  //echo $row['image'];
  //readfile($row["path"])


echo json_encode($rows);

//echo "<id>1</id>";

?>