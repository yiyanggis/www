<?php

$array1=array();

$row = 1;
if (($handle = fopen("dataset3.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 240, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        //for ($c=0; $c < $num; $c++) {
            $url=$data[0];
        //}
        $array1[]=func($url);

    }
    fclose($handle);

    $fp = fopen('file.csv', 'w');

	foreach ($array1 as $fields) {
	    fputcsv($fp, $fields);
	}

	fclose($fp);
}



function func($url){
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);

	$p1=strpos($resp,"<a target=\"_blank\" href=\"http://catalog.ihsn.org/index.php/catalog/");

	echo $p1."\r\n".PHP_EOL;;

	



	#echo $p1."\r\n".PHP_EOL;;

	$qp=strpos($resp,"Questionnaires        </legend>");

	echo "questionannaires:".$qp;
	if($qp==0){
		$url1="null";
	}
	else{
		$url1=substr($resp,$p1+25,61);
	}

	#echo ""."\r\n".PHP_EOL;;

	$rp=strpos($resp,"Reports        </legend>");

	echo "report:".$rp;
	#echo $p2;

	$p3=strpos($resp,"<a target=\"_blank\" href=\"http://catalog.ihsn.org/index.php/catalog/",$rp);

	echo $p3;
	if($rp==0){
		$url2="null";
	}
	else{
		$url2=substr($resp,$p3+25,61);
	}
	

	curl_close($curl);

	echo $url1."===".$url2;

	return array($url1,$url2);


}


// Close request to clear up some resources


?>