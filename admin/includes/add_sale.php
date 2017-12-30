    
	<?php
		$mesazhi="";
		if(isset($_POST['addUser'])){
            $registrar=$_SESSION['user']['user_id'];
			$mesazhi=addUser($_POST['firstname'],$_POST['lastname'],
			$_POST['departments'],$_POST['password'],$_POST['email'],
			$_POST['username'],$_POST['phone'],$registrar);
		}
	?>
	<!-- card-register forma e regjistrimit--> 
    <div class="card  mx-auto mt-30 ">
		<div class="card-header h4">Fatura</div>
		<div class="card-body mx-5">
			<form action="" method="POST">  
                <div class="form-group">
					<div class="form-row">
					  <div class="col-md-4">
						<label class="h6" for="salesno">Nr. i Faturës: </label>
						<input name="salesno" class="form-control" id="salesno" type="text" aria-describedby="nameHelp">
					  </div>
					  <div class="col-md-4">
						<label class="h6" for="lastname">Data e fatures: </label>
						<input name="salesdate" class="form-control" id="salesdate" 
						type="date" aria-describedby="nameHelp">
					  </div>
					  <div class="col-md-4">
						<label class="h6" for="salestype">Lloji i Faturës: </label>
						<select name="salestype" class="form-control"  id="salestype">
							<option value=''> zgjedh opsionin </option>
							<option value='pro-fature'> pro-fature </option>
							<option value='fature'> fature </option>
						</select>
					  </div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
					  <div class="col-md-6">
						<label for="client">Klienti :</label>
						<?php
							echo '<select name="clients" class="form-control"  id="clients">';
							$clients=findClients();
							
							while($client=mysqli_fetch_array($clients)){
								echo "<option value='".$client['client_id']."'> ".$client['contact_person']. "</option>";
							}
							echo '</select>';
						?>
					  </div>
					  <div class="col-md-6">
						<label for="description">Pershkrimi :</label>
						<input name="description" class="form-control" id="description" 
						type="text" aria-describedby="nameHelp">
					  </div>
					</div>
				</div>
				<div class="form-group">
					
				</div>
				  <div class="form-group">
					<div class="form-row">
					  <div class="col-md-6">
						<label class="h6" for="salestype">Lloji i Faturës: </label>
						<select name="salestype" class="form-control"  id="salestype">
							<option value=''> zgjedh opsionin </option>
							<option value='pro-fature'> pro-fature </option>
							<option value='fature'> fature </option>
						</select>
					  </div>
					  <div class="col-md-6">
						<label for="reference">Referenca :</label>
						<input name="reference" class="form-control" id="reference" 
						type="text" aria-describedby="nameHelp">
					  </div>
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
						<th><input type="button" value="+" id="add" class="btnbtn-primary"></th>  
					</thead>  
                    <tbody class="detail">  
						<tr>   
							<td>
							<?php
								echo '<select name="services[]" class="form-control" id="services">';
								echo "<option value=''> zgjedh opsionin </option>";
								$services=findServices();
								
								while($service=mysqli_fetch_array($services)){
									echo "<option value='".$service['service_id']."'> "
									.$service['service_name']. "</option>";
								}
								echo '</select>';
							?>
							</td>  
							<td><input type="text" class="form-control quantity" name="quantity[]"></td>  
							<td><input type="text" class="form-control price" name="price[]"></td>  
							<td><input type="text" class="form-control discount" name="discount[]"></td>
							<td><input type="text" class="form-control discount" name="discount[]"></td>		
							<td><input type="text" class="form-control amount" name="amount[]"></td>  
							<td><a href="#" class="remove">Delete</td>  
						</tr>  
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
			});  
			$('body').delegate('.quantity,.price,.discount','keyup',function(){  
				vartr=$(this).parent().parent();  
				varqty=tr.find('.quantity').val();  
				var price=tr.find('.price').val();  
			  
				var dis=tr.find('.discount').val();  
				varamt =(qty * price)-(qty * price *dis)/100;  
				tr.find('.amount').val(amt);  
				total();  
			});  
		});  
		function total(){  
			var t=0;  
			$('.amount').each(function(i,e)   
			{  
			varamt =$(this).val()-0;  
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
				echo '<select name="services[]" class="form-control" id="services">';
				echo '<option value=""> zgjedh opsionin </option>';
				$services=findServices();
				while($service=mysqli_fetch_array($services)){
					echo '<option value="'.$service['service_id'].'"> '
					.$service['service_name']. '</option>';
				}
				echo '</select>';?></td>'+  
			'<td><input type="text" class="form-control quantity" name="quantity[]"></td>'+  
			'<td><input type="text" class="form-control price" name="price[]"></td>'+  
			'<td><input type="text" class="form-control discount" name="discount[]"></td>'+
			'<td><input type="text" class="form-control discount" name="discount[]"></td>'+  
			'<td><input type="text" class="form-control amount" name="amount[]"></td>'+  
			'<td><a href="#" class="remove">Delete</td>'+  
			'</tr>';  
			$('.detail').append(vartr);   
		}	
</script>  
	