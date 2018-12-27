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
			$municipality_id=escape_string($_POST['municipality_edit_id']);
			$municipality_name=escape_string($_POST['municipality']);
			$municipality_description=escape_string($_POST['description']);
			if($municipality_id=="" || empty($municipality_id)){
				echo $municipality_id;
			   addMunicipality($municipality_name,$municipality_description);
			   
			}
			else{
				updateMunicipality($municipality_id,$municipality_name,$municipality_description);
				echo 'update';
			}
		}
		
	?>  
<!-- card-register forma e regjistrimit-->
<div class="card  mx-auto mt-30 ">
  <div class="card-header h4">Komuna</div>
  <div class="row card-body">
	<div class="col-lg-5">
		<form id="needs-validation" method="post" role="form" novalidate>
			<?php
				if(isset($_GET['edit'])){
					$municipality_edit_id=escape_string($_GET['edit']);
					$result_select_municipality=findMunicipalityById($municipality_edit_id);
					$data_municipality=mysqli_fetch_assoc($result_select_municipality);
					$municipality_title=$data_municipality['name'];
					$description=$data_municipality['description'];
				}
			?>
			<input value="<?php if(isset($municipality_edit_id))echo $municipality_edit_id;?>" 
							type="hidden" name="municipality_edit_id" >
			<div class="form-group">
				<label class="h6" for="municipality">Emri Komunës:</label>
				<input name="municipality" class="form-control" id="municipality" type="text" 
				value="<?php if(isset($municipality_title))echo $municipality_title;?>"
				aria-describedby="municipalityHelp" required >
				<div class="invalid-feedback">
							Ju lutem plotësoni emrin e Komunës.
				</div>
			</div>
		  	<div class="form-group">
				<label class="h6" for="description">Pershkrimi:</label>
				<textarea name="description" class="form-control" id="description" 
				type="text" aria-describedby="emailHelp" ><?php if(isset($description))echo $description;?></textarea>
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
				$municipality_id = escape_string($_GET['delete']);
				deleteMunicipality($municipality_id);
			}
		  ?>
		<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="thead-default">
                <tr>
                    <th> Komuna </th>
					<th> Pershkrimi </th>
					<th>  </th>
					<th>  </th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th> Komuna </th>
					<th> Pershkrimi </th>
					<th>  </th>
					<th>  </th>
                </tr>
              </tfoot>
              <tbody>
				<?php
				$municipalities=findMunicipalites();
				while($municipality=mysqli_fetch_array($municipalities)){
					$municipality_id=$municipality['municipality_id'];
					echo "<tr>";
					echo "<td>".  $municipality['name'] . "</td>";
					echo "<td>".  $municipality['description'] . "</td>";
					echo "<td><a href='configurations.php?source=municipalities&edit=$municipality_id'>Edit</a></td>";
					echo "<td><a href='configurations.php?source=municipalities&delete=$municipality_id'
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
					Fshirja e Komunës
				</div>
				<div class="modal-body">
					A dëshironi të fshini komunën ?
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
	/* $("#savemunicipality").submit(function () {
		kontrollues=false;
		
		if ($("#municipality").val() == "") {
            message="Ju lutem plotësoni komunën<br>";
            kontrollues=true;
        }
		/*if ($("#description").val() == "") {
            message+="Ju lutem plotësoni pershkrimin<br>";
            kontrollues=true;
        }*/
		/*if(kontrollues){
			$(".jmesazhi").removeClass("d-none");
			$("#message").html(message);
			return false;
		}else{
			return true;
		}
		
    }); */
		
  </script>
		<script>
$(document).ready(function(){

$(".confirm-delete").on('click',function(){
	 
		var href = $(this).attr("href");

		 $(".delete_modal_link").attr("href",href);
	 
		});

});
</script>