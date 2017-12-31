
	<?php

		if(isset($_GET['client_id'])){
			$registrar=$_SESSION['user']['user_id'];
			$client_id=$_GET['client_id'];
			$client_res=findClients($client_id);
			$client=mysqli_fetch_assoc($client_res);			
			$client_name=$client['client']; 
            $contact_person=$client['contact_person'];
            $position=$client['job_position']; 
            
			$client_address=$client['address_1']; 
            $city=$client['city'];
            $state=$client['state']; 
            
			$mobile_no=$client['mobile_no']; 
            $phone=$client['tel_no']; 
            $email=$client['client_email']; 
            $web=$client['client_web']; 
            
			$client_registration_no=$client['business_register_no']; 
            $fiscal_no=$client['fiscal_no']; 
            $vat_no=$client['vat_no']; 
		}

		$mesazhi="";
		if(isset($_POST['updateClient'])){
			$mesazhi=updateClient($client_id,$_POST['client'],$_POST['contactPerson'],$_POST['position'],$_POST['firstAddress'], $_POST['city'],
				$_POST['state'],$_POST['phone'],$_POST['mobPhone'],$_POST['email'], $_POST['web'],
				$_POST['clientRegistrationNo'], $_POST['fiscalNo'], $_POST['vatNo']);
		}
	?>
	<!-- card-register--> 
    <div class="card mx-auto mt-30">
		<div class="card-header h4">Modifikimi i Klientit</div>
		<div class="card-body">
			<form method="post" role="form">	
				<fieldset class="card card-body mx-5">
				<legend class="h6 alert alert-secondary">Të dhënat e klientit</legend>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" for="client">Klienti: </label>
						<input class="form-control "  id="client" name="client" type="text" value="<?php if(!empty($client_name)) echo $client_name;?>" />
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="contactPerson">Kontakt personi:</label>
						<input name="contactPerson" class="form-control" id="contactPerson" type="text" aria-describedby="contactPersonHelp" value="<?php if(!empty($contact_person)) echo $contact_person;?>"/>
					</div>
				</div>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" for="position">Pozita(Titulli): </label>
						<input class="form-control "  name="position" id="position" type="text" aria-describedby="positionHelp" value="<?php if(!empty($position)) echo $position;?>"/>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="firstAddress">Adresa:</label>
						<input name="firstAddress" class="form-control" id="firstAddress" type="text" aria-describedby="firstAddressHelp" value="<?php if(!empty($client_address)) echo $client_address;?>" />
					</div>
				</div>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" or="city">Qyteti:</label>
						<input name="city" class="form-control" id="city" type="text" aria-describedby="cityHelp" value="<?php if(!empty($city)) echo $city;?>" />
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="state">Shteti:</label>
						<input name="state" class="form-control" id="state" type="text" aria-describedby="stateHelp" value="<?php if(!empty($state)) echo $state;?>" />
					</div>
				</div>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" for="phone">Telofoni i punes:</label>
						<input name="phone" class="form-control" id="phone" type="text" value="<?php if(!empty($phone)) echo $phone;?>" />
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="mobPhone">Telofoni mobil:</label>
						<input name="mobPhone" class="form-control" id="mobPhone" type="text" value="<?php if(!empty($mobile_no)) echo $mobile_no;?>" />
					</div>
				</div>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" for="email">Email:</label>
						<input  name="email" class="form-control" id="email" type="email" value="<?php if(!empty($email)) echo $email;?>" />
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="web">Web Faqja:</label>
						<input name="web" class="form-control" id="web" type="url" value="<?php if(!empty($web)) echo $web;?>" />
					</div>
				</div>
				</fieldset>	
				<fieldset style="margin:30px 0;" class="card card-body mx-5">
				<legend class="h6 alert alert-secondary">Të dhënat fiskale të klientin</legend>
					<div class="form-row">	
						<div class="form-group col-md-6">
							<label class="control-label h6" for="clientRegistrationNo">Nr. Regjistrimit të Klientit:</label>
							<input  name="clientRegistrationNo" class="form-control" id="clientRegistrationNo" type="text" aria-describedby="telefoniHelp" value="<?php if(!empty($client_registration_no)) echo $client_registration_no;?>" />
						</div>
						<div class="form-group col-md-6">
								<label class="control-label h6" for="fiscalNo">Nr. Fiskal:</label>
								<input name="fiscalNo" class="form-control" id="fiscalNo" type="text" value="<?php if(!empty($fiscal_no)) echo  $fiscal_no;?>" />
						</div>
					</div>
					<div class="form-row">	
						<div class="form-group col-md-6">
							<label class="control-label h6" for="registrar">Regjistroi:</label>
							<input name="registrar" class="form-control" id="registrar" type="text" value="<?php if(!empty($registrar)) echo $registrar;?>" />
						</div>
						<div class="form-group col-md-6">
							<label class="control-label h6" for="vatNo">Nr. TVSH:</label>
							<input name="vatNo" class="form-control" id="vatNo" type="text" value="<?php if(!empty($vat_no)) echo $vat_no;?>" />
						</div>
					</div>
				</fieldset>
				<input name="updateClient" type="submit" class="btn btn-primary btn-block" value="Regjistro">
			</form>
		</div>
	</div>