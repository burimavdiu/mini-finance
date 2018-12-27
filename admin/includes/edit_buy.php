<?php
    if(isset($_GET['buy_id'])){
        $buy_id=escape_string($_GET['buy_id']);
        $buy_res=findBuyById($buy_id);
        $buy=mysqli_fetch_assoc($buy_res);

        $client_id=$buy['client_id'];
        $client_name=$buy['client'];
        $buy_date=$buy['sale_date'];
        $buy_description=$buy['description'];
        $buy_type=$buy['sale_type'];
        $payment_date=$buy['payment_date'];
        $payment_ref=$buy['payment_ref'];
        $total_price=$buy['total_price'];
    }
    if(isset($_POST['editbuy'])){
        $buy=array();
        $buy['buy_id']=$buy_id;
        $buy['client_id']=escape_string($_POST['client']);
        $buy['description']=escape_string($_POST['buy_description']);	
        $buy['buy_date']=escape_string($_POST['buy_date']);
        $buy['payment_date']=escape_string($_POST['payment_date']);
        $buy['payment_ref']=escape_string($_POST['payment_ref']);
        $buy['buy_type']=escape_string($_POST['buy_type']);
        $buy['total_price']=escape_string($_POST['total_price']);
        /*$buy_details=array();
        $sd_count=count($_POST['service']);
        for($i = 0; $i<$sd_count; $i++)  
        {
            $sd['service']=$_POST['service'][$i];
            $sd['quantity']=$_POST['quantity'][$i];
            $sd['unit']=$_POST['unit'][$i];
            array_push($buy_details, $sd);
        }*/
        if (editBuy($buy)) {
            $_SESSION['mesazhi'] = "Editimi i blerjes {$buy_id} u realizua sukses";
		    header("Location: buys.php");
            ?>
                <!-- <div class="alert alert-success malert">Editimi i blerjes u realizua me sukses</div> -->
        <?php } else { ?>
            <div class="alert alert-danger malert">Gabim gjate editimit te blerjes: <?php echo mysqli_error($dbconn);?></div>
        <?php }
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
                            echo "<option value='" . $client["client_id"] ."'";
                            if ($client["client_id"] === $client_id) {
                                echo " selected";
                            }
                            echo ">" . $client['client'] . "</option>";
                        }
                        echo "</select>";
                        echo "<div class='invalid-feedback'>Ju lutem zgjedhni klientin.</div>";
                    ?>
                  </div>
                  <div class="col-md-4">
                    <label class="h6" for="invoice_no">Nr. i faturës:</label>
                    <input name="invoice_no" class="form-control" id="invoice_no" value="<?php if(!empty($payment_date)) echo $payment_date;?>" type="text" aria-describedby="nameHelp" required>
                    <div class="invalid-feedback">Ju lutem plotësoni numrin e faturës.</div>
                  </div>
                  <div class="col-md-4">
                    <label class="h6" for="buy_description">Përshkrimi:</label>
                    <input name="buy_description" class="form-control" id="buy_description" value="<?php if(!empty($buy_description)) echo $buy_description;?>" type="text" aria-describedby="nameHelp" required>
                      <div class="invalid-feedback">Ju lutem plotësoni përshkrimin.</div>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-4">
                    <label class="h6" for="buy_date">Data e faturës:</label>
                    <input name="buy_date" class="form-control" id="buy_date" value="<?php if(!empty($buy_date)) echo $buy_date;?>" type="date" aria-describedby="nameHelp" required>
                      <div class="invalid-feedback">Ju lutem zgjedhni datën e faturës.</div>
                  </div>
                  <div class="col-md-4">
                    <label class="h6" for="payment_date">Data e pagesës:</label>
                    <input name="payment_date" class="form-control" id="payment_date" value="<?php if(!empty($payment_date)) echo $payment_date;?>" type="date" aria-describedby="nameHelp" required>
                      <div class="invalid-feedback">Ju lutem zgjedhni datën e pagesës.</div>
                  </div>		
                  <div class="col-md-4">
                    <label class="h6" for="payment_ref">Referenca:</label>
                    <input name="payment_ref" class="form-control" id="payment_ref" value="<?php if(!empty($payment_ref)) echo $payment_ref;?>" type="text" aria-describedby="nameHelp" required>
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
                        <?php
                            $values = ["pro-fature", "fature"];
                            $types = ["Pro-faturë", "Faturë"];
                            for ($i = 0; $i < count($values); $i++) {
                                echo "<option value='" . $values[$i] . "'";
                                if ($values[$i] === $buy_type) {
                                    echo " selected";
                                }
                                echo ">" . $types[$i] . "</option>";
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">Ju lutem zgjedhni llojin e faturës.</div>
                  </div>
                  <div class="col-md-6">
                    <label class="h6" for="buy_type">Totali:</label>
                      <input name="total_price" class="form-control" id="total_price" value="<?php if(!empty($total_price)) echo $total_price; ?>" type="text" aria-describedby="nameHelp" required>
                      <div class="invalid-feedback">Ju lutem plotësoni shumën totale.</div>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-6">
                    <input name="editbuy" class="form-control btn btn-primary" id="addbuy"  type="submit" value="Modifiko Blerje" aria-describedby="nameHelp">
                  </div>
                </div>
            </div>
        </form>  
  </div>
</div>
<?php $temp = findServicesJS();?>
<script>
    setTimeout(function(){
        $('.malert').addClass('d-none');
    },8000);
</script>