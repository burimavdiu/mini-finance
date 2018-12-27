<?php
ob_start();
session_start();
require_once('../../includes/db.php');
require_once('functions.php');
require_once('funcflorenti.php');
require_once('kujtimfunctions.php');
require_once('../dompdf/autoload.inc.php');

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
}

use Dompdf\Dompdf;

if(isset($_GET['pdf']) && isset($_GET['sale_id'])){

    $sale_id = $_GET['sale_id'];

// instantiate and use the dompdf class
$dompdf = new Dompdf();

//Shitjet
$sale_result = findSaleById($sale_id);
$sale = mysqli_fetch_array($sale_result);

// Kompania

$result_c = findCompany();
$company = mysqli_fetch_array($result_c);

// Klienti

$result_client =findClientById($sale['client_id']);
$client = mysqli_fetch_array($result_client);


$html ='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fatura-'.$client["contact_person"].'.pdf'.'</title>
    <style>

        .container{
            width:98%;
            margin:0 auto;
            font-family: Arial, Helvetica, sans-serif;
        }
        .clear {
            clear:both;
        }
        

        #logo-container {
            
            width:25%;
            margin:0px auto;
            height:135px;
        }
    
        #logo {
            max-width:100%;
        }

        #main-info {
            width:80%;
            margin:0 auto;
            height:60px;
        }
        
        .main-info-content {
            width:34%;
            float:right;

        }

        .paragraph-info,.paragraph-info-2{
            padding:1px;
            margin:0px;
            font-weight:bold;
            font-size:16px;
            word-spacing:30px;
        }
        .paragraph-info-2{
            word-spacing:60px!important;
        }
        .all-info-container {
            height:140px;
            width:100%;
        }

        #first-table td {
            font-weight:bold;
        }
        #table-info table,#table-info table th, #table-info table td{
            
            font-size:11px;
            padding:-0.5px;
            margin:0px;
        }
        #table-info  th, td {
            
            text-align: left;
            
        }
        #table-info   th{
            width:27%;
        }

        .myTable{
            font-size:11px;
            border:1px solid black;
            margin-top:10px;
        }

        .myTable table tr:last-child td {
            border-bottom:0.8px solid gray;
            padding-bottom:4px;
        }
        table tr th span {
            display:block;
        }

        .total {
            height:30px;
        }
        .total p {
            float:right;
            font-weight:bold;
            margin-right:20%; 
        }
        #shuma {
            margin-left:88px;
        }
        
        #footer{
            height:170px;
        }
        .content {
            height:546px;
        }
        #footer-address {
            width:100%;
            margin:auto;
            height:85px;
            border:1px solid gray;

        }

        #footer-address p{
            font-family: Arial, Helvetica, sans-serif!important;
            text-align:center;
            font-size:11px;
            font-weight:bold;
            text-shadow: 1px 0 #000;
            padding:0;
            margin:0;         
        }
        #dorzoi-pranoi {
            height:60px;
            width:100%;
        }
        #dorzoi{
            height:20px;
            width:30%;
            border-bottom:1px solid gray;
            margin-left:2px; 
            float:left;  
        }
        #pranoi {
            height:20px;
            width:30%;
            border-bottom:1px solid gray;
            float:right;  
        }
        #dorzoi-pranoi #p1 {
            margin:3px 0 0 0;
            font-weight:bold;
            font-size:11px;
            text-align:center;
            width:30%;
            float:left;
            
            
        }
        #dorzoi-pranoi #p2 {
            font-weight:bold;
            font-size:11px;
            text-align:center;
            width:30%;
            float:right;
            
           
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="header">
            <div id="logo-container">
                <img id="logo" src="../'.LOGO_PATH.$company['company_logo'].'"/>
            </div>
            <div class="clear"></div>
            <div id="main-info">     
                <div class="main-info-content">
                    <p class="paragraph-info">Fature.Nr 18053151</p>
                    <p class="paragraph-info-2">Data '.str_replace('-','/',date('d-m-Y',strtotime($sale['sale_date']))).'</p>
                </div>
            </div>
        </div>
        <div class="content">
            <section id="table-info">
                <table id="first-table" style="width:48%;float:left;">
                    <tr>
                        <th>Emri i Shitësit:</th>
                        <td>'.$company['company_name'].'</td>
                    </tr>
                    <tr>
                        <th>Numri i TVSH:</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Numri i Biznesit:</th>
                        <td>'.$company['business_no'].'</td>
                    </tr>
                    <tr>
                        <th>Numri Fiskal:</th>
                        <td>'.$company['business_no'].'</td>
                    </tr>
                    <tr>
                        <th>Adresa:</th>
                        <td>'.$company['address_1'].' '.$company['address_2'].'</td>
                    </tr>
                    <tr>
                        <th>Telefoni:</th>
                        <td>'.$company['fax_no'].'</td>
                    </tr>
                    <tr>
                        <th>Mobil:</th>
                        <td>'.$company['mobile_no'].'</td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th><span>Pershkrimi</span><span>Description</span></th>
                        <td style="font-weight:normal;vertical-align: text-top;">'.$sale['description'].'</td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td></td>
                    </tr>
                </table>

                <table style="width:50%;float:left;">
                    <tr>
                        <th>Emri i Blersit</th>
                        <td>'.$client['contact_person'].'</td>
                    </tr>
                    <tr>
                        <th>Numri ID i TVSH</th>
                        <td>'.$client['vat_no'].'</td>
                    </tr>
                    <tr>
                        <th>Numri i Biznesit:</th>
                        <td>'.$client['business_register_no'].'</td>
                    </tr>
                    <tr>
                        <th>Numri Fiskal</th>
                        <td>'.$client['fiscal_no'].'</td>
                    </tr>
                    <tr>
                        <th>Numri Telefonit</th>
                        <td>'.$client['mobile_no'].'</td>
                    </tr>
                </table>
            </section>

        <div class="clear"></div>
        
        <div class="myTable">
            <table style="width:100%" cellspacing="0">
                <tr>
                    <th><span>Shërbimi</span><span>Service</span></th>
                    <th><span>Pershkrimi</span><span>Description</span></th> 
                    <th><span>Njesia</span><span>Unit</span></th>
                    <th><span>Sasia</span><span>Quantity</span></th>
                    <th><span>Çmimi Njësi pa TVSH</span><span>Unit Price w/o VAT</span></th>
                    <th><span>Vlera e TVSH</span><span>VAT Amount</span></th>
                    <th><span>Çmimi Total</span><span>Total Amount</span></th>    
                </tr>';

                    //Shitjet deetaje

                    $result_details = findSalesDetailsBySaleId($sale_id);
 
                    while($sale_details = mysqli_fetch_assoc($result_details)){

                        $result_service =findServiceById($sale_details['service_id']);
                        $service = mysqli_fetch_array($result_service);
                        //$acttot= $service['actual_price'] * $sale_details['quantity'];  <td>'.$acttot.'</td> 
                        $html.='<tr>
                        <td>'.$service['service_name'].'</td>
                        <td>'.$service['service_description'].'</td>
                        <td>'.$sale_details['unit'].'</td>
                        <td>'.$sale_details['quantity'].'</td> 
                        <td>€150.00</td>           
                        <td>0.0</td>
                        <td>€150.00</td></tr>';
                        
                    }
                  
              $html .='</table>
            <div class="total">
                 <p><span>Shuma Total</span><span id="shuma">€150.00</span></p>
            
            </div>
        </div>
    </div>

    <div id="footer">

        <div id="dorzoi-pranoi">

            <div id="dorzoi"></div>
            <div id="pranoi"></div>
            <div class="clear"></div>
            <span id="p1">Dorezoi:</span>
            <span id="p2">Pranoi:</span>
            
        </div>
        
        <div id="footer-address">

            <p>TICK sh.p.k, rr. Leke Dukagjini, Pristine, Kosova</p>
            <p>PROCREDIT BANK KOSOVË,</p>
            <p>SWIFT code: MBKOXKPRXXX</p>
            <p>NR. I LLOGARISË: 1110340521000160</p>
            <p>www.tick-ks.com</p>
            <p>Email: info@tick-ks.com</p>
        
        </div>
    </div>
</div>
       
</body>
</html>';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$file_name = 'Fatura e '.$client["contact_person"].'.pdf';
$dompdf->stream($file_name, array("Attachment"=>false));
}

?>