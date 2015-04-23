<?php

$file = fopen('csv2/nomatch.csv', 'r');

$amount=0;

$fileIndex=0;

$fp = fopen('result2/file'.$fileIndex.'.csv', 'w');

$fields=array("Unique ID"=>"Unique ID","Address"=>"Address","Match"=>"Match");
fputcsv($fp, $fields);

while (($line = fgetcsv($file)) !== FALSE) {
  //$line is an array of the csv elements
	if($amount<1000){
		$amount++;
	}
	else{
		$amount=0;
		$fileIndex++;
		if(!is_null($fp)){
			fclose($fp);
			$fp = fopen('result2/file'.$fileIndex.'.csv', 'w');
			fputcsv($fp, $fields);
		}
	}
	
	fputcsv($fp, $line);
  //print_r($line);
}
fclose($file);

?>