    
	<?php
		$mesazhi="";
		if(isset($_POST['addbuy'])) {
			$buy=array();
			$buy['client_id']=escape_string($_POST['client']);
			$buy['buy_date'] = escape_string($_POST['buy_date']);
			$buy['description']=escape_string($_POST['buy_description']);			
			$buy['sale_type']=escape_string($_POST['buy_type']);
			$buy['payment_date']=escape_string($_POST['payment_date']);
			$buy['payment_ref']=escape_string($_POST['payment_ref']);
			$buy['total_price']=escape_string($_POST['total_price']);
			addBuy($buy);
		}
	?>
	<!-- card-register forma e regjistrimit--> 
    <div class="card  mx-auto mt-30 ">
		<div class="card-header h4">Fatura</div>
		<div class="card-body mx-5">
			<form id="needs-validation" method="post" role="form" novalidate>
                <div class="form-group">
					<div class="form-row">
					  <div class="col-md-4">
						<label class="h6" for="client">Klienti:</label>
						<?php
							echo "<select name='client' class='form-control' id='client' required>";
							$clients=findClients();
							echo "<option value=''>Zgjedh klientin </option>";
							while($client=mysqli_fetch_array($clients)){
								echo "<option value='" . $client['client_id'] ."'>" . $client['contact_person'] . "</option>";
							}
							echo "</select>";
							echo "<div class='invalid-feedback'>Ju lutem zgjedhni klientin.</div>";
						?>
					  </div>
					  <div class="col-md-4">
						<label class="h6" for="invoice_no">Nr. i faturës:</label>
						<input name="invoice_no" class="form-control" id="invoice_no" type="text" aria-describedby="nameHelp" required>
                        <div class="invalid-feedback">Ju lutem plotësoni numrin e faturës.</div>
					  </div>
					  <div class="col-md-4">
						<label class="h6" for="buy_description">Përshkrimi:</label>
						<input name="buy_description" class="form-control" id="buy_description" type="text" aria-describedby="nameHelp" required>
                          <div class="invalid-feedback">Ju lutem plotësoni përshkrimin.</div>
					  </div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
					  <div class="col-md-4">
						<label class="h6" for="buy_date">Data e faturës:</label>
						<input name="buy_date" class="form-control" id="buy_date" type="date" aria-describedby="nameHelp" required>
                          <div class="invalid-feedback">Ju lutem zgjedhni datën e faturës.</div>
					  </div>
					  <div class="col-md-4">
						<label class="h6" for="payment_date">Data e pagesës:</label>
						<input name="payment_date" class="form-control" id="payment_date" type="date" aria-describedby="nameHelp" required>
                          <div class="invalid-feedback">Ju lutem zgjedhni datën e pagesës.</div>
					  </div>		
					  <div class="col-md-4">
						<label class="h6" for="payment_ref">Referenca:</label>
						<input name="payment_ref" class="form-control" id="payment_ref" type="text" aria-describedby="nameHelp" required>
                          <div class="invalid-feedback">Ju lutem plotësoni referencën.</div>
					  </div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
					  <div class="col-md-6">
						<label class="h6" for="buy_type">Lloji i Faturës:</label>
						<select name="buy_type" class="form-control"  id="buy_type" required>
							<option value=''>Zgjedh opsionin</option>
							<option value='pro-fature'>Pro-faturë</option>
							<option value='fature'>Faturë</option>
						</select>
                        <div class="invalid-feedback">Ju lutem zgjedhni llojin e faturës.</div>
					  </div>
					  <div class="col-md-6">
						<label class="h6" for="buy_type">Totali:</label>
                          <input name="total_price" class="form-control" id="total_price" type="text" aria-describedby="nameHelp" required>
                          <div class="invalid-feedback">Ju lutem plotësoni shumën totale.</div>
					  </div>
					</div>
				</div>
				<div class="alert alert-danger d-none jmesazhi">
				    <span id="message"></span>
				</div>
				<div class="form-group">
					<div class="form-row">
					  <div class="col-md-6">
					  </div>
					  <div class="col-md-6">
						<input name="addbuy" class="form-control btn btn-primary" id="addbuy"  type="submit" value="Shto Blerje" aria-describedby="nameHelp">
					  </div>
					</div>
				</div>
			</form>  
      </div>
    </div>
	<?php $temp = findServicesJS();?>
	<script type="text/javascript">
		$(function(){  
			$('body').delegate('.remove','click',function(){
				$(this).parent().remove();
			});
		});
</script>