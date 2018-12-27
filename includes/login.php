<?php
include "db.php";
session_start();

if(isset($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$username=mysqli_real_escape_string($dbconn,$username);
	$password=mysqli_real_escape_string($dbconn,$password);
	
	$query_login="SELECT * FROM users WHERE username='$username'";
	
	$result_login=mysqli_query($dbconn,$query_login);
	
	if(mysqli_num_rows($result_login)==1){
		$user=mysqli_fetch_assoc($result_login);
		$db_username=$user['username'];
		$db_password=$user['password'];
	} else {
        $_SESSION["login_error"]=true;
        header("Location: ../index.php");
    }
	if($username!==$db_username || $password!==$db_password){
        $_SESSION["login_error"]=true;
		header("Location: ../index.php");
	} else if($username===$db_username && $password===$db_password){
		$_SESSION['user']=$user;
		header("Location: ../admin");
	}
}
?>