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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Make sure the user actually

// selected and uploaded a file

//if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {


// Temporary file name stored on the server

//$tmpName = $_FILES['image']['tmp_name'];

//move_uploaded_file($tmpName,"test.jpg");


//file path

//parse date

$path=$_POST["path"];
$lat=floatval($_POST["lat"]);
$lon=floatval($_POST["lon"]);
$desc=$_POST["desc"];
$addr=$_POST["addr"];



//var_dump($lat);


// Create the query and insert

// into our database.

$query = "INSERT INTO phototable ";

//$query .= "(image,lat,lon,desc) VALUES ('$data',$lat,$lon,'$desc')";

$query .= "(path, lat,lon,`desc`, `addr`) VALUES ('$path',$lat,$lon,'$desc', '$addr')";

//var_dump($query);

$result = $conn->query($query);


// Print results
//var_dump($result);

echo json_encode("Thank you, your file has been uploaded.");


//else {

//print "No image selected/uploaded";

//}


// Close our MySQL Link

//mysql_close($conn);
$conn->close();

?>