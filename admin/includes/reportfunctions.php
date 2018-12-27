<?php

function findnosales(){
	global $dbconn;
	$ds=date("Y-m-d");
	$query_sales="SELECT COUNT(sale_id) nosales FROM sales 
				  WHERE registration_date BETWEEN '2017-10-01' AND '2018-01-31' ";
	$result_sales=mysqli_query($dbconn,$query_sales);
	$sales=mysqli_fetch_assoc($result_sales);
	echo $sales['nosales'];
}
function salesbymonth(){
	global $dbconn;
	$ds=date("Y-m-d");
	$query_sales="SELECT registration_date, COUNT(sale_id) nosales FROM sales 
				  WHERE registration_date BETWEEN '2017-10-01' AND '2018-01-31' 
				  GROUP BY registration_date";
	return mysqli_query($dbconn,$query_sales);
	
}
function salesbyyear(){
	global $dbconn;
	$ds=date("Y-m-d");
	$query_sales="SELECT registration_date, COUNT(sale_id) nosales FROM sales 
				  WHERE registration_date BETWEEN '2017-10-01' AND '2018-01-31' 
				  GROUP BY registration_date";
	return mysqli_query($dbconn,$query_sales);
	
}
/* ----End-of-Services------ */

?>