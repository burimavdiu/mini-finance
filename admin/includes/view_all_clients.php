<html>   
 <body>
  <!-- Example DataTables Card-->
  <div class="card mb-3">
    <div class="card-header">
     <i class="fa fa-fw fa-users"></i>Lista me të gjithë klientët</div>
    <div class="card-body" style ="overflow: scroll;">
      <?php if (isset($_SESSION['mesazhi'])){?>		
			  <div class="alert alert-success malert">
				  <?php echo $_SESSION['mesazhi'];
					unset($_SESSION['mesazhi']);
				  ?>
				  
			  </div>
		  <?php }?>	
		  <?php
		 
			if(isset($_GET['source'])){
				$client_id = $_GET['client_id'];
				delteClient($client_id);
			}
		  ?>
	  
	  <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Klienti</th>
              <th>Personi kontaktues</th>
              <th>Pozita</th>
              <th>Adresa</th>
              <th>Qyteti</th>
              <th>Shteti</th>
              <th>Telofoni i punës</th>
              <th>Telofoni mobil</th>
              <th>Email</th>
              <th>Web Faqja</th>
              <th>Nr. Regjistrimit të Klientit</th>
              <th>Nr. Fiskal</th>
              <th>Nr. TVSH</th>
              <th>Regjistroi</th>
              <th>Koha e regjistrimit</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Klienti</th>
              <th>Përsoni kontaktues</th>
              <th>Pozita</th>
              <th>Adresa</th>
              <th>Qyteti</th>
              <th>Shteti</th>
              <th>Telofoni i punës</th>
              <th>Telofoni mobil</th>
              <th>Email</th>
              <th>Web Faqja</th>
              <th>Nr. Regjistrimit të Klientit</th>
              <th>Nr. Fiskal</th>
              <th>Nr. TVSH</th>
              <th>Regjistroi</th>
              <th>Koha e regjistrimit</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </tfoot>
          <tbody>
		<?php
            $clients=findClients();
            while($client=mysqli_fetch_array($clients)){
                $client_id=$client['client_id'];
                echo "<tr>";
                echo "<td>".  $client['client'] . "</td>";
                echo "<td>".  $client['contact_person'] . "</td>";
                echo "<td>".  $client['job_position'] . "</td>";
                echo "<td>".  $client['address_1'] . "</td>";
                echo "<td>".  $client['city'] . "</td>";
                echo "<td>".  $client['state'] . "</td>";
                echo "<td>".  $client['mobile_no'] . "</td>";
                echo "<td>".  $client['tel_no'] . "</td>";
                echo "<td>".  $client['client_email'] . "</td>";
                echo "<td>".  $client['client_web'] . "</td>";
                echo "<td>".  $client['business_register_no'] . "</td>";
                echo "<td>".  $client['fiscal_no'] . "</td>";
                echo "<td>".  $client['vat_no'] . "</td>";
                echo "<td>".  $client['user_id'] . "</td>";
                echo "<td>".  $client['registration_date'] . "</td>";
                echo "<td><a href='clients.php?source=edit_client&client_id=$client_id'><span clas='btn-link'><i class='fa fa-edit'></i>Edit</span></a></td>";
				echo "<td> <a href='clients.php?client_id=$client_id'
					data-toggle='modal'
					data-target='#confirm-delete' class='confirm-delete'>
						<span class='btn-link'><i class='fa fa-fw fa-remove'></i>Delete</span>	
						</a></td>";
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
						Fshirja e Klientit
					</div>
					<div class="modal-body">
						A dëshironi të fshini klientin ?
					</div>
					<div class="modal-footer">
					  <a class='btn btn-danger' 
					  href='clients.php?source=delete_client&client_id=<?php echo $client_id; ?>'> Po</a>
					  <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Jo</a>
					</div>
				</div>
			</div>
		</div>	
 </body>
 </html>
 
 

 
 
  

