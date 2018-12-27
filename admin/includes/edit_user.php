
	<?php

if(isset($_GET['user_id'])){
	$user_id=escape_string($_GET['user_id']);
	$user_res=findUserById($user_id);
	$user=mysqli_fetch_assoc($user_res);
	$firstname=$user['firstname'];
	$lastname=$user['lastname'];
	$dep_id=$user['dep_id'];
	$dep_name=$user['dep_name'];
	
	$phone=$user['phone'];
	$email=$user['email'];
	$username=$user['username'];
	$password=$user['password'];
}
$mesazhi="";
if(isset($_POST['updateUser'])){
	
	$mesazhi=updateUser(
		escape_string($_POST['user_id']),
		escape_string($_POST['firstname']),
		escape_string($_POST['lastname']),
		escape_string($_POST['departments']),
		escape_string($_POST['password']),
		escape_string($_POST['email']),
		escape_string($_POST['username']),
		escape_string($_POST['phone']),
		escape_string($registrar));
}
?>
<!-- card-register forma e regjistrimit--> 
<div class="card  mx-auto mt-30 ">
<div class="card-header h4">Modifikimi i Përdoruesit</div>
<div class="card-body mx-5">
<form id="needs-validation" method="post" role="form" novalidate>		  
   <input name="user_id" value="<?php if(!empty($user_id)) echo $user_id;?>"
		class="form-control" id="user_id" type="hidden">
  <div class="form-group">
	<div class="form-row">
	  <div class="col-md-6">
		<label class="h6" for="firstname">Emri: </label>
		<input name="firstname" value="<?php if(!empty($firstname)) echo $firstname;?>"
		class="form-control" id="firstname" type="text" required>
		<div class="invalid-feedback">
			Ju lutem plotësoni emrin.
		</div>
	  </div>
	  <div class="col-md-6">
		<label class="h6" for="lastname">Mbiemri: </label>
		<input name="lastname" value="<?php if(!empty($lastname)) echo $lastname;?>" 
		class="form-control" id="lastname" type="text" aria-describedby="nameHelp" required>
		<div class="invalid-feedback">
			Ju lutem plotësoni mbiemrin.
		</div>
	  </div>
	</div>
  </div>
	<div class="form-group">
	<label class="h6" for="roli">Roli:</label>
	<?php
		echo '<select name="departments" class="form-control"  id="roli">';
		echo "<option value='".$dep_id."'> ". $dep_name . "</option>";
		$departments=findDepartments();
		
		while($dep=mysqli_fetch_array($departments)){
			if($dep_id!=$dep['dep_id']){
				echo "<option value='".$dep['dep_id']."'> ".$dep['dep_name']. "</option>";
			}
		}
		echo '</select>';
	?>
  </div>
  <div class="form-group">
	<label class="h6" for="email">Email:</label>
	<input name="email" value="<?php if(!empty($email)) echo $email;?>" 
	class="form-control" id="email" type="email" aria-describedby="emailHelp" required>
	<div class="invalid-feedback">
		Ju lutem plotësoni | verifikoni email-in.
	</div>
  </div>
  <div class="form-group">
	<label class="h6" for="phone">Telefoni:</label>
	<input name="phone" value="<?php if(!empty($phone)) echo $phone;?>"
	class="form-control" id="phone" type="text" aria-describedby="telefoniHelp" required>
	<div class="invalid-feedback">
		Ju lutem plotësoni telefonin.
	</div>
  </div>
   <div class="form-group">
	<label class="h6" for="username">Përdoruesi:</label>
	<input name="username" value="<?php if(!empty($username)) echo $username;?>" 
	class="form-control" id="username" type="text" aria-describedby="perdoruesiHelp" required>
	<div class="invalid-feedback">
		Ju lutem plotësoni perdoruesin.
	</div>
  </div>
  <div class="form-group">
	<div class="form-row">
	  <div class="col-md-6">
		<label class="h6" for="password">Fjalëkalimi:</label>
		<input name="password" value="<?php if(!empty($password)) echo $password;?>"
		class="form-control" id="password" type="password" required>
		<div class="invalid-feedback">
		Ju lutem plotësoni fjalekalimin
	</div>
	  </div>
	  <div class="col-md-6">
		<label class="h6" for="confirmPassword">Konfirmo Fjalëkalimin:</label>
		<input class="form-control" value="<?php if(!empty($password)) echo $password;?>"
		id="confirmPassword" type="password" required>
		<div class="invalid-feedback">
			---
		</div>
	  </div>

	</div>
	</div>
				
	<div class="alert alert-danger d-none jmesazhi">
	  <span id="message"></span>
	</div>
	
  <input name="updateUser" type="submit" class="btn btn-primary btn-block" value="Modifiko">
</form>
</div>
</div>
<script>

$("#needs-validation").submit(function () {
if ($("#password").val() == "" || 
($("#password").val()!=$("#confirmPassword").val()) ) {
	message+="Ju lutem plotësoni | verifikoni fjalekalimin<br>";
	kontrollues=true;
}

if(kontrollues){
	$(".jmesazhi").removeClass("d-none");
	$("#message").html(message);
	return false;
}else{
	return true;
}

});



/*

$("#updateuser").submit(function () {
kontrollues=false;
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
if ($("#firstname").val() == "") {
	message="Ju lutem plotësoni emrin<br>";
	kontrollues=true;
}
if ($("#lastname").val() == "") {
	message+="Ju lutem plotësoni mbiemrin<br>";
	kontrollues=true;
}
if ($("#email").val() == "" || !validateEmail($("#email").val())) {
	message+="Ju lutem plotësoni | verifikoni email-in<br>";
	kontrollues=true;
}		

if ($("#phone").val() == "") {
	message+="Ju lutem plotësoni telefonin<br>";
	kontrollues=true;
}
if ($("#username").val() == "") {
	message+="Ju lutem plotësoni perdoruesin<br>";
	kontrollues=true;
}
if ($("#password").val() == "" || 
($("#password").val()!=$("#confirmPassword").val()) ) {
	message+="Ju lutem plotësoni | verifikoni fjalekalimin<br>";
	kontrollues=true;
}

if(kontrollues){
	$(".jmesazhi").removeClass("d-none");
	$("#message").html(message);
	return false;
}else{
	return true;
}

});  
*/
</script>