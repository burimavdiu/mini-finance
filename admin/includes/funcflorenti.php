<?php
    function findCompany() {
        global $dbconn;
        $query_company="SELECT * FROM companies order by company_id desc limit 0, 1";
        return $result=mysqli_query($dbconn, $query_company);
    }
    function updateCompany($company_id, $company_name, $address_1, $address_2, $tel_no, $mobile_no, $fax_no, $business_no, $vat, $fiscal_no, $bank_acc_1, $bank_acc_2, $company_email, $company_web, $company_logo) {
        global $dbconn;
        $update_query = "UPDATE Companies SET company_name='$company_name', address_1='$address_1', address_2='$address_2', tel_no='$tel_no', mobile_no='$mobile_no', fax_no='$fax_no', business_no='$business_no', vat=$vat, fiscal_no='$fiscal_no', bank_acc_1='$bank_acc_1', bank_acc_2='$bank_acc_2', company_email='$company_email', company_web='$company_web' ";
        if (!empty($company_logo)) {
            $update_query .= ", company_logo='$company_logo' ";
        }
        $update_query .= "where company_id=$company_id";
        $result = mysqli_query($dbconn, $update_query);
        if(!$result){
            die("<span class='text-danger'>Gabim gjatë modifikimit të kompanisë" . mysqli_error($dbconn) . "</span>");
        } else {
            $_SESSION['mesazhi'] = "Kompania {$company_name} u modifikua me sukses";
            header("Location: configurations.php?source=company");
        }
    }
?>