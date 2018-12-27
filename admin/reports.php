<?php include 'includes/header.php'; ?>	
  <!-- Navigation-->
  <?php include 'includes/navigation.php'; ?>
	<div class="content-wrapper">
		<div class="container-fluid">
        
<div class="card">
    <div class="card-header">
        <h5><i class="fa fa-bar-chart"></i>  Reports - Shitjet</h5>
    </div>
    <div class="card-body mx-5">
        <div class="input-group mb-3">
            <select class="custom-select" id="inputGroupSelect02" onchange="location = this.value;">
                <option selected>Choose...</option>
                <option value="reports.php?sale_reports=no_filter">Sale Reports</option>
            </select>
            <div class="input-group-append">
                <label class="input-group-text" for="inputGroupSelect02"><i class="fa fa-filter"></i> Filter</label>
            </div>
        </div>
    </div>
</div>

<div class="row py-5">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-bar-chart"></i> Sales Report
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nr Fatures</th>
                            <th>Klienti</th>
                            <th>Data e Fatures</th>
                            <th>Kostoja</th>
                            <th>Statusi</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nr Fatures</th>
                            <th>Klienti</th>
                            <th>Data e Fatures</th>
                            <th>Kostoja</th>
                            <th>Statusi</th>
                            <th>PDF</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    if(isset($_GET['sale_reports']) == 1 && isset($_GET['filter_date_start']) && isset($_GET['filter_date_end'])  && isset($_GET['client_id'])){
                        $status ='';
                        $client_id = '';
                        
                        $start_date =  escape_string($_GET['filter_date_start']);
                        $finish_date = escape_string($_GET['filter_date_end']);
                        if(isset($_GET['status'])){
                            $status = escape_string($_GET['status']);
                        }
                        if(isset($_GET['client_id'])){
                            $client_id = escape_string($_GET['client_id']);
                        }
                        $sales = filter_sales($start_date, $finish_date, $status,$client_id);
                        while($sale=mysqli_fetch_array($sales)){
                        $sale_id=$sale['sale_id'];
                        echo "<tr>";
                        
                        echo "<td>".  $sale['sale_id'] . "</td>";
                        echo "<td>".  $sale['client'] . "</td>";
                        echo "<td>".  $sale['sale_date'] . "</td>";
                        echo "<td>N/A</td>";
                        echo "<td>".  $sale['status'] . "</td>";				
                        echo "<td><a target='_blank' href='includes/print_invoice.php?pdf=1&sale_id=$sale_id'>PDF</a></td>";
                        
                        echo "</tr>";
                        }
                    }else if(isset($_GET['sale_reports']) == 'no_filter'){
                        $_SESSION['mesazhi'] = "INFO! - Filtrimi i te dhenave eshte bere nga fillimi i muajit deri ne diten e sotme.";
                        $start_date = date('Y-m-01');
                        $finish_date = date('Y-m-d');
                        $sales = filter_sales($start_date, $finish_date,$status='',$client_id='');
                        while($sale=mysqli_fetch_array($sales)){
                        $sale_id=$sale['sale_id'];
                        echo "<tr>";
                        
                        echo "<td>".  $sale['sale_id'] . "</td>";
                        echo "<td>".  $sale['client'] . "</td>";
                        echo "<td>".  $sale['sale_date'] . "</td>";
                        echo "<td>N/A</td>";
                        echo "<td>".  $sale['status'] . "</td>";				
                        echo "<td><a target='_blank' href='includes/print_invoice.php?pdf=1&sale_id=$sale_id'>PDF</a></td>";
                        
                        echo "</tr>";
                        }
                    }
                    ?>
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-filter"></i> Filter
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="control-label" for="input-date-start">Date Start</label>
                    <div class="input-group date" id="datetimepicker1">
                        <input type="text" name="filter_date_start"  value="<?php if(isset($_GET['filter_date_start'])){echo $_GET['filter_date_start'];}else {echo date('Y-m-01');} ?>" placeholder="Date Start" data-date-format="YYYY-MM-DD" id="input-date-start" class="form-control">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="input-date-end">Date End</label>
                    <div class="input-group date" id="datetimepicker2">
                        <input type="text" name="filter_date_end" value="<?php if(isset($_GET['filter_date_start'])){echo $_GET['filter_date_end'];}else {echo date('Y-m-d');} ?>"  placeholder="Date End" data-date-format="YYYY-MM-DD" id="input-date-end" class="form-control">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="input-date-end">Status</label>
                    <select name="status" class="custom-select">
                        <option value =""selected>Zgjedh statusin</option>
                        <option value="ne-proces"<?php if(!empty($_GET['status']) && $_GET['status'] == 'ne-proces')echo 'selected'; ?>>Ne proces</option>
                        <option value="e-paguar" <?php if(!empty($_GET['status']) && $_GET['status'] == 'e-paguar')echo 'selected'; ?>>E Paguar</option>
                        <option value="e-refuzuar"<?php if(!empty($_GET['status'])&& $_GET['status'] == 'e-refuzuar')echo 'selected'; ?>>E Refuzuar</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for="client">Klienti</label>
                    <?php
                        echo "<select name='client' class='form-control custom-select'  id='client'>";
                        $clients=findClients();
                        echo "<option value=''> Zgjedh klientin </option>";
                        while($client=mysqli_fetch_array($clients)){
                            echo "<option value='" . $client['client_id'] ."'";
                            if(!empty($_GET['client_id']) && $_GET['client_id'] == $client['client_id'] ) echo 'selected';
                            echo "> " . 
                            $client['client'] . "</option>";
                        }
                        echo "</select>";
                        echo "<div class='invalid-feedback'>
                                Ju lutem zgjidhni klientin.
                            </div>";
                    ?>
                </div>


                <div class="form-group text-right">
                    <button name="search" type="submit" id="button-filter" class="btn btn-default">
                        <i class="fa fa-filter"></i> Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
</script>

<script type="text/javascript">
    $('#button-filter').on('click', function() {
	var url = '';
	
	var filter_date_start = $('input[name=\'filter_date_start\']').val();
	
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_date_end\']').val();
	
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}
	
	var status = $('select[name=\'status\']').val();
	
	if (status) {
		url += '&status=' + encodeURIComponent(status);
	}	

    var client_id = $('select[name=\'client\']').val();
	
	if (client_id != 0) {
		url += '&client_id=' + encodeURIComponent(client_id);
	}

	location = 'reports.php?sale_reports=1' + url;
});
</script>
	
 <?php include "includes/footer.php";?>