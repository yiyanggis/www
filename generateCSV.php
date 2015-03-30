<?php
// Control xdebug on/off
//xdebug_disable();

//var_dump($_POST["data"]);

$data=$_POST["data"];

$fp = fopen('result/file.csv', 'w');

foreach ($data as $fields) {
    fputcsv($fp, $fields);
}

$response = array();

$response['result']='success';

echo json_encode($response);

?>