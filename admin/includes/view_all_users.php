
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Lista e Përdoruesve</div>
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
				echo $user_id = $_GET['user_id'];
				//delteUser($user_id);
			}
		  ?>
		  
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Emri</th>
                  <th>Mbiemri</th>
									<th>Perdoruesi</th>
                  <th>Email</th>
                  <th>Telefoni</th>
                  <th>Edit</th>
				  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Emri</th>
                  <th>Mbiemri</th>
									<th>Perdoruesi</th>
                  <th>Email</th>
                  <th>Telefoni</th>
                  <th>Edit</th>
				  <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
				<?php
				$users=findUsers();
				while($user=mysqli_fetch_array($users)){
				$user_id=$user['user_id'];
				echo "<tr>";
				
				echo "<td>".  $user['firstname'] . "</td>";
				echo "<td>".  $user['lastname'] . "</td>";
				echo "<td>".  $user['username'] . "</td>";
				echo "<td>".  $user['email'] . "</td>";
				echo "<td>".  $user['phone'] . "</td>";
				echo "<td><a href='users.php?source=edit_user&user_id=$user_id'>Edit</a></td>";
				echo "<td><a href='users.php?delete_user=$user_id'
					data-toggle='modal'
				data-target='#confirm-delete' class='confirm-delete'>Delete</a></td>";
				
				echo "</tr>";
				}
			  ?>
				<?php
					if(isset($_GET['delete_user'])){
						$delete_user_id = $_GET['delete_user'];
						delteUser($delete_user_id);
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
	   
	   
	   
	   