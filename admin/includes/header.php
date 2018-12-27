<?php include "../includes/db.php";?>
<?php include "functions.php";?>
<?php include "kujtimfunctions.php"; ?>
<?php include "funcflorenti.php";?>
<?php include "functions_egzona.php";?>
<?php ob_start();
	session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: ../index.php");
    }
	?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Finance Admin</title>
  <!-- Bootstrap core CSS  
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="vendor/bootstrap/css/bootstrapV6.min.css" rel="stylesheet">
  
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <script src="vendor/jquery/jquery.min.js"></script>
  
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">