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

//var_dump($_POST);

date_default_timezone_set('America/New_York');
$date = date('m/d/Y h:i:s a', time());

$datetime=new DateTime($date);

$path='csv/test'.$datetime->format('Y').$datetime->format('m').$datetime->format('d').$datetime->format('H').$datetime->format('i').$datetime->format('s').'.csv';

$result=array("path"=>$path);

foreach($_FILES as $file)
    {
    	//echo $file['tmp_name'];

        if(move_uploaded_file($file['tmp_name'], $path))
        {
			$result['success']=true;
        }
        else{
        	$result['success']=false;
        }

    }

echo json_encode($result)

//move_uploaded_file($tmpName,"test.jpg");

?>