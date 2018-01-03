
/*Funksionet e shtuara per Komanite - Florenti */
function findCompanies() {
	global $dbconn;
	$query_companies="SELECT * FROM companies";
	return $result_all_companies=mysqli_query($dbconn,$query_companies);
}