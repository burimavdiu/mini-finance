
      <!-- Example DataTables Card-->
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
		setTimeout(function(){
			$('.malert').addClass('d-none');
		},8000);
	   </script>