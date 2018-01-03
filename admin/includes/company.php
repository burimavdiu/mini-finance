
	<?php
		$mesazhi="";
		
	?>
	<!-- card-register forma e regjistrimit--> 
    <div class="card  mx-auto mt-30 ">
      <div class="card-header h4">Regjistrimi i Përdoruesit</div>
      <div class="card-body mx-5">
        <form method="post" id="adduser">		  
		  <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label class="h6" for="firstname">Emri: </label>
                <input name="firstname" class="form-control" id="firstname" type="text" aria-describedby="nameHelp">
              </div>
              <div class="col-md-6">
                <label class="h6" for="lastname">Mbiemri: </label>
                <input name="lastname" class="form-control" id="lastname" type="text" aria-describedby="nameHelp">
              </div>
            </div>
          </div>
            <div class="form-group">
            <label for="department">Departamenti :</label>
            <?php
                echo '<select name="departments" class="form-control"  id="department">';
				$departments=findDepartments();
				
                while($dep=mysqli_fetch_array($departments)){
                    echo "<option value='".$dep['dep_id']."'> ".$dep['dep_name']. "</option>";
                }
                echo '</select>';
            ?>
          </div>
          <div class="form-group">
            <label class="h6" for="email">Email :</label>
            <input name="email" class="form-control" id="email" type="text" aria-describedby="emailHelp" >
          </div>
		  <div class="form-group">
            <label class="h6" for="phone">Telefoni :</label>
            <input name="phone" class="form-control" id="phone" type="text" aria-describedby="telefoniHelp" >
          </div>
		   <div class="form-group">
            <label class="h6" for="username">Përdoruesi :</label>
            <input name="username" class="form-control" id="username" type="text" aria-describedby="perdoruesiHelp" >
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label class="h6" for="password">Fjalëkalimi :</label>
                <input name="password" class="form-control" id="password" type="password">
              </div>
              <div class="col-md-6">
                <label class="h6" for="confirmPassword">Konfirmo Fjalëkalimin :</label>
                <input class="form-control" id="confirmPassword" type="password">
              </div>
            </div>
            </div>
						
			<div class="alert alert-danger d-none jmesazhi">
			  <span id="message"></span>
			</div>
			
		  <input name="addUser" type="submit" class="btn btn-primary btn-block" value="Regjistro">
        </form>
      </div>
    </div>
<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Lista e Kompanive</div>
        <div class="card-body">
		  <?php if (isset($_SESSION['mesazhi'])){?>		
			  <div class="alert alert-success malert">
				  <?php echo $_SESSION['mesazhi'];
					unset($_SESSION['mesazhi']);
				  ?>
			  </div>
		  <?php }
			if(isset($_GET['source'])){
				$user_id = $_GET['user_id'];
				delteUser($user_id);
			}
		  ?>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Emri</th>
                  <th>Adresa 1</th>
                  <th>Adresa 2</th>
                  <th>Telefoni</th>
                  <th>Mobili</th>
                  <th>Faksi</th>
                  <th>Nr. i biznesit</th>
                  <th>TVSH</th>
                  <th>Nr. fiskal</th>
                  <th>LLogaria bankare 1</th>
                  <th>LLogaria bankare 2</th>
                  <th>Emaili i kompanisë</th>
                  <th>Webi i kompanisë</th>
                  <th>Edit</th>
				  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Emri</th>
                  <th>Adresa 1</th>
                  <th>Adresa 2</th>
                  <th>Telefoni</th>
                  <th>Mobili</th>
                  <th>Faksi</th>
                  <th>Nr. i biznesit</th>
                  <th>TVSH</th>
                  <th>Nr. fiskal</th>
                  <th>LLogaria bankare 1</th>
                  <th>LLogaria bankare 2</th>
                  <th>Emaili i kompanisë</th>
                  <th>Webi i kompanisë</th>
                  <th>Edit</th>
				  <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
				<?php
				$companies=findCompanies();
				while($company=mysqli_fetch_array($companies)) {
				$company_id=$company['company_id'];
				echo "<tr>";
				echo "<td>".  $company_id . "</td>";
				echo "<td>".  $company['company_name'] . "</td>";
				echo "<td>".  $company['address_1'] . "</td>";
				echo "<td>".  $company['address_2'] . "</td>";
				echo "<td>".  $company['tel_no'] . "</td>";
				echo "<td>".  $company['mobile_no'] . "</td>";
				echo "<td>".  $company['fax_no'] . "</td>";
				echo "<td>".  $company['business_no'] . "</td>";
				echo "<td>".  $company['vat'] . "</td>";
				echo "<td>".  $company['fiscal_no'] . "</td>";
				echo "<td>".  $company['bank_acc_1'] . "</td>";
				echo "<td>".  $company['bank_acc_2'] . "</td>";
				echo "<td>".  $company['company_email'] . "</td>";
				echo "<td>".  $company['company_web'] . "</td>";
				echo "<td><a href='companies.php?source=edit_company&company_id=$company_id'>Edit</a></td>";
				echo "<td><a href='companies.php?company_id=$company_id' data-toggle='modal' data-target='#confirm-delete' class='confirm-delete'>Delete</a></td>";
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
						Fshirja e kompanisë
					</div>
					<div class="modal-body">
						A dëshironi të fshini kompaninë?
					</div>
					<div class="modal-footer">
					  <a class='btn btn-danger' 
					  href='companies.php?source=delete_company&company_id=<?php echo $company_id; ?>'> Po</a>
					  <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Jo</a>
					</div>
				</div>
			</div>
		</div>
	<script>
	$("#adduser").submit(function () {
       
		
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
    setTimeout(function(){
        $('.malert').addClass('d-none');
    },8000);
  </script>