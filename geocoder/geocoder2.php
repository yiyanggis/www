<?php

$file = fopen('csv/test.csv', 'r');

$amount=0;

$fileIndex=0;

$fp = fopen('result/file'.$fileIndex.'.csv', 'w');


while (($line = fgetcsv($file)) !== FALSE) {
  //$line is an array of the csv elements
	if($amount<900){
		$amount++;
	}
	else{
		$amount=0;
		$fileIndex++;
		if(!is_null($fp)){
			fclose($fp);
			$fp = fopen('result/file'.$fileIndex.'.csv', 'w');
		}
	}
	fputcsv($fp, $line);
  //print_r($line);
}
fclose($file);

?>