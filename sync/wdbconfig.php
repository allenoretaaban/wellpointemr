<?php

$hostname = "localhost";
if($_SERVER['HTTP_HOST'] == "wpdemr"){
    $muser = "root";
    $pass = "";
}else{
    $muser = "root";
    $pass = "";
}
$dbconn = mysql_connect($hostname, $muser, $pass);        
$db ="wpemrlivedb";                                             
mysql_select_db($db);

?>
