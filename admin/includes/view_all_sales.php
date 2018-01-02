
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Lista e Shitjeve</div>
        <div class="card-body">
		  <?php if (isset($_SESSION['mesazhi'])){?>		
			  <div class="alert alert-success malert">
				  <?php echo $_SESSION['mesazhi'];
					unset($_SESSION['mesazhi']);
				  ?>
				  
			  </div>
		  <?php }?>	
		  <?php
		 
			if(isset($_GET['source'])){
				$user_id = $_GET['user_id'];
				delteUser($user_id);
			}
		  ?>
		  
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nr Fatures</th>
                  <th>Data e Fatures</th>
                  <th>Klienti</th>
                  <th>Pershkrimi</th>
				  <th>Shuma</th>
				  <th>Data e Pageses</th>
				  <th>Statusi</th>
                  <th>Edit</th>
				  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nr Fatures</th>
                  <th>Data e Fatures</th>
                  <th>Klienti</th>
                  <th>Pershkrimi</th>
				  <th>Shuma</th>
				  <th>Data e Pageses</th>
				  <th>Statusi</th>
                  <th>Edit</th>
				  <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
				<?php
				$sales=findSales();
				while($sale=mysqli_fetch_array($sales)){
				$sale_id=$sale['sale_id'];
				echo "<tr>";
				
				echo "<td>".  $sale['sale_id'] . "</td>";
				echo "<td>".  $sale['sale_date'] . "</td>";
				echo "<td>".  $sale['client'] . "</td>";
				echo "<td>".  $sale['description'] . "</td>";
				echo "<td>".  $sale['sale_id'] . "</td>";
				echo "<td>".  $sale['payment_date'] . "</td>";
				echo "<td>".  $sale['status'] . "</td>";
				echo "<td><a href='sales.php?source=edit_sale&sale_id=$sale_id'>Edit</a></td>";
				echo "<td><a href='sales.php?sale_id=$sale_id'
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
						Fshirja e Perdoruesit
					</div>
					<div class="modal-body">
						A dëshironi të fshini përdoruesin ?
					</div>
					<div class="modal-footer">
					  <a class='btn btn-danger' 
					  href='users.php?source=delete_user&user_id=<?php echo $user_id; ?>'> Po</a>
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