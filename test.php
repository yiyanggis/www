<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
</head>

<body>
The content of the document......
<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname="test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "SELECT * from csvtest";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "InvestID: " . $row["InvestID"]. " - Investment: " . $row["Investment"]. "<br>";
    }
} else {
    echo "0 results";
}

?>
</body>

</html>


