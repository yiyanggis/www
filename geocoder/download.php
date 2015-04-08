<?php
// Control xdebug on/off
//xdebug_disable();

header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename= result.csv");
header("Content-Transfer-Encoding: binary");    
readfile("result/file.csv");


?>