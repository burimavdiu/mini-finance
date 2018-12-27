<?php 

    function escape_string($string){
        global $dbconn;
        return mysqli_real_escape_string($dbconn,trim($string));
    }

    function update_sale($sale){
        global $dbconn;
        $sale_id = $sale['sale_id'];
        $client_id=$sale['client_id'];
        $sale_date=$sale['sale_date'];
        $description=$sale['description'];			
        $sale_type=$sale['sale_type'];
        $status=$sale['status'];
        $payment_date=$sale['payment_date'];
        $payment_ref=$sale['payment_ref'];
        $user_id=$_SESSION['user']['user_id'];
        $s_d=date("Y-m-d");
        $query_update_sale="UPDATE sales SET sale_date='$sale_date',client_id=$client_id,description='$description',sale_type='$sale_type',dep_id=1,status='$status',
        payment_date='$payment_date',payment_ref='$payment_ref',user_id=$user_id,registration_date='$s_d' WHERE sale_id = $sale_id ";
        
        
        return $result_update_sale=mysqli_query($dbconn, $query_update_sale);					  
    }
    
    //     function update_sale_details($sale_id,$sale_details){

    //     global $dbconn;

    //         $query_update_sale_details="UPDATE sales_details SET service_id='$service', quantity='$quantity', unit='$unit' WHERE sale_id = '$sale_id' AND sales_details_id = '$sales_details_id' ";

    //         foreach($sale_details as $sd){	
    //         $sales_details_id = $sd['sales_details_id'];    	
    //         $service=$sd['service'];
    //         $quantity=$sd['quantity'];
    //         $unit=$sd['unit'];

    //         $query_update_sale_details="UPDATE sales_details SET service_id='$service', quantity='$quantity',     unit='$unit' WHERE sale_id = '$sale_id' AND sales_details_id = '$sales_details_id' ";

    //          $query_add_sale_details.="($sale_id,$service,$quantity,'$unit')";
    //             if($sd != end($sale_details)) {
    //         	$query_add_sale_details.=",";
    //             }   

    //         }
    //     //echo $query_update_sale_details;
    //     return $result_update_sale_details=mysqli_query($dbconn, $query_update_sale_details);	
    // } 
    function update_sale_details($sale_id,$sale_details){

        global $dbconn;

            foreach($sale_details as $sd){	
                
                $sales_details_id = $sd['sales_details_id'];	
                $service=$sd['service'];
                $quantity=$sd['quantity'];
                $unit=$sd['unit'];
                $price=$sd['price'];

                $query_update_sale_details="UPDATE sales_details SET ";
                
                $query_update_sale_details.="service_id='$service',quantity='$quantity', unit='$unit',price='$price'";

                if($sd != end($sale_details)) {
                        $query_update_sale_details.=",";       
                }   
                $query_update_sale_details.="WHERE sale_id = '$sale_id' AND sales_details_id = '$sales_details_id'";
                    
            }
        //echo $query_update_sale_details;
        return $result_update_sale_details=mysqli_query($dbconn, $query_update_sale_details);	
    } 
    

    function update_sale_and_details($sale, $sale_details){
        global $dbconn;
        
        mysqli_autocommit($dbconn, FALSE);
        $result_update_sale = update_sale($sale);
        
        if(!$result_update_sale){
            mysqli_rollback($dbconn);
            die("Error ". mysqli_error($dbconn));
        }
        else{

            $sale_id=$sale['sale_id'];
            $result_update_sale_details = update_sale_details($sale_id,$sale_details);
                     
            if(!$result_update_sale_details){ 
                //mysqli_rollback($dbconn);
                die("<span class='t-dangexter'>
                    Error " . mysqli_error($dbconn).
                "</span>");
                die("<span class='text-danger'> Error" . mysqli_error($dbconn). "</span>");
                mysqli_rollback($dbconn);
            }
            else{
                mysqli_commit($dbconn);
                $_SESSION['mesazhi'] = "Fatura {$sale_id} u ndryshua me sukses";
                header("Location: sales.php");
            }
        }
    }
    function findClientById($client_id){
        global $dbconn;
        $query_clients="SELECT * FROM clients WHERE client_id = $client_id";
        return $result_all_clients=mysqli_query($dbconn,$query_clients);
    }

    function delteBuy($buy_id){
        global $dbconn;
        $query_delete_buy="DELETE FROM sales WHERE sale_id=$buy_id";
        $result_delete_buy=mysqli_query($dbconn, $query_delete_buy);
        if(!$result_delete_buy){
            $_SESSION['mesazhi'] = "Blerja {$buy_id} nuk mund te fshihet";
            header("Location: buys.php");
        }
        else{
            $_SESSION['mesazhi'] = "Blerja {$buy_id} u fshi me sukses";
            header("Location: buys.php");
        }	
    }

    function filter_sales($start_date, $finish_date,$status,$client_id){
        global $dbconn;
        
        $query_sales="SELECT s.sale_id,s.sale_date,c.client,
            s.description ,s.payment_date,s.status 
            FROM sales s INNER JOIN clients c ON s.client_id=c.client_id 
            where s.activity='Shitje' 
            AND  (s.sale_date BETWEEN '$start_date'AND '$finish_date')";
        if(!empty($status)){
            $query_sales .= " AND status = '$status'";
        }
        if(!empty($client_id)){
            $query_sales .= " AND c.client_id = '$client_id'";
        }
        
        return $sales=mysqli_query($dbconn,$query_sales);
    }

?>