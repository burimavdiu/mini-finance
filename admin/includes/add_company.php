
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
  </script>