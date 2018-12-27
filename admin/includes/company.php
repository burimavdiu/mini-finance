<?php
    $company_res=findCompany();
    if ($company_res) {
        $company=mysqli_fetch_assoc($company_res);
        $company_id=$company["company_id"];
    }
    $mesazhi="";
    if (isset($_SESSION['mesazhi'])){?>
      <div class="alert alert-success malert">
          <?php echo $_SESSION['mesazhi'];
            unset($_SESSION['mesazhi']);
          ?>
      </div>
<?php }
    if(isset($_POST['updateCompany'])) {
        $mesazhi=updateCompany($_POST["company_id"], $_POST["company_name"], $_POST["address_1"], $_POST["address_2"], $_POST["tel_no"], $_POST["mobile_no"], $_POST["fax_no"], $_POST["business_no"], $_POST["vat"], $_POST["fiscal_no"], $_POST["bank_acc_1"], $_POST["bank_acc_2"], $_POST["company_email"], $_POST["company_web"]);
    }

?>
<!-- card-register forma e regjistrimit-->
<div class="card  mx-auto mt-30 ">
  <div class="card-header h4">Konfigurimi Kompania</div>
  <div class="card-body mx-5">
    <form id="needs-validation" method="post" role="form" novalidate enctype="multipart/form-data">		  
       <input name="company_id" value="<?php if(!empty($company_id)) echo $company_id;?>"
            class="form-control" id="company_id" type="hidden">
      <div class="form-group">
        <div class="form-row mb-3">
          <div class="col-md-4">
            <label class="h6" for="company_name">Emri:</label>
            <input name="company_name" value="<?php if(!empty($company["company_name"])) echo $company["company_name"];?>"
            class="form-control" id="company_name" type="text" required>
			<div class="invalid-feedback">
				Ju lutem plotësoni emrin.
			</div>
		  </div>
          <div class="col-md-4">
            <label class="h6" for="address_1">Adresa 1:</label>
            <input name="address_1" value="<?php if(!empty($company["address_1"])) echo $company["address_1"];?>" 
            class="form-control" id="address_1" type="text" aria-describedby="nameHelp"  >
			<div class="invalid-feedback">
				Ju lutem plotësoni adresën .
			</div>
		  </div>
          <div class="col-md-4">
            <label class="h6" for="address_2">Adresa 2:</label>
            <input name="address_2" value="<?php if(!empty($company["address_2"])) echo $company["address_2"];?>" 
            class="form-control" id="address_2" type="text" aria-describedby="nameHelp">
          </div>
        </div>
        <div class="form-row mb-3">
          <div class="col-md-4">
            <label class="h6" for="tel_no">Telefoni fiks:</label>
            <input name="tel_no" value="<?php if(!empty($company["tel_no"])) echo $company["tel_no"];?>"
            class="form-control" id="tel_no" type="text">
          </div>
          <div class="col-md-4">
            <label class="h6" for="mobile_no">Telefoni mobil:</label>
            <input name="mobile_no" value="<?php if(!empty($company["mobile_no"])) echo $company["mobile_no"];?>" 
            class="form-control" id="mobile_no" type="text" aria-describedby="nameHelp" required>
			<div class="invalid-feedback">
				Ju lutem plotësoni telefonin mobil.
			</div>
		  </div>
          <div class="col-md-4">
            <label class="h6" for="fax_no">Faksi:</label>
            <input name="fax_no" value="<?php if(!empty($company["fax_no"])) echo $company["fax_no"];?>" 
            class="form-control" id="fax_no" type="text" aria-describedby="nameHelp">
          </div>
        </div>
        <div class="form-row mb-3">
          <div class="col-md-4">
            <label class="h6" for="business_no">Numri i biznesit:</label>
            <input name="business_no" value="<?php if(!empty($company["business_no"])) echo $company["business_no"];?>"
            class="form-control" id="business_no" type="text" required>
			<div class="invalid-feedback">
				Ju lutem plotësoni numrin e biznesit.
			</div>
		  </div>
          <div class="col-md-4">
            <label class="h6" for="vat">TVSH:</label>
            <input name="vat" value="<?php if(!empty($company["vat"])) echo $company["vat"];?>" 
            class="form-control" id="vat" type="text" aria-describedby="nameHelp">
          </div>
          <div class="col-md-4">
            <label class="h6" for="fiscal_no">Numri fiskal:</label>
            <input name="fiscal_no" value="<?php if(!empty($company["fiscal_no"])) echo $company["fiscal_no"];?>" 
            class="form-control" id="fiscal_no" type="text" aria-describedby="nameHelp">
          </div>
        </div>
        <div class="form-row mb-3">
          <div class="col-md-6">
            <label class="h6" for="bank_acc_1">Llogaria bankare 1:</label>
            <input name="bank_acc_1" value="<?php if(!empty($company["bank_acc_1"])) echo $company["bank_acc_1"];?>"
            class="form-control" id="bank_acc_1" type="text" required>
			<div class="invalid-feedback">
				Ju lutem plotësoni llogrinë bankare.
			</div>
		  </div>
          <div class="col-md-6">
            <label class="h6" for="bank_acc_2">Llogaria bankare 2:</label>
            <input name="bank_acc_2" value="<?php if(!empty($company["bank_acc_2"])) echo $company["bank_acc_2"];?>" 
            class="form-control" id="bank_acc_2" type="text" aria-describedby="nameHelp">
          </div>
        </div>
        <div class="form-row mb-3">
          <div class="col-md-6">
            <label class="h6" for="company_email">Email-i:</label>
            <input name="company_email" value="<?php if(!empty($company["company_email"])) echo $company["company_email"];?>"
            class="form-control" id="company_email" type="email" >
			
		  </div>
          <div class="col-md-6">
            <label class="h6" for="company_web">Web-i:</label>
            <input name="company_web" value="<?php if(!empty($company["company_web"])) echo $company["company_web"];?>" 
            class="form-control" id="company_web" type="text" aria-describedby="nameHelp"  >
            
          </div>
        </div>
        <div class="form-row mb-3">
          <div class="col-md-3 col-sm-6">
            <label class="h6" for="logo">Logo</label>
            <img name="company_logo"  src="<?php if(!empty($company['company_logo'])) echo LOGO_PATH.$company['company_logo'];?>" class="form-control" id="company_logo" alt="Company logo">
          </div>
          <div class="col-md-3 col-sm-6">
            <label class="h6" for="logo_upload">Zgjedh logo tjetër</label>
            <input name="logo_upload" class="form-control" id="logo_upload" type="file">
          </div>
        </div>
      </div>	
        <div class="alert alert-danger d-none jmesazhi">
          <span id="message"></span>
        </div>
      <input name="updateCompany" type="submit" class="btn btn-primary btn-block" value="Modifiko">
    </form>
  </div>
</div>
<script>
    /*var exceeds_logo_size = false;
    $('#logo_upload').bind('change', function() {
        if (this.files[0].size > 620768) {
            exceeds_logo_size = true;
        } else {
            exceeds_logo_size = false;
        }
    });
    $("#updatecompany").submit(function () {
        var message = "";
        var kontrollues=false;
        function validateEmail($email) {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return emailReg.test($email);
        }
        if ($("#company_name").val() == "") {
            message="Ju lutem plotësoni emrin e kompanisë<br>";
            kontrollues=true;
        }
        if ($("#address_1").val() == "") {
            message+="Ju lutem plotësoni adresën<br>";
            kontrollues=true;
        }
        if ($("#mobile_no").val() == "") {
            message+="Ju lutem plotësoni telefonin mobil<br>";
            kontrollues=true;
        }
        if ($("#business_no").val() == "") {
            message+="Ju lutem plotësoni numrin e biznesit<br>";
            kontrollues=true;
        }
        if ($("#bank_acc_1").val() == "") {
            message+="Ju lutem plotësoni llogrinë bankare<br>";
            kontrollues=true;
        }
        if ($("#company_email").val() == "" || !validateEmail($("#company_email").val())) {
            message+="Ju lutem plotësoni | verifikoni email-in<br>";
            kontrollues=true;
        }
        if (exceeds_logo_size) {
            message+="Ju lutem zgjedhni një logo më të vogël<br>";
            kontrollues=true;
        }
        if(kontrollues) {
            $(".jmesazhi").removeClass("d-none");
            $("#message").html(message);
            return false;
        } else {
            return true;
        }
    });
    setTimeout(function(){
        $('.malert').addClass('d-none');
    }, 8000); 
	*/
</script>