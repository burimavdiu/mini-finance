<?php
/* ----User------ */
function addUser($firstname,$lastname,$dep_id,$password,$email,$username,$phone,$registrar_id){
	global $dbconn;
	$query_add_user="INSERT INTO users(firstname,lastname,dep_id,password,email,username,phone,reg_id) VALUES('$firstname','$lastname', $dep_id,'$password','$email','$username','$phone', $registrar_id)";
	$result_add_user=mysqli_query($dbconn, $query_add_user);
	if(!$result_add_user){
		die("<span class='text-danger'>
		Gabim gjat shtimit te perdoruesit" . mysqli_error($dbconn).
		"</span>");
	}
	else{
		$_SESSION['mesazhi'] = "Përdoruesi {$firstname} {$lastname} u shtua me sukses";
		header("Location: users.php");
	}	
}
function updateUser($user_id,$firstname,$lastname,$dep_id,$password,$email,$username,$phone){
	global $dbconn;
	$query_update_user="UPDATE users SET firstname='$firstname',lastname='$lastname',
	dep_id=$dep_id,password='$password',email='$email',username='$username', 
	phone='$phone' WHERE user_id=$user_id";
	$result_update_user=mysqli_query($dbconn, $query_update_user);
	if(!$result_update_user){
		die("<span class='text-danger'>
		Gabim gjat modifikimit te perdoruesit" . mysqli_error($dbconn).
		"</span>");
	}
	else{
		$_SESSION['mesazhi'] = "Përdoruesi {$firstname} {$lastname} u modifikua me sukses";
		header("Location: users.php");
	}	
}
function delteUser($user_id){
	global $dbconn;
	$query_delete_user="DELETE FROM users WHERE user_id=$user_id";
	$result_delete_user=mysqli_query($dbconn, $query_delete_user);
	if(!$result_delete_user){
		$_SESSION['mesazhi'] = "Përdoruesi {$firstname} {$lastname} nuk mund te fshihet";
		header("Location: users.php");
	}
	else{
		$_SESSION['mesazhi'] = "Përdoruesi {$firstname} {$lastname} u fshi me sukses";
		header("Location: users.php");
	}	
}

function findUsers(){
	global $dbconn;
	$query_users="SELECT * FROM users";
	return $result_all_users=mysqli_query($dbconn,$query_users);
}
function findUserById($user_id){
	global $dbconn;
	$query_user="SELECT u.user_id,u.firstname,u.lastname,u.email,u.phone,
				u.username,u.password,u.dep_id,d.dep_name 
				FROM users u INNER JOIN departments d ON u.dep_id=d.dep_id
				WHERE u.user_id=$user_id";
	return $result_user=mysqli_query($dbconn,$query_user);
}

function findDepartments(){
	global $dbconn;
	$query_dep="SELECT dep_id, dep_name FROM departments";
	return $result_all_dep=mysqli_query($dbconn,$query_dep);
}
/* ----End-User------ */

/* ----Clients------ */
function addClient($client,$contact_person,$position,$client_address,$city,$state,$phone,
	$mobile_no,$email,$web,$client_registration_no,$fiscal_no,$vat_no,$registrar_id){
	
	global $dbconn;
	$query_add_client="INSERT INTO clients(client,contact_person,job_position,address_1," .
		"city,state,tel_no,mobile_no,client_email,client_web,business_register_no,fiscal_no,vat_no,user_id,registration_date)" .
		"VALUES('$client','$contact_person','$position','$client_address','$city','$state','$phone', ".
			"'$mobile_no','$email','$web','$client_registration_no','$fiscal_no','$vat_no',$registrar_id,Now())";
	
	$result_add_client=mysqli_query($dbconn, $query_add_client);
	if(!$result_add_client){
		die("<span class='text-danger'>Gabim gjatë shtimit të klientit: ".mysqli_error($dbconn)."</span>");
	} else { 
		$_SESSION['mesazhi'] = "Klienti {$client} u shtua me sukses";
		header("Location: clients.php");
    }
}

function findClients(){
	global $dbconn;
	$query_clients="SELECT * FROM clients";
	return $result_all_clients=mysqli_query($dbconn,$query_clients);
}

function delteClient($client_id){
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

function updateClient($client_id,$client,$contact_person,$position,$client_address,$city,$state,$phone,
	$mobile_no,$email,$web,$client_registration_no,$fiscal_no,$vat_no){
	global $dbconn;
	$query_update_client="UPDATE clients SET client='$client',contact_person='$contact_person',
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
/* ----End-Clients------ */

?>