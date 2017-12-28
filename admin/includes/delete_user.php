<?php

  require_once '../../includes/db.php';
  //global $dbconn;
  $user_id = $_POST['user_id'];
  $query = "DELETE FROM users WHERE user_id=$user_id";
  $result_delet_user=mysqli_query($dbconn, $query);
  if ($result_delet_user) {
   echo "Product Deleted Successfully ...";
  }
  else{
	  echo "gabim" .mysqli_error($dbconn);
  }
  
 ?>