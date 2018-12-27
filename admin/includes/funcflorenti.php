<?php
    // Definimi i konstantes LOGO_PATH e cila si vlere permban shtegun e logos
    define("LOGO_PATH", "images/");

    // definimi i funksionit i cili gjen te gjitha kompanite
    function findCompany() {
        global $dbconn;
        $query_company="SELECT * FROM companies order by company_id desc limit 0, 1";
        $result=mysqli_query($dbconn, $query_company);
        if (!$result) {
            $_SESSION["mesazhi"] = "Gabim gjatë leximit të kompanisë: " . mysqli_error($dbconn);
            return false;
        } else {
            return $result;
        }
    }

    // Definimi i funksionit i cili modifikon kompanine
    function updateCompany($company_id, $company_name, $address_1, $address_2, $tel_no, $mobile_no, $fax_no, $business_no, $vat, $fiscal_no, $bank_acc_1, $bank_acc_2, $company_email, $company_web) {
        global $dbconn;
            // 18.04.2018 Kujtim perodrimi i funksionit te ri.
            $company_id = escape_string($company_id);
            $company_name = escape_string($company_name);
            $address_1 = escape_string($address_1);
            $address_2 = escape_string($address_2);
            $tel_no = escape_string($tel_no);
            $mobile_no = escape_string($mobile_no);
            $fax_no =escape_string($fax_no);
            $business_no = escape_string($business_no);
            $vat = escape_string($vat);
            $fiscal_no = escape_string($fiscal_no);
            $bank_acc_1 = escape_string($bank_acc_1);
            $bank_acc_2 = escape_string($bank_acc_2);
            $company_email = escape_string($company_email);
            $company_web = escape_string($company_web);
        $update_query = "UPDATE Companies SET company_name='$company_name', address_1='$address_1', address_2='$address_2', tel_no='$tel_no', mobile_no='$mobile_no', fax_no='$fax_no', business_no='$business_no'";
        if (!empty($vat)) {
            $update_query .= ", vat=$vat";
        } else {
            $update_query .= ", vat=0";
        }
        $update_query .= ", fiscal_no='$fiscal_no', bank_acc_1='$bank_acc_1', bank_acc_2='$bank_acc_2', company_email='$company_email', company_web='$company_web' ";
        $logo_name = $_FILES["logo_upload"]["name"];
        if ($_FILES["logo_upload"]["error"] == 0) {
            if (!empty($logo_name) && move_uploaded_file($_FILES["logo_upload"]["tmp_name"], LOGO_PATH.$logo_name)) {
                $update_query .= ", company_logo='$logo_name' ";
            }
            @unlink($_FILES["logo_upload"]["tmp_name"]);
        }
        $update_query .= "WHERE company_id=$company_id";
        $result = mysqli_query($dbconn, $update_query);
        if(!$result) {
            die("<span class='text-danger'>Gabim gjatë modifikimit të kompanisë: " . mysqli_error($dbconn) . "</span>");
        } else {
            $_SESSION['mesazhi'] = "Kompania {$company_name} u modifikua me sukses";
            header("Location: configurations.php?source=company");
        }
    }

    // Definimi i funksionit i cili gjen te gjitha blerjet
    function findBuys() {
        global $dbconn;
        $query_buys="SELECT s.sale_id,s.sale_date,c.client, s.description, s.payment_date, s.status, s.total_price FROM sales s INNER JOIN clients c ON s.client_id=c.client_id where s.activity='Blerje'";
        return $result_buys=mysqli_query($dbconn,$query_buys);
    }

    //Definimi i funksionit i cili shton blerjen
    function addBuy($buy) {
        global $dbconn;
        $client_id=$buy['client_id'];
        $buy_date=$buy['buy_date'];
        $description=$buy['description'];			
        $buy_type=$buy['sale_type'];
        $payment_date=$buy['payment_date'];
        $payment_ref=$buy['payment_ref'];
        $status = $buy['status'];  //ndryshim
        $user_id=$_SESSION['user']['user_id'];
        $b_d=date("Y-m-d");
        $total_price = $buy['total_price'];
        $query_add_buy="INSERT INTO sales(sale_date,client_id,description,sale_type,dep_id,status, payment_date,payment_ref,user_id,registration_date, activity, total_price) VALUES ('$buy_date', $client_id, '$description','$buy_type', 1, 1, '$payment_date', '$payment_ref', $user_id, '$b_d', 'Blerje','$total_price')";
        
        $result_add_buy=mysqli_query($dbconn, $query_add_buy);
        if (!result_add_buy) {
            die("<span class='text-danger'>Gabim gjate shtimit te blerjes: " . mysqli_error($dbconn) . "</span>");
        } else {
            $buy_id=mysqli_insert_id($dbconn);
            $_SESSION["mesazhi"] = "Fatura {$buy_id} u shtua me sukses";
            header("Location: buys.php");
        }
    }

    // Definimi i funkstionit i cili gjen blerjen e caktuar sipas Id-se se dhene
    function findBuyById($buy_id) {
        global $dbconn;
        $query_buy="SELECT c.client, b.client_id, b.description, b.sale_date, b.payment_date, b.payment_ref, b.sale_type, b.total_price FROM sales b INNER JOIN clients c ON b.client_id=c.client_id WHERE b.sale_id=$buy_id";
	   return $result_buy=mysqli_query($dbconn, $query_buy);
    }

    // Definimi i funksionit i cili ben editimin e blerjes
    function editBuy($buy) {
        global $dbconn;
        
        $query_edit="UPDATE sales SET client_id=$buy[client_id], description='$buy[description]', sale_date='$buy[buy_date]', payment_date='$buy[payment_date]', payment_ref=$buy[payment_ref], sale_type='$buy[buy_type]', total_price='$buy[total_price]' WHERE sale_id=$buy[buy_id]";
        return $result_edit=mysqli_query($dbconn, $query_edit);
    }
?>