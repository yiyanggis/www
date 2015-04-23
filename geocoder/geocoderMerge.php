<?php

$fp = fopen('result/fileMerge.csv', 'w');


$files = scandir('forMerge/');
foreach($files as $file) {
	if(strpos($file,'.csv')){
		echo $file;
	  	$f = fopen('forMerge/'.$file, 'r');

	  	while (($line = fgetcsv($f)) !== FALSE) {
	  		//$line is an array of the csv elements
			fputcsv($fp, $line);
	  		//print_r($line);
		}
		fclose($f);
	}
  	
	//echo $file
}
fclose($fp);

?>