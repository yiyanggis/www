<?php

$fp = fopen('fileMerge.csv', 'w');
$request = curl_init();

$files = scandir('result2/');
foreach($files as $file) {
    if(strpos($file,'.csv')){
        echo $file;
        $f = fopen('result2/'.$file, 'r');

        while (($line = fgetcsv($f)) !== FALSE) {
            //$line is an array of the csv elements
            //fputcsv($fp, $line);
            //print_r($line);
            //url:"http://nominatim.openstreetmap.org/search/"+address+"?format=json&addressdetails=1&limit=1&polygon_geojson=1"
            //echo $line[1];
            $r = new HttpRequest("http://nominatim.openstreetmap.org/search/".$line[1]."?format=json&addressdetails=1&limit=1&polygon_geojson=1", HttpRequest::METH_GET);
            $output;
            try {
                $r->send();
                if ($r->getResponseCode() == 200) {
                    var_dump($r->getResponseBody());
                }
            } catch (HttpException $ex) {
                echo $ex;
            }
            //curl_setopt($request, CURLOPT_URL, );
            //$result = curl_exec($request);
            //$output=json_decode($result);
            //var_dump($output);
            fputcsv($fp, $output);
        }
        fclose($f);
    }
    
    //echo $file
}
fclose($fp);

// initialise the curl request


// $filename=realpath('csv/Export_Output.csv');

// //var_dump($filename);

// $file=curl_file_create($filename);

// curl_setopt($request, CURLOPT_POST,1);
// curl_setopt($request,CURLOPT_POSTFIELDS, array('file' => $file, 'benchmark'=>9));

// curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

// echo curl_exec($request);

// // close the session
// curl_close($request);


//var_dump($_POST);

//$url = $_POST["url"];
//$response = http_get($url);
//$xml = file_get_contents($url);


//echo json_encode($xml);


//move_uploaded_file($tmpName,"test.jpg");

?>