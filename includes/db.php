<?php
$db['db_host']="localhost";
$db['db_user']="root";
$db['db_pass']="";
$db['db_name']="minifinance";

foreach($db as $key=>$value){
	define(strtoupper($key),$value);
}

$dbconn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
/*
if($dbconn){
	echo "U lidhem me DB";
} else {
    echo "Nuk lidhem me DB";
}*/
?>