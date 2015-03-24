<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname="test";

header("Content-type: text/xml");

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

$sql = "SELECT * from testtable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "address: " . $row["address"]. " - coordination: " . $row["lat"] . "," . $row["lon"] . "<br>";

        $node = $dom->createElement("marker");
	  $newnode = $parnode->appendChild($node);
	  $newnode->setAttribute("name",$row['name']);
	  $newnode->setAttribute("address", $row['address']);
	  $newnode->setAttribute("lat", $row['lat']);
	  $newnode->setAttribute("lng", $row['lon']);
	  $newnode->setAttribute("type", $row['type']);
    }
} else {
    //echo "0 results";
}

//var_dump($dom);
echo $dom->saveXML();

//echo "<id>1</id>";

?>