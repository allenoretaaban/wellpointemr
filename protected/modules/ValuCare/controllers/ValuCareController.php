<?php

class ValuCareController extends Controller
{
    public function actionViewBill()
    {
        $this->render('viewbill');
    }
    
    public function actionViewform()
    {
        $this->render('viewform');
    }
    
    public function actionViewFormItem()
    {
      $this->render('viewformitem');
    }  
    
    public function actionPrintWpPayableExcel(){
        $this->printWpPayable($_GET["id"],true);        
    }
    
    public function actionPrintWpPayable()
    {           
        $this->printWpPayable($_GET["id"]);        
    }  
    
    public function actionPrintWpPayableCategoriesExcel(){
        $this->printWpPayableCategories($_GET["id"],true);        
    }
    
    public function actionPrintWpPayableCategories()
    {           
        $this->printWpPayableCategories($_GET["id"]);        
    }  
    
    public function actionPrintDoctorPayableExcel(){
        $this->printDoctorPayable($_GET["id"], true);                      
    }
    
    public function actionPrintDoctorPayable()
    {
           $this->printDoctorPayable($_GET["id"]);                  
    }
    
    public function actionPrintApeExcel()
    {
         $this->printApe($_GET["id"], true);
    }
    
    public function actionPrintApe()
    {
         $this->printApe($_GET["id"]);
    }                              
    
    public function actionPrintSoaSummary()
    {
           $this->printSoaSummary($_GET["id"]);      
    }
    
    private function printSoaSummary($hmo_bill_id)
    {
           $connection=Yii::app()->db;    
           $print = implode("", file(Yii::app()->getBasePath().'/modules/ValuCare/html/printSummary.html')); 
           
           $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);  
              
            $billing_id =  $hmo_bill_id;
            $billing = HmoBilling::model()->findByPk((int)$billing_id ); 
            
            //get Hmo Form Ids
            $hmo_form_ids = null;
            $query = "select id from hmo_form where hmo_billing_id = $hmo_bill_id";
            $command=$connection->createCommand($query);
            $reader_hmo_form = $command->query();
            foreach($reader_hmo_form as $tmprow) { 
                if($tmprow["id"] != "" && $tmprow["id"] != null){
                    $hmo_form_ids[] = $tmprow["id"];                    
                }
            }
            $hmo_form_ids = implode(",", $hmo_form_ids);
            
            //claim doctor ids
            $claim_doctor_ids = null;
            $query = "select 
                        distinct a.claim_doctor_id

                         from hmo_form_items a
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where a.hmo_form_id in 
                        (
                            $hmo_form_ids
                        )
                        and a.payto = 'DOCTOR'
                        and a.service_type != 'APE'
                        order by b.avail_date asc";
            
            $command=$connection->createCommand($query);
            $reader_claim_doctor = $command->query();
            foreach($reader_claim_doctor as $tmprow) { 
                if($tmprow["claim_doctor_id"] != "" && $tmprow["claim_doctor_id"] != null){
                    $claim_doctor_ids[] = $tmprow["claim_doctor_id"];                    
                }
            }
            
            
            if (count($claim_doctor_ids) > 0){
                    $claim_doctor_ids = implode(",", $claim_doctor_ids);
                    
                    $query = "select x.id,x.firstname,x.lastname
                            from doctor x
                            where x.id in
                            (
                                  $claim_doctor_ids
                            )
                            order by x.lastname asc";               
                    
                    $command=$connection->createCommand($query);
                    $doc_dataReader=$command->query();
                    foreach($doc_dataReader as $row2) { 
                        $doctor_name = strtoupper($row2["lastname"].", ".$row2["firstname"]);
                        //get doctor total
                        $query = "select sum(a.charge_fee) as sumcharge
                                from hmo_form_items a
                                left join hmo_form b
                                on a.hmo_form_id = b.id
                                where a.hmo_form_id in 
                                (
                                select id from hmo_form where
                                hmo_billing_id = $hmo_bill_id
                                )
                                and a.payto = 'DOCTOR'
                                and a.service_type != 'APE'
                                and a.claim_doctor_id = ".$row2["id"]."
                                order by b.avail_date asc";
                        $command=$connection->createCommand($query);
                        $doctrnx_dataReader=$command->query();
                        foreach($doctrnx_dataReader as $row1) {                         
                                $sumcharge = number_format($row1["sumcharge"],2);      
                        }                                             
                        
                        
                        $doctors .= "<tr>
                                            <td style='text-align: left;'>$doctor_name</td>
                                            <td class='money'>$sumcharge</td>
                                    </tr>";
                    }
            
            }
            
            $print = str_replace("[doctors]",$doctors,$print);  
            
            $run_total =0;
            
            //compute doctor total            
            $query = "select sum(b.charge_fee) as billtotal 
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id 
                        and b.payto = 'DOCTOR' 
                        and b.service_type != 'APE' ";                                    
            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                 $run_total += floatval($row["billtotal"]); 
                $doctor_total = number_format($row["billtotal"],2);
            }
           
            $print = str_replace("[doctor_total]",$doctor_total,$print);  
            
            //compute wellpoint services total   (not ape)
            $query = "select sum(b.charge_fee) as billtotal 
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id
                        and b.payto = 'WPCLINIC' 
                        and b.service_type != 'APE'  ";       
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $run_total += floatval($row["billtotal"]);   
                $wp_billtotal = number_format($row["billtotal"],2);
            }
            
            $print = str_replace("[wp_cons_dx]",$wp_billtotal,$print);   
            
             //compute wellpoint APE total
            $query = "select sum(b.charge_fee) as billtotal 
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id
                        and b.payto = 'WPCLINIC' 
                        and b.service_type = 'APE'  ";       
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $run_total += floatval($row["billtotal"]);   
                $ape_billtotal = number_format($row["billtotal"],2);
            }
            
            $print = str_replace("[wp_ape]",$ape_billtotal,$print);   
            $print = str_replace("[soa_no]","WPB-".$billing_id,$print);
            $print = str_replace("[gt]",number_format($run_total,2),$print);    
             
            $sum_date = date("M d, Y", strtotime($billing->date_prepared));   
            $print = str_replace("[sum_date]",$sum_date,$print);
            echo $print;       
        
    }
    
    private function printApe($hmo_bill_id, $excel = false)
    {
            $connection=Yii::app()->db;   
            $print = implode("", file(Yii::app()->getBasePath().'/modules/ValuCare/html/printApe.html'));            
             
            $billing_id =  $hmo_bill_id;
            $billing = HmoBilling::model()->findByPk((int)$billing_id );             
                         
            $print = str_replace("[date_prepared]",date("Y-M-d",strtotime($billing->date_prepared) ), $print);                        
            $print = str_replace("[due_date]",date("Y-M-d",strtotime($billing->date_due) ),$print);                                    
            
            /*$profile = Profile::model()->findByAttributes(array("user_id"=>$billing->by_userid));
            $prepared_by = $profile->first_name.' '.$profile->last_name;                     */
             $profile=Yii::app()->getModule('user')->user()->profile;                
            $prepared_by = $profile->first_name.' '.$profile->last_name; 
            $print = str_replace("[preparedy_by]",$prepared_by,$print);
             
            //get the bill items
            $bill_items = "";                                     
             $query = "select a.itemid,
                        b.avail_date,
                        b.patient_name,
                        a.payto,                       
                        a.diagnosis,
                        a.med_service,
                        a.service_type,                        
                        a.charge_type,
                        a.charge_fee    
                        from hmo_form_items a
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where a.hmo_form_id in 
                        (
                        select id from hmo_form where
                        hmo_billing_id = $hmo_bill_id
                        )
                        and a.payto = 'WPCLINIC'
                        and a.service_type = 'APE'
                        order by b.avail_date asc";
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
            foreach($dataReader as $row) { 
                $holder = "<tr>";
                    $holder .= "<td>".$row["avail_date"]."</td>";
                    $holder .= "<td>".$row["patient_name"]."</td>";                    
                    $holder .= "<td>".$row["diagnosis"]."</td>";
                    $holder .= "<td>".$row["med_service"]."</td>"; 
                    
                    if ($row["charge_type"] == "CCHARGE" ){                        
                        
                        $holder .= "<td class='money'>".number_format($row["charge_fee"], 2)."</td>";
                        $holder .= "<td class='money'>&nbsp;</td>";
                        
                        
                    } else if ($row["charge_type"] == "PROCEDURE" ){                        
                        $holder .= "<td class='money'>&nbsp;</td>";
                        $holder .= "<td class='money'>".number_format($row["charge_fee"], 2)."</td>";
                        
                        
                    } 
                    
                $holder .= "</tr>";
                $bill_items.= $holder;
                
            }            
             $print = str_replace("[bill_items]",$bill_items, $print);        
             
             
             //compute clinic charge total
            $query = "select sum(b.charge_fee) as clinic_charge_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id 
                        and b.charge_type = 'CCHARGE' 
                        and b.payto = 'WPCLINIC' 
                        and b.service_type = 'APE' ";                                                                              
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $clinic_charge_sum = number_format($row["clinic_charge_sum"],2);
            }
            $print = str_replace("[cc]",$clinic_charge_sum,$print);    
            
            //compute doctors procedure total
            $query = "select sum(b.charge_fee) as doc_proc_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id 
                        and b.charge_type = 'PROCEDURE'
                        and b.payto = 'WPCLINIC'
                        and b.service_type = 'APE'  ";                                                                              
                                                                     
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $doc_proc_sum = number_format($row["doc_proc_sum"],2);
            }
            $print = str_replace("[dp]",$doc_proc_sum,$print);    
            
            //compute prof fee total
            $query = "select sum(b.charge_fee) as prof_fee_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id 
                        and b.charge_type = 'PROF_FEE'
                        and b.payto = 'WPCLINIC' 
                        and b.service_type = 'APE' ";     
                                                         
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $prof_fee_sum = number_format($row["prof_fee_sum"],2);
            }
            $print = str_replace("[pf]",$prof_fee_sum,$print);
                             
             //compute total  
            $query = "select sum(b.charge_fee) as billtotal 
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id
                        and b.payto = 'WPCLINIC' 
                        and b.service_type = 'APE'  ";                                    
            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $billtotal = number_format($row["billtotal"],2);
            }
            $print = str_replace("[gt]",$billtotal,$print);   
            $print = str_replace("[soa_no]","WPB-".$billing_id,$print);
                                               
            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            
            if ($excel == true){
                $filename = "ValuCare_PayToApe_$hmo_bill_id";
                    header("Content-Disposition: attachment; filename=\"$filename\""); 
                    header("Content-Type: application/vnd.ms-excel");
                    echo $print;
                
            }else{
                echo "<button class='noprint' onclick=\"window.location = '../../printApeExcel/id/$hmo_bill_id'\" value='' >Export to Excel</button>";
                echo $print;          
            }
        
    }
    
    private function printDoctorPayable($hmo_bill_id, $excel = false)
    {
         $connection=Yii::app()->db;   
            $print = implode("", file(Yii::app()->getBasePath().'/modules/ValuCare/html/printDoctorPayable.html'));            
             
            $billing_id =  $hmo_bill_id;
            $billing = HmoBilling::model()->findByPk((int)$billing_id );             
            
            $print = str_replace("[soa_no]","WPB-".$billing_id,$print);             
            $print = str_replace("[date_prepared]",date("Y-M-d",strtotime($billing->date_prepared) ), $print);                        
            $print = str_replace("[due_date]",date("Y-M-d",strtotime($billing->date_due) ),$print);                                    
            
            /*$profile = Profile::model()->findByAttributes(array("user_id"=>$billing->by_userid));
            $prepared_by = $profile->first_name.' '.$profile->last_name;                     
            $print = str_replace("[preparedy_by]",$prepared_by,$print);*/
            $profile=Yii::app()->getModule('user')->user()->profile;                
            $prepared_by = $profile->first_name.' '.$profile->last_name; 
            $print = str_replace("[preparedy_by]",$prepared_by,$print);
            
            //get Hmo Form Ids
            $hmo_form_ids = null;
            $query = "select id from hmo_form where hmo_billing_id = $hmo_bill_id";
            $command=$connection->createCommand($query);
            $reader_hmo_form = $command->query();
            foreach($reader_hmo_form as $tmprow) {
                if($tmprow["id"] != "" && $tmprow["id"] != null){
                    $hmo_form_ids[] = $tmprow["id"];                    
                } 
            }
            $hmo_form_ids = implode(",", $hmo_form_ids);
            
            // check for claim doctor id error
            $claim_doctor_ids = null;
            $query = "SELECT a.claim_doctor_id, a.itemid, a.hmo_form_id
                    FROM hmo_form_items a
                    LEFT JOIN hmo_form b
                    ON a.hmo_form_id = b.id
                    WHERE a.hmo_form_id IN  ( $hmo_form_ids )
                    AND a.payto = 'DOCTOR'
                    AND a.service_type != 'APE'
                    ORDER BY b.avail_date ASC";
            $command=$connection->createCommand($query);
            $reader_claim_doctor = $command->query();
            $cdi_err_arr = array();
            foreach($reader_claim_doctor as $tmprow) { 
                if($tmprow["claim_doctor_id"] == "0"){
                    $cdi_err_arr[] = $tmprow["itemid"]; 
                }
            }
            if(count($cdi_err_arr) > 0) {
                echo "<hr><h3 style='color:red;'>Please update the following hmo form items for doctor's reference record of the following links:</h3><p>";
                foreach($cdi_err_arr as $cev){
                    echo "Form Item: http://".$_SERVER['HTTP_HOST']."/hmoFormItems/update/".$cev."<br>";
                }
                echo "</p><hr><br>";
            }

            $claim_doctor_ids = null;
            $query = "SELECT DISTINCT a.claim_doctor_id  
                    FROM hmo_form_items a
                    LEFT JOIN hmo_form b
                    ON a.hmo_form_id = b.id
                    WHERE a.hmo_form_id IN 
                    (
                    $hmo_form_ids
                    )
                    AND a.payto = 'DOCTOR'
                    AND a.service_type != 'APE'
                    ORDER BY b.avail_date ASC";
            $command=$connection->createCommand($query);
            $reader_claim_doctor = $command->query();
            foreach($reader_claim_doctor as $tmprow) { 
                if($tmprow["claim_doctor_id"] != "" && $tmprow["claim_doctor_id"] != null){                
                    $claim_doctor_ids[] = $tmprow["claim_doctor_id"];        
                }
            }

            //get the bill items
            $bill_items = "";       
            if (count($claim_doctor_ids) > 0){            
                $claim_doctor_ids = implode(",", $claim_doctor_ids);
                    //get the doctors first
                    $query = "select x.id,x.firstname,x.lastname
                            from doctor x
                            where x.id in
                            (
                            $claim_doctor_ids
                            )
                            ORDER BY x.lastname ASC";               
                    $doctors = array();
                    $command=$connection->createCommand($query);
                    $doc_dataReader=$command->query();
                    foreach($doc_dataReader as $row2) { 
                        $doctor_name = $row2["lastname"].", ".$row2["firstname"];
                        
                        //count doc trnx rows count
                        $query = "select count(a.itemid) as rowscount,
                                sum(a.charge_fee) as sumcharge
                                from hmo_form_items a
                                left join hmo_form b
                                on a.hmo_form_id = b.id
                                where a.hmo_form_id in 
                                (
                                $hmo_form_ids
                                )
                                and a.payto = 'DOCTOR'
                                and a.service_type != 'APE'
                                and a.claim_doctor_id = ".$row2["id"]."
                                order by b.avail_date asc";
                        $command=$connection->createCommand($query);
                        $doctrnx_dataReader=$command->query();
                        foreach($doctrnx_dataReader as $row1) { 
                                $rowscount = $row1["rowscount"];
                                $sumcharge = $row1["sumcharge"];      
                        }                                             
                        //get trnx
                         $query = "select a.itemid,
                                        b.avail_date,
                                        b.patient_name,
                                        a.payto,
                                        a.claim_doctor_name,
                                        a.diagnosis,
                                        a.med_service,
                                        a.charge_type,
                                        a.charge_fee
                                    from hmo_form_items a
                                    left join hmo_form b
                                    on a.hmo_form_id = b.id
                                    where a.hmo_form_id in 
                                    (
                                        $hmo_form_ids
                                    )
                                    and a.payto = 'DOCTOR'
                                    and a.service_type != 'APE'
                                    and a.claim_doctor_id = ".$row2["id"]."
                                    order by b.avail_date asc";
                        $command=$connection->createCommand($query);
                        $doctrnxs_dataReader=$command->query();
                        $rowspan_flag = false;
                        $row_counter = 1;
                        //var_dump($doctrnxs_dataReader); exit();
                        foreach($doctrnxs_dataReader as $row) {                         
                                
                                $holder = "<tr>";
                                /*if ($rowspan_flag == false){
                                   $holder .= "<td rowspan=$rowscount valign=top >".strtoupper($doctor_name)."</td>";                       
                                   //$rowspan_flag = true;
                                } */
                                $holder .= "<td valign=top >".strtoupper($doctor_name)."</td>";                       
                                $holder .= "<td>".$row["avail_date"]."</td>";
                                $holder .= "<td>".$row["patient_name"]."</td>";                    
                                $holder .= "<td>".$row["diagnosis"]."</td>";
                                $holder .= "<td>".$row["med_service"]."</td>"; 
                                
                                
                                
                               if ($row["charge_type"] == "PROCEDURE" ){                                                    
                                    $holder .= "<td class='money'>".number_format($row["charge_fee"], 2)."</td>";
                                    $holder .= "<td class='money'>&nbsp;</td>";
                                    
                                } else if ($row["charge_type"] == "PROF_FEE" ){                                   
                                    $holder .= "<td class='money'>&nbsp;</td>";
                                    $holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";                        
                                }
                                
                                if ($rowspan_flag == false){
                                   $holder .= "<td rowspan=$rowscount valign=top class='money' >".number_format($sumcharge,2)."</td>";                       
                                   $rowspan_flag = true;
                                }
                                
                                
                                $holder .= "</tr>";
                                $bill_items.= $holder;
                                
                        }                                             
                        

                        
                    }            
            
            }   
                
            $print = str_replace("[bill_items]",$bill_items, $print);        
            
            //compute doctors procedure total
            $query = "select sum(b.charge_fee) as doc_proc_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id 
                        and b.charge_type = 'PROCEDURE'
                        and b.payto = 'DOCTOR'  
                        and b.service_type != 'APE' ";                                                                              
                                                                     
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $doc_proc_sum = number_format($row["doc_proc_sum"],2);
            }
            $print = str_replace("[dp]",$doc_proc_sum,$print);    
            
            //compute prof fee total
            $query = "select sum(b.charge_fee) as prof_fee_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id 
                        and b.charge_type = 'PROF_FEE'
                        and b.payto = 'DOCTOR'  
                        and b.service_type != 'APE' ";     
                                                         
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $prof_fee_sum = number_format($row["prof_fee_sum"],2);
            }
            $print = str_replace("[pf]",$prof_fee_sum,$print);
            
                                        
           
            //compute total  
            $query = "select sum(b.charge_fee) as billtotal 
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $hmo_bill_id 
                        and b.payto = 'DOCTOR' 
                        and b.service_type != 'APE' ";                                    
            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $billtotal = number_format($row["billtotal"],2);
            }
            $print = str_replace("[gt]",$billtotal,$print); 

            ////////////////////////// with category summary //////////////////////////

            $command=$connection->createCommand("select * from hmo_form_items_category where hmo_billing_id = $billing_id");
            $dataReader=$command->query();

            $aes = $ape = $lab = $raa = $rmap = $others = $med = $meddx = $medcx = 0;
            $aesc = $apec = $labc = $raac = $rmapc = $othersc = $medc = $meddxc = $medcxc = 0;

            $daes = $dape = $dlab = $draa = $drmap = $dothers = $dmed = $dmeddx = $dmedcx = 0;
            $daesc = $dapec = $dlabc = $draac = $drmapc = $dothersc = $dmedc = $dmeddxc = $dmedcxc = 0;

            foreach($dataReader as $row) { 
                if($row['category'] != "Annual Physical Exam") {
                        $adder = $this->countCategories($row['med_service']);
                }else{
                    if(substr($row['med_service'], 0, 5) == "Basic"){
                        $adder = 1;
                    }else{
                        $adder = $this->countCategories($row['med_service']);
                    }
                }
                if($row['payto'] == 'DOCTOR'){
                    switch($row['category']){
                        case 'Aesthetics': $daes = $daes + $adder; $daesc = $daesc + $row['amount']; break;
                        case 'Annual Physical Exam': $dape = $dape + $adder; $dapec = $dapec + $row['amount']; break;
                        case 'Laboratory': $dlab = $dlab + $adder; $dlabc = $dlabc + $row['amount']; break;
                        case 'Consultation': $dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                        case 'Medical':
                        case 'Medical Clinic': $dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                        case 'Clinic Procedure':$dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                        //case 'Clinic Procedure':$dmedcx++; $dmedcxc = $dmedcxc + $row['amount'];break;
                        case 'Doctors Procedure':
                        case 'Doctors and Procedures': $dmeddx = $dmeddx + $adder; $dmeddxc = $dmeddxc + $row['amount']; break;
                        case 'Radiology and Ancillary': $draa = $draa + $adder; $draac = $draac + $row['amount']; break;
                        case 'Rehabilitation Medicine And Physical Therapy': $draa = $draa + $adder; $drmapc = $drmapc + $row['amount']; break;
                        default: $dothers = $dothers + $adder; $dothersc = $dothersc + $row['amount']; break;
                    }
                }else{
                    /*switch($row['category']){
                        case 'Aesthetics': $aes = $aes + $adder; $aesc = $aesc + $row['amount']; break;
                        case 'Annual Physical Exam': $ape = $ape + $adder; $apec = $apec + $row['amount']; break;
                        case 'Laboratory': $lab = $lab + $adder; $labc = $labc + $row['amount']; break;
                        case 'Consultation': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                        case 'Medical':
                        case 'Medical Clinic': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                        case 'Clinic Procedure': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                        //case 'Clinic Procedure':$medcx++; $medcxc = $medcxc + $row['amount'];break;
                        case 'Doctors Procedure':
                        case 'Doctors and Procedures': $meddx = $meddx + $adder; $meddxc = $meddxc + $row['amount']; break;
                        case 'Radiology and Ancillary': $raa = $raa + $adder; $raac = $raac + $row['amount']; break;
                        case 'Rehabilitation Medicine And Physical Therapy': $rmap = $rmap + $adder; $rmapc = $rmapc + $row['amount']; break;
                        default: $others = $others + $adder; $othersc = $othersc + $row['amount']; break;
                    }*/                
                }

            }

            // get total count and amount of uncategorized items 
            $command = $connection->createCommand("select id from hmo_form where hmo_billing_id = $billing_id");
            $dataReaderCatHF = $command->query();
            $additionalOthersAmount = 0;
            $additionalOthersCount = 0;
            foreach($dataReaderCatHF as $rowHF) { 
                $idHF = $rowHF['id'];
                $command = $connection->createCommand("select itemid,charge_fee from hmo_form_items where hmo_form_id = $idHF and is_categorized = 0");
                $dataReaderCatHFI = $command->query();
                if($dataReaderCatHFI){
                    foreach ($dataReaderCatHFI as $rowHFI) {
                        $additionalOthersAmount = $additionalOthersAmount+$rowHFI['charge_fee'];
                        $additionalOthersCount++;
                    }
                }
            }
            $others = $others + $additionalOthersCount;
            $othersc = $othersc + $additionalOthersAmount;

            // compute values in category
            $catTotal = $aes+$ape+$lab+$raa+$rmap+$med+$meddx+$medcx+$others;
            $catTotalc = $aesc+$apec+$labc+$raac+$rmapc+$medc+$meddxc+$medcxc+$othersc; 
            $dcatTotal = $daes+$dape+$dlab+$draa+$drmap+$dmed+$dmeddx+$dmedcx+$dothers;
            $dcatTotalc = $daesc+$dapec+$dlabc+$draac+$drmapc+$dmedc+$dmeddxc+$dmedcxc+$dothersc; 

            //$catTotal = $catTotal + $dcatTotal;
            $catTotalc = $catTotalc + $dcatTotalc;
            $catTotalc = number_format($catTotalc,2);

            $aesc = $aesc + $daesc; $aesc = number_format($aesc,2);
            $apec = $apec + $dapec; $apec = number_format($apec,2);
            $labc = $labc + $dlabc; $labc = number_format($labc,2);
            $medc = $medc + $dmedc; $medc = number_format($medc,2);
            $meddxc = $meddxc + $dmeddxc; $meddxc = number_format($meddxc,2);
            $medcxc = $medcxc + $dmedcxc; $medcxc = number_format($medcxc,2);
            $raac = $raac + $draac; $raac = number_format($raac,2);
            $rmapc = $rmapc + $drmapc; $rmapc = number_format($rmapc,2);
            $othersc = $othersc + $dothersc; $othersc = number_format($othersc,2);

            $category_content = "<tr><td>Aesthetics</td><td align='right'>$aes</td><td align='right'>$daes</td><td align='right'>$aesc</td></tr>";
            $category_content .= "<tr><td>Annual Physical Exam</td><td align='right'>$ape</td><td align='right'>$dape</td><td align='right'>$apec</td></tr>";
            $category_content .= "<tr><td>Doctors and Procedures</td><td align='right'>$meddx</td><td align='right'>$dmeddx</td><td align='right'>$meddxc</td></tr>";
            $category_content .= "<tr><td>Laboratory</td><td align='right'>$lab</td><td align='right'>$dlab</td><td align='right'>$labc</td></tr>";
            $category_content .= "<tr><td>Medical Clinic</td><td align='right'>$med</td><td align='right'>$dmed</td><td align='right'>$medc</td></tr>";
            //$category_content .= "<tr><td>Medical </td><td align='right'>$medcx</td><td></td><td align='right'>$medcxc</td></tr>";
            $category_content .= "<tr><td>Radiology and Ancillary</td><td align='right'>$raa</td><td align='right'>$draa</td><td align='right'>$raac</td></tr>";
            $category_content .= "<tr><td>Rehabilitation Medicine And Physical Therapy</td><td align='right'>$rmap</td><td align='right'>$drmap</td><td align='right'>$rmapc</td></tr>";
            $category_content .= "<tr><td>Others</td><td align='right'>$others</td><td align='right'>$dothers</td><td align='right'>$othersc</td></tr>";
            $category_content .= "<tr><td><b>Total</b></td><td align='right'><b>$catTotal</b></td><td align='right'>$dcatTotal</td><td align='right'><b>$catTotalc</b></td></tr>";
            $print = str_replace("[category_content]",$category_content,$print);

            ////////////////////////// with category summary //////////////////////////


            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            
            if ($excel == true){
                    $filename = "ValuCare_PayToDoctor_$hmo_bill_id";
                    header("Content-Disposition: attachment; filename=\"$filename\""); 
                    header("Content-Type: application/vnd.ms-excel");
                    echo $print;
                
            }else{
                echo "<button class='noprint' onclick=\"window.location = '../../printDoctorPayableExcel/id/$hmo_bill_id'\" value='' >Export to Excel</button>";
                echo $print;          
            }
            
        
    }
    
    
    private function printWpPayable($hmo_bill_id, $excel = false){
        $connection=Yii::app()->db;   
        $print = implode("", file(Yii::app()->getBasePath().'/modules/ValuCare/html/printWpPayable.html'));            
         
        $billing_id =  $hmo_bill_id;
        $billing = HmoBilling::model()->findByPk((int)$billing_id );             
        
        $print = str_replace("[soa_no]","WPB-".$billing_id,$print);             
        $print = str_replace("[date_prepared]",date("Y-M-d",strtotime($billing->date_prepared) ), $print);                        
        $print = str_replace("[due_date]",date("Y-M-d",strtotime($billing->date_due) ),$print);                                    
        
        /*$profile = Profile::model()->findByAttributes(array("user_id"=>$billing->by_userid));
        $prepared_by = $profile->first_name.' '.$profile->last_name;                     
        $print = str_replace("[preparedy_by]",$prepared_by,$print);*/
        $profile=Yii::app()->getModule('user')->user()->profile;                
        $prepared_by = $profile->first_name.' '.$profile->last_name; 
        $print = str_replace("[preparedy_by]",$prepared_by,$print);
         
        //get the bill items
        $bill_items = "";                                     
         $query = "select a.itemid,
                    b.avail_date,
                    b.patient_name,
                    a.payto,
                    a.claim_doctor_name,
                    a.diagnosis,
                    a.med_service,
                    a.service_type,
                    a.req_doctor,
                    a.charge_type,
                    a.charge_fee    
                    from hmo_form_items a
                    left join hmo_form b
                    on a.hmo_form_id = b.id
                    where a.hmo_form_id in 
                    (
                    select id from hmo_form where
                    hmo_billing_id = $hmo_bill_id
                    )
                    and a.payto = 'WPCLINIC'
                    and a.service_type != 'APE'
                    order by b.avail_date asc";
        $command=$connection->createCommand($query);
        $dataReader=$command->query();
        foreach($dataReader as $row) { 
            $holder = "<tr>";
                $holder .= "<td>".$row["avail_date"]."</td>";
                $holder .= "<td>".$row["patient_name"]."</td>";                    
                $holder .= "<td>".$row["diagnosis"]."</td>";
                $holder .= "<td>".$row["med_service"]."</td>"; 
                if ($row["req_doctor"] == ""){
                    $holder .= "<td>&nbsp;</td>";
                }else{
                    $holder .= "<td>".$row["req_doctor"]."</td>";                       
                }
                
                
                if ($row["charge_type"] == "CCHARGE" ){
                    $holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";
                    $holder .= "<td class='money' >&nbsp;</td>";
                    $holder .= "<td class='money' >&nbsp;</td>";
                    
                }else if ($row["charge_type"] == "PROCEDURE" ){                        
                    $holder .= "<td class='money' >&nbsp;</td>";
                    $holder .= "<td class='money'>".number_format($row["charge_fee"], 2)."</td>";
                    $holder .= "<td class='money'>&nbsp;</td>";
                    
                } else if ($row["charge_type"] == "PROF_FEE" ){
                    $holder .= "<td class='money'>&nbsp;</td>";                        
                    $holder .= "<td class='money'>&nbsp;</td>";
                    $holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";                        
                }
                
            $holder .= "</tr>";
            $bill_items.= $holder;
            
        }            
         $print = str_replace("[bill_items]",$bill_items, $print);        
         
         
         //compute clinic charge total
        $query = "select sum(b.charge_fee) as clinic_charge_sum
                    from hmo_form a
                    left join hmo_form_items b
                    on a.id = b.hmo_form_id
                    where a.hmo_billing_id = $hmo_bill_id 
                    and b.charge_type = 'CCHARGE' 
                    and b.payto = 'WPCLINIC' 
                    and b.service_type != 'APE' ";                                                                              
        $command=$connection->createCommand($query);
        $dataReader=$command->query();
    
        foreach($dataReader as $row) { 
            $clinic_charge_sum = number_format($row["clinic_charge_sum"],2);
        }
        $print = str_replace("[cc]",$clinic_charge_sum,$print);    
        
        //compute doctors procedure total
        $query = "select sum(b.charge_fee) as doc_proc_sum
                    from hmo_form a
                    left join hmo_form_items b
                    on a.id = b.hmo_form_id
                    where a.hmo_billing_id = $hmo_bill_id 
                    and b.charge_type = 'PROCEDURE'
                    and b.payto = 'WPCLINIC'
                    and b.service_type != 'APE'  ";                                                                              
                                                                 
        $command=$connection->createCommand($query);
        $dataReader=$command->query();
    
        foreach($dataReader as $row) { 
            $doc_proc_sum = number_format($row["doc_proc_sum"],2);
        }
        $print = str_replace("[dp]",$doc_proc_sum,$print);    
        
        //compute prof fee total
        $query = "select sum(b.charge_fee) as prof_fee_sum
                    from hmo_form a
                    left join hmo_form_items b
                    on a.id = b.hmo_form_id
                    where a.hmo_billing_id = $hmo_bill_id 
                    and b.charge_type = 'PROF_FEE'
                    and b.payto = 'WPCLINIC' 
                    and b.service_type != 'APE' ";     
                                                     
        $command=$connection->createCommand($query);
        $dataReader=$command->query();
    
        foreach($dataReader as $row) { 
            $prof_fee_sum = number_format($row["prof_fee_sum"],2);
        }
        $print = str_replace("[pf]",$prof_fee_sum,$print);
        
                                    
       
         //compute total  
        $query = "select sum(b.charge_fee) as billtotal 
                    from hmo_form a
                    left join hmo_form_items b
                    on a.id = b.hmo_form_id
                    where a.hmo_billing_id = $hmo_bill_id
                    and b.payto = 'WPCLINIC' 
                    and b.service_type != 'APE'  ";                                    
        
        $command=$connection->createCommand($query);
        $dataReader=$command->query();
    
        foreach($dataReader as $row) { 
            $billtotal = number_format($row["billtotal"],2);
        }
        $print = str_replace("[gt]",$billtotal,$print);   

        ////////////////////////// with category summary //////////////////////////

        $command=$connection->createCommand("select * from hmo_form_items_category where hmo_billing_id = $billing_id");
        $dataReader=$command->query();

        $aes = $ape = $lab = $raa = $rmap = $others = $med = $meddx = $medcx = 0;
        $aesc = $apec = $labc = $raac = $rmapc = $othersc = $medc = $meddxc = $medcxc = 0;

        $daes = $dape = $dlab = $draa = $drmap = $dothers = $dmed = $dmeddx = $dmedcx = 0;
        $daesc = $dapec = $dlabc = $draac = $drmapc = $dothersc = $dmedc = $dmeddxc = $dmedcxc = 0;

        foreach($dataReader as $row) { 
            if($row['category'] != "Annual Physical Exam") {
                    $adder = $this->countCategories($row['med_service']);
            }else{
                if(substr($row['med_service'], 0, 5) == "Basic"){
                    $adder = 1;
                }else{
                    $adder = $this->countCategories($row['med_service']);
                }
            }
            if($row['payto'] == 'DOCTOR'){
                /*switch($row['category']){
                    case 'Aesthetics': $daes = $daes + $adder; $daesc = $daesc + $row['amount']; break;
                    case 'Annual Physical Exam': $dape = $dape + $adder; $dapec = $dapec + $row['amount']; break;
                    case 'Laboratory': $dlab = $dlab + $adder; $dlabc = $dlabc + $row['amount']; break;
                    case 'Consultation': $dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                    case 'Medical':
                    case 'Medical Clinic': $dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                    case 'Clinic Procedure':$dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                    //case 'Clinic Procedure':$dmedcx++; $dmedcxc = $dmedcxc + $row['amount'];break;
                    case 'Doctors Procedure':
                    case 'Doctors and Procedures': $dmeddx = $dmeddx + $adder; $dmeddxc = $dmeddxc + $row['amount']; break;
                    case 'Radiology and Ancillary': $draa = $draa + $adder; $draac = $draac + $row['amount']; break;
                    case 'Rehabilitation Medicine And Physical Therapy': $draa = $draa + $adder; $drmapc = $drmapc + $row['amount']; break;
                    default: $dothers = $dothers + $adder; $dothersc = $dothersc + $row['amount']; break;
                }*/
            }else{
                switch($row['category']){
                    case 'Aesthetics': $aes = $aes + $adder; $aesc = $aesc + $row['amount']; break;
                    case 'Annual Physical Exam': $ape = $ape + $adder; $apec = $apec + $row['amount']; break;
                    case 'Laboratory': $lab = $lab + $adder; $labc = $labc + $row['amount']; break;
                    case 'Consultation': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                    case 'Medical':
                    case 'Medical Clinic': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                    case 'Clinic Procedure': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                    //case 'Clinic Procedure':$medcx++; $medcxc = $medcxc + $row['amount'];break;
                    case 'Doctors Procedure':
                    case 'Doctors and Procedures': $meddx = $meddx + $adder; $meddxc = $meddxc + $row['amount']; break;
                    case 'Radiology and Ancillary': $raa = $raa + $adder; $raac = $raac + $row['amount']; break;
                    case 'Rehabilitation Medicine And Physical Therapy': $rmap = $rmap + $adder; $rmapc = $rmapc + $row['amount']; break;
                    default: $others = $others + $adder; $othersc = $othersc + $row['amount']; break;
                }                
            }

        }

        // get total count and amount of uncategorized items 
        $command = $connection->createCommand("select id from hmo_form where hmo_billing_id = $billing_id");
        $dataReaderCatHF = $command->query();
        $additionalOthersAmount = 0;
        $additionalOthersCount = 0;
        foreach($dataReaderCatHF as $rowHF) { 
            $idHF = $rowHF['id'];
            $command = $connection->createCommand("select itemid,charge_fee from hmo_form_items where hmo_form_id = $idHF and is_categorized = 0");
            $dataReaderCatHFI = $command->query();
            if($dataReaderCatHFI){
                foreach ($dataReaderCatHFI as $rowHFI) {
                    $additionalOthersAmount = $additionalOthersAmount+$rowHFI['charge_fee'];
                    $additionalOthersCount++;
                }
            }
        }
        $others = $others + $additionalOthersCount;
        $othersc = $othersc + $additionalOthersAmount;

        // compute values in category
        $catTotal = $aes+$ape+$lab+$raa+$rmap+$med+$meddx+$medcx+$others;
        $catTotalc = $aesc+$apec+$labc+$raac+$rmapc+$medc+$meddxc+$medcxc+$othersc; 
        $dcatTotal = $daes+$dape+$dlab+$draa+$drmap+$dmed+$dmeddx+$dmedcx+$dothers;
        $dcatTotalc = $daesc+$dapec+$dlabc+$draac+$drmapc+$dmedc+$dmeddxc+$dmedcxc+$dothersc; 

        //$catTotal = $catTotal + $dcatTotal;
        $catTotalc = $catTotalc + $dcatTotalc;
        $catTotalc = number_format($catTotalc,2);

        $aesc = $aesc + $daesc; $aesc = number_format($aesc,2);
        $apec = $apec + $dapec; $apec = number_format($apec,2);
        $labc = $labc + $dlabc; $labc = number_format($labc,2);
        $medc = $medc + $dmedc; $medc = number_format($medc,2);
        $meddxc = $meddxc + $dmeddxc; $meddxc = number_format($meddxc,2);
        $medcxc = $medcxc + $dmedcxc; $medcxc = number_format($medcxc,2);
        $raac = $raac + $draac; $raac = number_format($raac,2);
        $rmapc = $rmapc + $drmapc; $rmapc = number_format($rmapc,2);
        $othersc = $othersc + $dothersc; $othersc = number_format($othersc,2);

        $category_content = "<tr><td>Aesthetics</td><td align='right'>$aes</td><td align='right'>$daes</td><td align='right'>$aesc</td></tr>";
        $category_content .= "<tr><td>Annual Physical Exam</td><td align='right'>$ape</td><td align='right'>$dape</td><td align='right'>$apec</td></tr>";
        $category_content .= "<tr><td>Doctors and Procedures</td><td align='right'>$meddx</td><td align='right'>$dmeddx</td><td align='right'>$meddxc</td></tr>";
        $category_content .= "<tr><td>Laboratory</td><td align='right'>$lab</td><td align='right'>$dlab</td><td align='right'>$labc</td></tr>";
        $category_content .= "<tr><td>Medical Clinic</td><td align='right'>$med</td><td align='right'>$dmed</td><td align='right'>$medc</td></tr>";
        //$category_content .= "<tr><td>Medical </td><td align='right'>$medcx</td><td></td><td align='right'>$medcxc</td></tr>";
        $category_content .= "<tr><td>Radiology and Ancillary</td><td align='right'>$raa</td><td align='right'>$draa</td><td align='right'>$raac</td></tr>";
        $category_content .= "<tr><td>Rehabilitation Medicine And Physical Therapy</td><td align='right'>$rmap</td><td align='right'>$drmap</td><td align='right'>$rmapc</td></tr>";
        $category_content .= "<tr><td>Others</td><td align='right'>$others</td><td align='right'>$dothers</td><td align='right'>$othersc</td></tr>";
        $category_content .= "<tr><td><b>Total</b></td><td align='right'><b>$catTotal</b></td><td align='right'>$dcatTotal</td><td align='right'><b>$catTotalc</b></td></tr>";
        $print = str_replace("[category_content]",$category_content,$print);

        ////////////////////////// with category summary //////////////////////////
       
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);
        if ($excel == true){
            $filename = "ValuCare_PayToWp_$hmo_bill_id";
                header("Content-Disposition: attachment; filename=\"$filename\""); 
                header("Content-Type: application/vnd.ms-excel");
                echo $print;
            
        }else{
            echo "<button class='noprint' onclick=\"window.location = '../../printWpPayableExcel/id/$hmo_bill_id'\" value='' >Export to Excel</button>";
            echo $print;          
        }
             
    }
    
    private function printWpPayableCategories($hmo_bill_id, $excel = false){
        if($_GET){
            $connection=Yii::app()->db; 
            $billing_id =  $_GET["id"];
            $billing = HmoBilling::model()->findByPk((int)$billing_id );             
            $hmo = Hmo::model()->findByPk($billing->hmo_id);
            
            $hmo_add = $hmo->street1."<br/>".$hmo->street2.", ".$hmo->barangay."<br/>".$hmo->city.", ".$hmo->province;
            $url = Yii::app()->getBasePath() ;         
            $print = implode("", file(Yii::app()->getBasePath().'/modules/ValuCare/html/printWpPayableCategories.html'));
            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            $print = str_replace("[HMO]",$hmo->name,$print);
            
            $print = str_replace("[HMO_add]",$hmo_add,$print);                        
            $print = str_replace("[date_prepared]",date("Y-M-d",strtotime($billing->date_prepared) ), $print);                        
            $print = str_replace("[due_date]",date("Y-M-d",strtotime($billing->date_due) ),$print);                                    
            
            //SOA No.
            $print = str_replace("[soa_no]","WPB-".$billing_id,$print);
            
            //get the bill items
            $bill_items = "";             
            $hom_form_ids_arr = [];
            $command=$connection->createCommand("select id from hmo_form where hmo_billing_id = $billing_id");
            $dataReaderIns=$command->query();
            if($dataReaderIns){
                foreach($dataReaderIns as $rowIns){
                    $hom_form_ids_arr[] = $rowIns["id"];
                }
            }
            $hom_form_ids_string = implode(",",$hom_form_ids_arr);
                        
            /*$query = "select a.itemid,
                        b.avail_date,
                        b.patient_name,
                        a.payto,
                        a.claim_doctor_name,
                        a.diagnosis,
                        a.med_service,
                        a.service_type,
                        a.req_doctor,
                        a.charge_type,
                        a.charge_fee,
                        a.is_categorized

                         from hmo_form_items a
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where a.hmo_form_id in 
                        (
                            $hom_form_ids_string
                        )
                        order by a.itemid asc";*/

             $query = "select a.itemid,
                        b.avail_date,
                        b.patient_name,
                        a.payto,
                        a.claim_doctor_name,
                        a.diagnosis,
                        a.med_service,
                        a.service_type,
                        a.req_doctor,
                        a.charge_type,
                        a.charge_fee,   
                        a.is_categorized 
                        from hmo_form_items a
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where a.hmo_form_id in 
                        (
                            $hom_form_ids_string
                        )
                        and a.payto = 'WPCLINIC'
                        and a.service_type != 'APE'
                        order by b.avail_date asc";
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
            $apeT = $medT = $radT = $labT = $ptT = $othT = $docT = 0;
            foreach($dataReader as $row) { 
                $holder = "<tr>";
                    $holder .= "<td>".$row["avail_date"]."</td>";
                    $holder .= "<td>".$row["patient_name"]."</td>";
                    $holder .= "<td>".$row["claim_doctor_name"]."</td>";
                    $holder .= "<td>".$row["diagnosis"]."</td>";
                    $holder .= "<td>".$row["med_service"]."</td>";  

                    $ape = $med = $rad = $lab = $pt = $oth = $doc = 0;
                    $is_categorized = $row['is_categorized'];
                    if($is_categorized == 1){
                        $command=$connection->createCommand("select hmo_form_item_id,amount,category from hmo_form_items_category where hmo_form_item_id = ".$row['itemid']);
                        $dataReaderHFIC=$command->query();
                        if($dataReaderHFIC){
                            foreach ($dataReaderHFIC as $rowHFIC) {
                                switch($rowHFIC["category"]){
                                    case "Annual Physical Exam":
                                        $ape = $ape+$rowHFIC["amount"];
                                        break;
                                    case "Laboratory":
                                        $lab = $lab+$rowHFIC["amount"];
                                        break;
                                    case "Medical":
                                    case "Medical Clinic":
                                        $med = $med+$rowHFIC["amount"];
                                        break;
                                    case "Radiology and Ancillary":
                                        $rad = $rad+$rowHFIC["amount"];
                                        break;
                                    case "Doctors Procedure":
                                    case "Doctors and Procedures":
                                        $doc = $doc+$rowHFIC["amount"];
                                        break;
                                    case "Rehabilitation Medicine And Physical Therapy":
                                        $pt = $pt+$rowHFIC["amount"];
                                        break;
                                    default:
                                        $oth = $oth+$rowHFIC["amount"];
                                        break;
                                }
                            }
                        }
                    }else{
                        $oth = $oth+$row["charge_fee"];
                    }

                    // totals
                    $apeT = $apeT+$ape;
                    $medT = $medT+$med;
                    $radT = $radT+$rad;
                    $labT = $labT+$lab;
                    $ptT = $ptT+$pt;
                    $docT = $docT+$doc;
                    $othT = $othT+$oth;

                    // items
                    if($ape != 0) { $ape = number_format($ape,2); }else{ $ape = ""; }
                    if($med != 0) { $med = number_format($med,2); }else{ $med = ""; }
                    if($rad != 0) { $rad = number_format($rad,2); }else{ $rad = ""; }
                    if($lab != 0) { $lab = number_format($lab,2); }else{ $lab = ""; }
                    if($pt != 0) { $pt = number_format($pt,2); }else{ $pt = ""; }
                    if($doc != 0) { $doc = number_format($doc,2); }else{ $doc = ""; }
                    if($oth != 0) { $oth = number_format($oth,2); }else{ $oth = ""; }

                    //$holder .= "<td class='money'>$ape</td>";  
                    $holder .= "<td class='money'>$ape</td>";  
                    $holder .= "<td class='money'>$doc</td>";  
                    $holder .= "<td class='money'>$med</td>"; 
                    $holder .= "<td class='money'>$lab</td>";  
                    $holder .= "<td class='money'>$rad</td>";  
                    $holder .= "<td class='money'>$pt</td>";  
                    $holder .= "<td class='money'>$oth</td>";  

                    
                    if ($row["charge_type"] == "CCHARGE" ){
                        $holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";
                        //$holder .= "<td class='money' >&nbsp;</td>";
                        //$holder .= "<td class='money' >&nbsp;</td>";
                        
                    }else if ($row["charge_type"] == "PROCEDURE" ){                        
                        $holder .= "<td class='money'>&nbsp;</td>";
                        //$holder .= "<td class='money'>".number_format($row["charge_fee"], 2)."</td>";
                        //$holder .= "<td class='money'>&nbsp;</td>";
                        
                    } else if ($row["charge_type"] == "PROF_FEE" ){
                        $holder .= "<td class='money'>&nbsp;</td>";                        
                        //$holder .= "<td class='money'>&nbsp;</td>";
                        //$holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";                        
                    }
                    
                $holder .= "</tr>";
                $bill_items.= $holder;
                
            }    
            $cgT = $apeT + $medT + $radT + $labT + $ptT + $othT + $docT;
            if($cgT != 0) { $cgT = number_format($cgT,2); }else{ $cgT = ""; }
            $print = str_replace("[cgt]",$cgT,$print);  

            if($apeT != 0) { $apeT = number_format($apeT,2); }else{ $apeT = "0.00"; }
            if($medT != 0) { $medT = number_format($medT,2); }else{ $medT = "0.00"; }
            if($radT != 0) { $radT = number_format($radT,2); }else{ $radT = "0.00"; }
            if($labT != 0) { $labT = number_format($labT,2); }else{ $labT = "0.00"; }
            if($ptT != 0) { $ptT = number_format($ptT,2); }else{ $ptT = "0.00"; }
            if($docT != 0) { $docT = number_format($docT,2); }else{ $docT = "0.00"; }
            if($othT != 0) { $othT = number_format($othT,2); }else{ $othT = "0.00"; }
            $print = str_replace("[ape]",$apeT,$print);   
            $print = str_replace("[med]",$medT,$print);    
            $print = str_replace("[rad]",$radT,$print);    
            $print = str_replace("[lab]",$labT,$print);    
            $print = str_replace("[pt]",$ptT,$print);     
            $print = str_replace("[doc]",$docT,$print);  
            $print = str_replace("[oth]",$othT,$print);     
            
            //compute clinic charge total
            $query = "select sum(b.charge_fee) as clinic_charge_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.payto = 'WPCLINIC'
                        and b.service_type != 'APE'
                        and b.charge_type = 'CCHARGE'";                                                                              
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $clinic_charge_sum = number_format($row["clinic_charge_sum"],2);
            }
            $print = str_replace("[cc]",$clinic_charge_sum,$print);    
            
            //compute doctors procedure total
            $query = "select sum(b.charge_fee) as doc_proc_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.payto = 'WPCLINIC'
                        and b.service_type != 'APE'
                        and b.charge_type = 'PROCEDURE'";                                                                              
                                                                     
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $doc_proc_sum = number_format($row["doc_proc_sum"],2);
            }
            $print = str_replace("[dp]",$doc_proc_sum,$print);    
            
            //compute prof fee total
            $query = "select sum(b.charge_fee) as prof_fee_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.payto = 'WPCLINIC'
                        and b.service_type != 'APE'
                        and b.charge_type = 'PROF_FEE'";     
                                                         
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $prof_fee_sum = number_format($row["prof_fee_sum"],2);
            }
            $print = str_replace("[pf]",$prof_fee_sum,$print);
            
            
            //compute total  
            $query = "select sum(b.charge_fee) as billtotal 
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.payto = 'WPCLINIC'
                        and b.service_type != 'APE'";                                    
            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $billtotal = number_format($row["billtotal"],2);
            }
            $print = str_replace("[gt]",$billtotal,$print);                              
            
            $print = str_replace("[bill_items]",$bill_items, $print);  

            $profile=Yii::app()->getModule('user')->user()->profile;                
            $prepared_by = $profile->first_name.' '.$profile->last_name;
            $print = str_replace("[preparedy_by]",$prepared_by,$print);
            
            if ($to_excel == true){
                    $filename = "HmoBilling$billing_id";
                    header("Content-Disposition: attachment; filename=\"$filename\""); 
                    header("Content-Type: application/vnd.ms-excel");
                    echo $print;
            }else{
                echo "<button class='noprint' onclick=\"window.location = '../../printWpPayableCategoriesExcel/id/$hmo_bill_id'\" value='' >Export to Excel</button>";
                echo $print;
            }
            
        }
             
    }
    
    public function countCategories($med_service){
        $med_service_arr = explode("+",$med_service);
        return count($med_service_arr);
    }
    
    
    
}