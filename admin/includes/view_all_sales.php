
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
				echo $sale_id = $_GET['sale_id'];
				//delteSale($sale_id);
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
					<th>PDF</th>
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
					<th>PDF</th>
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
				echo "<td><a href='sales.php?delete_sale=$sale_id'
					data-toggle='modal'
				data-target='#confirm-delete' class='confirm-delete'>Delete</a></td>";
				echo "<td><a target='_blank' href='includes/print_invoice.php?pdf=1&sale_id=$sale_id'>PDF</a></td>";
				
				echo "</tr>";
				}
			  ?>

              </tbody>
            </table>
          </div>
        </div>
		<?php
			if(isset($_GET['delete_sale'])){
				$sale_id = $_GET['delete_sale'];
				delteSale($sale_id);
			}
		?>
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
					  <a class='btn btn-danger delete_modal_link' 
					  href=''> Po</a>
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

		  <script>

$(document).ready(function(){

	$(".confirm-delete").on('click',function(){
	
		var href = $(this).attr("href");

		$(".delete_modal_link").attr("href",href);
	
	});

});
</script>