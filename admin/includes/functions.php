<?php
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


function findClients(){
	global $dbconn;
	$query_clients="SELECT * FROM clients";
	return $result_all_clients=mysqli_query($dbconn,$query_clients);
}
function findServices(){
	global $dbconn;
	$query_services="SELECT * FROM services";
	return $result_all_services=mysqli_query($dbconn,$query_services);
}

function findServicesJS(){
	$services=findServices();
	
	$result_array = array();	
	while($service=mysqli_fetch_array($services)){
		$result_array[$service['service_id']] = $service['service_name'];
	}
	//convert the PHP array into JSON format, so it works with javascript
    return $result_array;
}
function add_sale($client_id,$sale_date,$description,$sale_type,
							  $status,$payment_date,$payment_ref){
	global $dbconn;
	$user_id=$_SESSION['user']['user_id'];
	$s_d=date("Y-m-d");
	$query_add_sale="INSERT INTO sales(sale_date,client_id,description,sale_type,dep_id,status,
	payment_date,payment_ref,user_id,registration_date) VALUES ('2018-01-01',1, 
	'$description','$sale_type',1,'$status','$payment_date','$payment_ref', $user_id,'$s_d')";
	$result_add_sale=mysqli_query($dbconn, $query_add_sale);
	if(!$result_add_sale){
		die("<span class='text-danger'>
		Gabim gjat shtimit te perdoruesit" . mysqli_error($dbconn).
		"</span>");
	}
	else{
		return mysqli_insert_id($dbconn);
		//header("Location: users.php");
	}							  
}
function addSale_Details($sale_details){
	global $dbconn;
	$result_add_saledetails=mysqli_query($dbconn, $sale_details);
	if(!$result_add_saledetails){
		die("<span class='text-danger'>
		Gabim gjat shtimit te perdoruesit" . mysqli_error($dbconn).
		"</span>");
	}
	else{
		echo "test";
		//header("Location: users.php");
	}	
}
function findSales(){
	global $dbconn;
	/*$query_sales="SELECT s.sale_id,s.sale_date,c.client,
				s.description,COUNT(sd.sale_id) total,s.payment_date,s.status 
				FROM sales s INNER JOIN clients c ON s.client_id=c.client_id
				LEFT JOIN sales_details sd on s.sale_id=sd.sale_id
				GROUP BY s.sale_id";*/
	
	$query_sales="SELECT s.sale_id,s.sale_date,c.client,
				s.description ,s.payment_date,s.status 
				FROM sales s INNER JOIN clients c ON s.client_id=c.client_id";
	return $result_sales=mysqli_query($dbconn,$query_sales);
}
function addSale_and_Details($sale,$sale_details){
	global $dbconn;
	$client_id=$sale['client_id'];
	$sale_date=$sale['sale_date'];
	$description=$sale['description'];			
	$sale_type=$sale['sale_type'];
	$status=$sale['status'];
	$payment_date=$sale['payment_date'];
	$payment_ref=$sale['payment_ref'];
	$user_id=$_SESSION['user']['user_id'];
	$s_d=date("Y-m-d");
	$query_add_sale="INSERT INTO sales(sale_date,client_id,description,sale_type,dep_id,status,
	payment_date,payment_ref,user_id,registration_date) VALUES ('$sale_date',$client_id, 
	'$description','$sale_type',1,'$status','$payment_date','$payment_ref', $user_id,'$s_d')";
	
	mysqli_autocommit($dbconn, FALSE);
	
	$result_add_sale=mysqli_query($dbconn, $query_add_sale);
	if(!$result_add_sale){
		mysqli_rollback($dbconn);
		die("test 1". mysqli_error($dbconn));
	}
	else{
		$sale_id=mysqli_insert_id($dbconn);
		
		$query_add_sale_details="INSERT INTO sales_details(sale_id,service_id,quantity,unit) VALUES ";
		foreach($sale_details as $sd){		
			$service=$sd['service'];
			$quantity=$sd['quantity'];
			$unit=$sd['unit'];
			
			$query_add_sale_details.="($sale_id,$service,$quantity,'$unit')";
			if($sd != end($sale_details)) {
				$query_add_sale_details.=",";
			}
		}
		echo $query_add_sale_details;
		$result_add_saledetails=mysqli_query($dbconn, $query_add_sale_details);
		if(!$result_add_saledetails){
			//mysqli_rollback($dbconn);
			die("<span class='text-danger'>
				Error" . mysqli_error($dbconn).
			"</span>");
			mysqli_rollback($dbconn);
		}
		else{
			mysqli_commit($dbconn);
			$_SESSION['mesazhi'] = "Fatura {$sale_id} u shtua me sukses";
			header("Location: sales.php");
		}
	}
}	
?>