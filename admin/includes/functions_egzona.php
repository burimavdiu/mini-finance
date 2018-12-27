
<?php
	/* ---- Municipalities ------ */
	
	function addMunicipality($municipality_name,$municipality_description){
		global $dbconn;
		$query_add_municipalities="INSERT INTO municipalities(name, description)" . 
		"VALUES ('$municipality_name','$municipality_description')";
		$result_add_municipalities=mysqli_query($dbconn, $query_add_municipalities);
		if(!$result_add_municipalities){
				die("<span class='text-danger'>
				  Gabim gjate shtimit te komunes" . mysqli_error($dbconn).
				  "<span>");
		}
		else{
			$_SESSION['mesazhi'] = "Komuna $municipality_name u shtua me sukses";
			header("Location: configurations.php?source=municipalities");
		}
	}
	
	function findMunicipalites(){
		global $dbconn;
		$query_municipalities="SELECT * FROM municipalities";
		return $result_all_municipalities=mysqli_query($dbconn,$query_municipalities);
	}
	
	function findMunicipalityById($municipality_id){
		global $dbconn;
		$query_municipalitiy="SELECT * FROM municipalities 
		WHERE municipality_id=$municipality_id";
		return $result_municipality=mysqli_query($dbconn, $query_municipalitiy);
	}
	
	function updateMunicipality($municipality_id,$municipality_name,$municipality_description){
		global $dbconn;
		$query_update_municipality="UPDATE municipalities SET name='$municipality_name',
		description='$municipality_description'
		WHERE municipality_id=$municipality_id";
		$result_update_municipality=mysqli_query($dbconn, $query_update_municipality);
			if(!$result_update_municipality){
				die("<span class='text-danger'>
					Gabim gjat modifikimit te komunes " . mysqli_error($dbconn).
					"</span>");
			}
		else{
			$_SESSION['mesazhi'] = "Komuna {$service_name} u modifikua me sukses";
			header("Location: configurations.php?source=municipalities");
		}	
	}
	
	function deleteMunicipality($municipality_id){
		global $dbconn;
		$query_delete_municipality="DELETE FROM municipalities WHERE municipality_id=$municipality_id";
		$result_delete_municipality=mysqli_query($dbconn, $query_delete_municipality);
		if(!$result_delete_municipality){
			$_SESSION['mesazhi'] = "Komuna {$municipality_id} nuk mund te fshihet";
			header("Location: configurations.php?source=municipalities");
		}
		else{
			$_SESSION['mesazhi'] = "Komuna u fshi me sukses";
			header("Location: configurations.php?source=municipalities");
		}	
	}
/* -----End-of-Municipalities------ */
	

/* ----Clients------ */
	function addClient($client,$contact_person,$client_type,$position,$client_address,$city,$state,$phone,
		$mobile_no,$email,$web,$client_registration_no,$fiscal_no,$vat_no,$registrar_id){
		
		global $dbconn;
		$query_add_client="INSERT INTO clients(client,contact_person,client_type,job_position,address_1," .
			"city,state,tel_no,mobile_no,client_email,client_web,business_register_no,fiscal_no,vat_no,user_id,registration_date)" .
			"VALUES('$client','$contact_person','$client_type','$position','$client_address','$city','$state','$phone', ".
				"'$mobile_no','$email','$web','$client_registration_no','$fiscal_no','$vat_no',$registrar_id,Now())";
		
		$result_add_client=mysqli_query($dbconn, $query_add_client);
		if(!$result_add_client){
			die("<span class='text-danger'>Gabim gjatë shtimit të klientit: ".mysqli_error($dbconn)."</span>");
		} 
		else { 
				$_SESSION['mesazhi'] = "Klienti {$client} u shtua me sukses";
				header("Location: clients.php");
		}
	}

	function findClients(){
		global $dbconn;
		$query_clients="SELECT * FROM clients";
		return $result_all_clients=mysqli_query($dbconn,$query_clients);
	}

	function deleteClient($client_id){
		global $dbconn;
		$query_delete_client="DELETE FROM clients WHERE client_id=$client_id";
		$result_delete_client=mysqli_query($dbconn, $query_delete_client);
		
		if(!$result_delete_client){
			$_SESSION['mesazhi'] = "Klienti -- nuk mund te fshihet";
			header("Location: clients.php");
		}
		else{
			$_SESSION['mesazhi'] = "Klienti -- u fshi me sukses";
			header("Location: clients.php");
		}	
	}

	function updateClient($client_id,$client,$contact_person,$client_type,$position,$client_address,$city,$state,$phone,
		$mobile_no,$email,$web,$client_registration_no,$fiscal_no,$vat_no){
		global $dbconn;
		$query_update_client="UPDATE clients SET client='$client',client_type='$client_type',contact_person='$contact_person',
		job_position='$position',address_1='$client_address',city='$city',state='$state',tel_no='$phone'," .
		"mobile_no='$mobile_no',client_email='$email',client_web='$web',business_register_no='$client_registration_no',".
		"fiscal_no='$fiscal_no',vat_no='$vat_no' 
		 WHERE client_id=$client_id";

		$result_update_client=mysqli_query($dbconn, $query_update_client);
		if(!$result_update_client){
			die("<span class='text-danger'>
			Gabim gjat modifikimit te klientit" . mysqli_error($dbconn).
			"</span>");
		}
		else{
			$_SESSION['mesazhi'] = "Klienti {$client } u modifikua me sukses";
			header("Location: clients.php");
		}	
	}
/* ----End-of-Clients------ */
 ?>