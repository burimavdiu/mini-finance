<?php
	if(isset($_POST['addClient'])){
			$registrar=$_SESSION['user']['user_id'];
			$mesazhi=addClient($_POST['client'],$_POST['contactPerson'],$_POST['position'],
			$_POST['firstAddress'],$_POST['city'],
			$_POST['state'],$_POST['phone'],$_POST['mobPhone'],
			$_POST['email'],$_POST['web'],$_POST['clientRegistrationNo'],
			$_POST['fiscalNo'],$_POST['vatNo'],$registrar);
		}
 ?>
<html lang="en">
<head>
</head>
 <body>
	<div class="card mx-auto mt-30">
		<div class="card-header h4">Regjistrimi i Klientit</div>
		<div class="card-body">
			<form id="needs-validation" method="post" role="form" novalidate>	
				<fieldset class="card card-body mx-5">
				<legend class="h6 alert alert-secondary">Të dhënat e klientit</legend>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" for="client">Klienti: </label>
						<input class="form-control "  id="client" name="client" type="text" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni emrin e klientit.
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="contactPerson">Kontakt personi:</label>
						<input name="contactPerson" class="form-control" id="contactPerson" type="text" aria-describedby="contactPersonHelp" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni emrin e personit kontaktues.
						</div>
					</div>
				</div>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" for="position">Pozita(Titulli): </label>
						<input class="form-control "  name="position" id="position" type="text" aria-describedby="positionHelp" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni poziten.
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="firstAddress">Adresa:</label>
						<input name="firstAddress" class="form-control" id="firstAddress" type="text" aria-describedby="firstAddressHelp" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni adresen.
						</div>
					</div>
				</div>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" or="city">Qyteti:</label>
						<input name="city" class="form-control" id="city" type="text" aria-describedby="cityHelp" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni qytetin.
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="state">Shteti:</label>
						<input name="state" class="form-control" id="state" type="text" aria-describedby="stateHelp" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni shtetin.
						</div>
					</div>
				</div>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" for="phone">Telofoni i punes:</label>
						<input name="phone" class="form-control" id="phone" type="text" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni telefonin.
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="mobPhone">Telofoni mobil:</label>
						<input name="mobPhone" class="form-control" id="mobPhone" type="text" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni telefonin.
						</div>
					</div>
				</div>
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label class="control-label h6" for="email">Email:</label>
						<input  name="email" class="form-control" id="email" type="email" required />
						<div class="invalid-feedback">
							Ju lutem plotësoni | verifikoni email-in.
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label h6" for="web">Web Faqja:</label>
						<input name="web" class="form-control" id="web" type="url" required />
						<div class="invalid-feedback">
							JJu lutem plotësoni | verifikoni web faqen.
						</div>
					</div>
				</div>
				</fieldset>	
				<fieldset style="margin:30px 0;" class="card card-body mx-5">
				<legend class="h6 alert alert-secondary">Të dhënat fiskale të klientin</legend>
					<div class="form-row">	
						<div class="form-group col-md-6">
							<label class="control-label h6" for="clientRegistrationNo">Nr. Regjistrimit të Klientit:</label>
							<input  name="clientRegistrationNo" class="form-control" id="clientRegistrationNo" type="text" aria-describedby="telefoniHelp" required />
							<div class="invalid-feedback">
							Ju lutem plotësoni numrin e regjistrimit të klientit.
							</div>
						</div>
						<div class="form-group col-md-6">
							<label class="control-label h6" for="fiscalNo">Nr. Fiskal:</label>
							<input name="fiscalNo" class="form-control" id="fiscalNo" type="text" required />
							<div class="invalid-feedback">
							Ju lutem plotësoni numrin fiskal.
							</div>
						</div>
					</div>
					<div class="form-row">	
						<div class="form-group col-md-6">
							<label class="control-label h6" for="registrar">Regjistroi:</label>
							<input name="registrar" class="form-control" id="registrar" type="text" />
							
						</div>
						<div class="form-group col-md-6">
							<label class="control-label h6" for="vatNo">Nr. TVSH:</label>
							<input name="vatNo" class="form-control" id="vatNo" type="text"  required />
							<div class="invalid-feedback">
							Ju lutem plotësoni numrin e TVSH-së.
							</div>
						</div>
					</div>
				</fieldset>
				<input name="addClient" type="submit" class="btn btn-primary btn-block" value="Regjistro">
			</form>
		</div>
	</div>
</body>
</html>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';

  window.addEventListener('load', function() {
    var form = document.getElementById('needs-validation');
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();
</script>