<?php
	$mesazhi="";
	if (isset($_SESSION['mesazhi'])){?>
	<div class="alert alert-success malert">
		<?php echo $_SESSION['mesazhi'];
			unset($_SESSION['mesazhi']);
		?>
	</div>
	<?php
	}
		if(isset($_POST['btnSave'])){
			$service_id=escape_string($_POST['service_edit_id']);
			$service_name=escape_string($_POST['service']);
			$service_description=escape_string($_POST['description']);
			$service_price=escape_string($_POST['price']);
			if($service_id=="" || empty($service_id)){
				addService($service_name,$service_description,$service_price);
			}
			else{
				updateService($service_id,$service_name,$service_description,$service_price);
			}
		}
		
	?>  
<!-- card-register forma e regjistrimit-->
<div class="card  mx-auto mt-30 ">
  <div class="card-header h4">Sherbimet / Produktet</div>
  <div class="row card-body">
	<div class="col-lg-5">
		<form id="needs-validation" method="post" role="form" novalidate>
			<?php
				if(isset($_GET['edit'])){
					$service_edit_id=escape_string($_GET['edit']);
					$result_select_service=findServiceById($service_edit_id);
					$data_service=mysqli_fetch_assoc($result_select_service);
					$se_title=$data_service['service_name'];
					$se_description=$data_service['service_description'];
					$se_price=$data_service['actual_price'];
				}
			?>
			<input value="<?php if(isset($service_edit_id))echo $service_edit_id;?>" 
							type="hidden" name="service_edit_id" >
			<div class="form-group">
				<label class="h6" for="service">Sherbimi / Produkti:</label>
				<input name="service" class="form-control" id="service" type="text" 
				value="<?php if(isset($se_title))echo $se_title;?>"
				aria-describedby="emailHelp" required>
				<div class="invalid-feedback">
					Ju lutem plotësoni emrin e sherbimit.
				</div>
			</div>
		  	<div class="form-group">
				<label class="h6" for="description">Pershkrimi:</label>
				<input name="description" class="form-control" id="description" 
				value="<?php if(isset($se_description))echo $se_description;?>"
				type="text" aria-describedby="emailHelp" required>
				<div class="invalid-feedback">
					Ju lutem plotësoni përshkrimin.
				</div>
			</div>
			<div class="form-group">
				<label class="h6" for="price">Cmimi:</label>
				<input name="price" class="form-control" id="price"
				value="<?php if(isset($se_price))echo $se_price;?>"	
				type="text" aria-describedby="emailHelp" required>
				<div class="invalid-feedback">
					Ju lutem plotësoni Çmimin.
				</div>
			</div>
			<div class="alert alert-danger d-none jmesazhi">
			  <span id="message"></span>
			</div>
		  <input name="btnSave" type="submit" class="btn btn-primary btn-block" 
		  value="Ruaj">
		</form>
	</div>
	<div class="col-lg-7">
		<?php
			if(isset($_GET['delete'])){
				$service_id = $_GET['delete'];
				delteService($service_id);
			}
		  ?>
		<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="thead-default">
                <tr>
                    <th> Sherbimi </th>
					<th> Pershkrimi </th>
					<th> Cmimi </th>
					<th>  </th>
					<th>  </th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th> Sherbimi </th>
					<th> Pershkrimi </th>
					<th> Cmimi </th>
					<th>  </th>
					<th>  </th>
                </tr>
              </tfoot>
              <tbody>
				<?php
				$services=findServices();
				while($service=mysqli_fetch_array($services)){
					$service_id=$service['service_id'];
					echo "<tr>";
					echo "<td>".  $service['service_name'] . "</td>";
					echo "<td>".  $service['service_description'] . "</td>";
					echo "<td>".  $service['actual_price'] . "</td>";
					echo "<td><a href='configurations.php?source=services&edit=$service_id'>Edit</a></td>";
					echo "<td><a href='configurations.php?source=services&delete=$service_id'
					data-toggle='modal'
				data-target='#confirm-delete' class='confirm-delete'>Delete</a></td>";
					echo "</tr>";
				}
			  ?>

              </tbody>
            </table>
	</div>
  </div>
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Fshirja e Serbimit/Produktit
				</div>
				<div class="modal-body">
					A dëshironi të fshini sherbimin ?
				</div>
				<div class="modal-footer">
				  <a class='btn btn-danger delete_modal_link' 
				  href=''> Po</a>
				  <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Jo</a>
				</div>
			</div>
		</div>
	</div>
</div>
	<script>
	$("#saveservice").submit(function () {
		kontrollues=false;
		
		if ($("#service").val() == "") {
            message="Ju lutem plotësoni sherbimin<br>";
            kontrollues=true;
        }
		if ($("#description").val() == "") {
            message+="Ju lutem plotësoni pershkrimin<br>";
            kontrollues=true;
        }
		if ($("#price").val() == "") {
            message+="Ju lutem plotësoni cmimin<br>";
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
  </script>
	<script>
$(document).ready(function(){

$(".confirm-delete").on('click',function(){
	 
		var href = $(this).attr("href");

		 $(".delete_modal_link").attr("href",href);
	 
		});

});
</script>