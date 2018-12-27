<?php include 'includes/header.php'; ?>	
  <!-- Navigation-->
  <?php include 'includes/navigation.php'; ?>
	<div class="content-wrapper">
		<div class="container-fluid">
		  <!-- Breadcrumbs-->
		 <!-- <ol class="breadcrumb">
			<li class="breadcrumb-item">
			  <a href="./users.php">Users</a>
			</li>
			<li class="breadcrumb-item active">My Dashboard</li>
		  </ol>
		  -->
		  <!-- Icon Cards-->
		  <?php
			if(isset($_GET['source'])){
				$source=$_GET['source'];
			}
			else{
				$source="";
			}
			switch($source){
				case "add_sale";
				include "includes/add_sale.php";
				break;
				
				case "edit_sale";
				include "includes/edit_sale.php";
				break;
				
				default:
				include "includes/view_all_sales.php";
				break;
			 }
			?>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>	
		</div>
		 <!-- /.container-fluid-->
	</div>
    <!-- /.content-wrapper-->
	
 <?php include "includes/footer.php";?>
 	