    
	<?php
		if(isset($_GET['sale_id'])){
			$sale_id=escape_string($_GET['sale_id']);
			$sale_res=findSaleById($sale_id);
			$sale=mysqli_fetch_assoc($sale_res);
			
			$client_id=$sale['client_id'];
			$client_name=$sale['client'];
			$sale_date=$sale['sale_date'];
			$sale_description=$sale['description'];
			$sale_type=$sale['sale_type'];
			$status=$sale['status'];
			$payment_date=$sale['payment_date'];
			$payment_ref=$sale['payment_ref'];
			$registration_date=$sale['registration_date'];
			
		}
		//echo $_SESSION['user']['user_id'];
		$mesazhi="";
		if(isset($_POST['update_sale'])){
			$sale=array();
			$sale['sale_id'] = $sale_id;
			$sale['client_id']=escape_string($_POST['client']);
			//$sale['client_name']=$_POST['client'];
			$sale['sale_date']=escape_string($_POST['sale_date']);
			$sale['description']=escape_string($_POST['sale_description']);			
			$sale['sale_type']=escape_string($_POST['sale_type']);
			$sale['status']=escape_string($_POST['status']);
			$sale['payment_date']=escape_string($_POST['payment_date']);
			$sale['payment_ref']=escape_string($_POST['payment_ref']);
			
			/*$sale_id=add_sale($client_id,$sale_date,$description,$sale_type,
							  $status,$payment_date,$payment_ref);*/
			//price = '{$_POST['price'][$i]}',
		  
			
			$sale_details=array();
			//"INSERT INTO sales_details(sale_id,service_id,quantity,unit) VALUES ";
			
			$sd_count=count($_POST['service']);

			for($i = 0; $i<$sd_count; $i++){
				
				$sd['sales_details_id']=escape_string($_POST['sales_details_id'][$i]);
				$sd['service']=escape_string($_POST['service'][$i]);
				$sd['quantity']=escape_string($_POST['quantity'][$i]);
				$sd['unit']=escape_string($_POST['unit'][$i]);
				$sd['price']=escape_string($_POST['price'][$i]);
				array_push($sale_details, $sd);			
			}
			//print_r($sale);
			//addSale_and_Details($sale,$sale_details);	
			update_sale_and_details($sale,$sale_details);
			
		}
		
	?>
	<!-- card-register forma e regjistrimit--> 
    <div class="card  mx-auto mt-30 ">
		<div class="card-header h4">Fatura</div>
		<div class="card-body mx-5">
		
			<form action="" method="POST">  
                <div class="form-group"> 
					<div class="form-row">
					  <div class="col-md-6">
						<label class="h6" for="client">Klienti:</label>
						<?php
						
							echo "<select name='client' class='form-control'  id='client'>";
							echo "<option value='". $client_id ."'>" . $client_name . "</option>";
							$clients=findClients();
							while($client=mysqli_fetch_array($clients)){
								if($client_id!=$client['client_id']){
									echo "<option value='" . $client['client_id'] ."'> " . 
									$client['client'] . "</option>";
								}
							}
							echo "</select>";
						?>
					  </div>
					  <div class="col-md-6">
						<label class="h6" for="sale_description">Pershkrimi:</label>
						<input name="sale_description" class="form-control" id="sale_description" 
						value="<?php if(!empty($sale_description)) echo $sale_description;?>"
						type="text" aria-describedby="nameHelp">
					  </div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
					  <div class="col-md-4">
						<label class="h6" for="sale_date">Data e fatures: </label>
						<input name="sale_date" class="form-control" id="sale_date" 
						value="<?php if(!empty($sale_date)) echo $sale_date;?>"
						type="date" aria-describedby="nameHelp">
					  </div>
					  <div class="col-md-4">
						<label class="h6" for="sale_type">Lloji i Faturës: </label>
						<select name="sale_type" class="form-control"  id="sale_type">
							
							<?php
								if($sale_type==""){
									echo "<option value=''> zgjedh opsionin </option>";
									echo "<option value='fature'> fature </option>";
									echo "<option value='pro-fature'> pro-fature </option>";
								}
								else{
									echo "<option value='". $sale_type ."'>" . $sale_type ."</option>";	
									if($sale_type==	"pro-fature"){
										echo "<option value='fature'> fature </option>";
									}
									else{
										echo "<option value='pro-fature'> pro-fature </option>";
									}
								}
							?>
						</select>
					  </div>
					  <div class="col-md-4">
						<label class="h6" for="status">Statusi i Faturës: </label>
						<select name="status" class="form-control"  id="status">
						<?php
							if($sale_type==""){
								echo "<option value=''> zgjedh opsionin </option>";
								echo "<option value='ne-proces'> ne-proces </option>";
								echo "<option value='e-paguar'> e-paguar </option>";
								echo "<option value='e-refuzuar'> e-refuzuar </option>";
							}
							else{
								echo "<option value='". $status ."'>" . $status ."</option>";	
								if($status!="ne-proces"){
									echo "<option value='ne-proces'> ne-proces </option>";
								}
								if($status!="e-paguar"){
									echo "<option value='e-paguar'> e-paguar </option>";
								}
								if($status!="e-refuzuar"){
									echo "<option value='e-refuzuar'> e-refuzuar </option>";
								}
							}
						?>
						</select>
					  </div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="form-row">
					  <div class="col-md-6">
						<label class="h6" for="payment_date">Data e pageses: </label>
						<input name="payment_date" class="form-control" id="payment_date" 
						value="<?php if(!empty($payment_date)) echo $payment_date;?>"
						type="date" aria-describedby="nameHelp">
					  </div>		
					  <div class="col-md-6">
						<label class="h6" for="payment_ref">Referenca :</label>
						<input name="payment_ref" class="form-control" id="payment_ref" 
						value="<?php if(!empty($payment_ref)) echo $payment_ref;?>"
						type="text" aria-describedby="nameHelp">
					  </div>
					</div>
				</div>
                <table class="table table-bordered table-hover">  
					<thead>    
						<th>Sherbimi</th>  
						<th>Pershkrimi</th>  
						<th>Njesia</th>
						<th>Cmimi</th>
						<th>Sasia</th>						
						<th>Total</th> 
						<th><input type="button" value="+" id="add" class="btn btn-primary"></th>  
					</thead>  
                    <tbody class="detail">
					<?php
						$salesd=findSalesDetailsBySaleId($sale_id);
						
						while($sd=mysqli_fetch_array($salesd)){
							//print ($sd['sales_details_id']);
							$sd_id=$sd['sales_details_id'];
							$service_id=$sd['service_id'];
							$service_name=$sd['service_name'];
							echo "<input type='hidden' value='".$sd_id."' name='sales_details_id[]'>";
							echo "<tr>"; 
							echo "<td width='25%'>";
							echo "<select name='service[]' class='form-control service'>";
							echo "<option value='".$service_id."'>". $service_name ."</option>";
								$services=findServices();
								while($service=mysqli_fetch_array($services)){
									if($service_id!=$service['service_id']){
									echo "<option value='".$service['service_id']."'> "
										.$service['service_name']. "</option>";
									}
								}
							
							echo "</select>";
							echo "</td>";  
							echo "<td width='30%'><input type='text' class='form-control description' 
							name='description[]' value='". $sale['description'] . "'></td>";  
							echo "<td width='15%'><select name='unit[]' class='form-control unit'>";
							echo "<option value='cope'> cope </option><option value='dite'> dite </option>";
							echo "</select></td>";  
							echo "<td width='10%'><input type='text' class='form-control price' name='price[]' 
							value='". $sd['price'] . "'></td>";
							echo "<td width='10%'><input type='text' class='form-control quantity' name='quantity[]' value='". $sd['quantity'] . "'></td>";
							$total = $sd['price'] * $sd['quantity'];	
							echo "<td width='10%'><input type='text' class='form-control amount' name='amount[]'
							value='". $total . "'></td>";
							echo "<td> <a href='#' class='btn btn-danger a-btn-slide-text remove'><span><strong>x</strong></span></a></td>";  
							echo "</tr>";
						}?>	
					</tbody>  
					<tfoot>  
						<th></th>  
						<th></th>  
						<th></th>  
						<th></th>  
						<th></th>  
						<th style="text-align:center;" class="total">0<b></b></th>  
					</tfoot>  
  
				</table>
				<div class="alert alert-danger d-none jmesazhi">
						  <span id="message"></span>
				</div>
				<div class="form-group">
					<div class="form-row">
					  <div class="col-md-6">
						
					  </div>
					  <div class="col-md-6">
						
						<input name="update_sale" class="form-control btn btn-primary" id="updatesale" 
						type="submit" value="Modifiko Shitje" aria-describedby="nameHelp">
					  </div>
					</div>
				</div>	
			</form>  
      </div>
    </div>
	<?php $temp = findServicesJS()?>
	<script type="text/javascript">  
		
		$(function(){  
			$('#add').click(function(){  
				addnewrow();  
			});
			$('body').delegate('.remove','click',function(){  
				$(this).parent().parent().remove();
				total();	
			});  
			$('body').delegate('.quantity,.price','keyup',function(){  
				var tr=$(this).parent().parent();  
				var qty=tr.find('.quantity').val();  
				var price=tr.find('.price').val();  
			  
				//var dis=tr.find('.discount').val();  
				var amt=qty * price;  
				tr.find('.amount').val(amt);  
				total();  
			});  
		});  
		function total(){  
			var t=0;  
			$('.amount').each(function(i,e)   
			{  
			var amt =$(this).val()-0;  
			t+=amt;  
			});  
			$('.total').html(t);  
		}  	
		function addnewrow()   
		{  
			//var json_array = <?php echo json_encode($temp, true);?>;
			//var n=($('.detail tr').length-0)+1;  
			//'<td class="no">'+n+'</td>'+	
			vartr = '<tr>'+  
			'<td><?php
				echo '<select name="service[]" class="form-control service">';
				echo '<option value=""> zgjedh opsionin </option>';
				$services=findServices();
				while($service=mysqli_fetch_array($services)){
					echo '<option value="'.$service['service_id'].'"> '
					.$service['service_name']. '</option>';
				}
				echo '</select>';?></td>'+  
			'<td><input type="text" class="form-control description" name="description[]"></td>'+  
			'<td><select name="unit[]" class="form-control unit"><option value="cope"> cope </option><option value="dite"> dite </option></select></td>'+  
			'<td><input type="text" class="form-control price" name="price[]"></td>'+
			'<td><input type="text" class="form-control quantity" name="quantity[]"></td>'+  
			'<td><input type="text" class="form-control amount" name="amount[]"></td>'+  
			'<td><a href="#" class="btn btn-danger a-btn-slide-text remove"><span><strong>x</strong></span>'+  
			'</tr>';  
			$('.detail').append(vartr);   
		}
		$("#addsale").click(function(){
			kontrollues=false;
			message="";
			function validateEmail($email) {
			  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			  return emailReg.test( $email );
			}
			if ($("#client").val() == "") {
				message="Ju lutem zgjedhni klientin<br>";
				kontrollues=true;
			}
			if ($("#sale_description").val() == "") {
				message+="Ju lutem plotësoni përshkrimin<br>";
				kontrollues=true;
			}
			if ($("#sale_date").val() == "") {
				message+="Ju lutem plotësoni datën e shitjes<br>";
				kontrollues=true;
			}
			$('.service').each(function(i,e){  
				if ($(this).val() == "") {
					message+="Ju lutem zgjedh sherbimin<br>";
					kontrollues=true;
					return false;
				}
			});
			$('.description').each(function(i,e){  
				if ($(this).val() == "") {
					message+="Ju lutem plotësoni pershkrimin e sherbimin<br>";
					kontrollues=true;
					return false;
				}
			});
			$('.price').each(function(i,e){  
				if ($(this).val() == "") {
					message+="Ju lutem plotësoni çmimin<br>";
					kontrollues=true;
					return false;
				}
			});
			if(kontrollues){
				$(".jmesazhi").removeClass("d-none");
				$("#message").html(message);
				return false;
			}else{
				return true;
			}	
		});	
</script>  
	