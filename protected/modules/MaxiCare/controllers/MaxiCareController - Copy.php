<?php

class MaxiCareController extends Controller
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
    
    public function actionPrintWpPayable()
    {           
        $this->printWpPayable($_GET["id"]);        
    }  
    
    public function actionPrintWpPayableExcel()
    {           
        $this->printWpPayable($_GET["id"], true);        
    }
    
    public function actionPrintDoctorPayableExcel()
    {
           $this->printDoctorPayable($_GET["id"], true);                  
    }
    
    
    public function actionPrintDoctorPayable()
    {
           $this->printDoctorPayable($_GET["id"]);                  
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
           $print = implode("", file(Yii::app()->getBasePath().'/modules/MaxiCare/html/printSummary.html')); 
           
           $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);  
              
            $billing_id =  $hmo_bill_id;
            $billing = HmoBilling::model()->findByPk((int)$billing_id ); 
            
            $query = "select x.id,x.firstname,x.lastname
                    from doctor x
                    where x.id in
                    (
                    select 
                    distinct a.claim_doctor_id

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
                    order by b.avail_date asc
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
            
            $print = str_replace("[gt]",number_format($run_total,2),$print);    
             
            $sum_date = date("M d, Y", strtotime($billing->date_prepared));   
            $print = str_replace("[sum_date]",$sum_date,$print);
            echo $print;       
        
    }
    
    private function printApe($hmo_bill_id)
    {
            $connection=Yii::app()->db;   
            $print = implode("", file(Yii::app()->getBasePath().'/modules/MaxiCare/html/printApe.html'));            
             
            $billing_id =  $hmo_bill_id;
            $billing = HmoBilling::model()->findByPk((int)$billing_id );             
                         
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
                    
                    
                    if ($row["charge_type"] == "PROCEDURE" ){                        
                        
                        $holder .= "<td class='money'>".number_format($row["charge_fee"], 2)."</td>";
                        $holder .= "<td class='money'>&nbsp;</td>";
                        
                    } else if ($row["charge_type"] == "PROF_FEE" ){
                       
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
            
            
           
            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
             echo $print;       
        
    }
    
    private function printDoctorPayable($hmo_bill_id, $excel = false)
    {
         $connection=Yii::app()->db;   
            $print = implode("", file(Yii::app()->getBasePath().'/modules/MaxiCare/html/printDoctorPayable.html'));            
             
            $billing_id =  $hmo_bill_id;
            $billing = HmoBilling::model()->findByPk((int)$billing_id );             
                         
            $print = str_replace("[date_prepared]",date("Y-M-d",strtotime($billing->date_prepared) ), $print);                        
            $print = str_replace("[due_date]",date("Y-M-d",strtotime($billing->date_due) ),$print);                                    
            
            $profile=Yii::app()->getModule('user')->user()->profile;                
            $prepared_by = $profile->first_name.' '.$profile->last_name; 
            $print = str_replace("[preparedy_by]",$prepared_by,$print);
             
            //get the bill items
            $bill_items = "";       
            
            //get the doctors first
            $query = "select x.id,x.firstname,x.lastname
                    from doctor x
                    where x.id in
                    (
                    select 
                    distinct a.claim_doctor_id

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
                    order by b.avail_date asc
                    )
                    order by x.lastname asc";               
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
                                select id from hmo_form where
                                hmo_billing_id = $hmo_bill_id
                            )
                            and a.payto = 'DOCTOR'
                            and a.service_type != 'APE'
                            and a.claim_doctor_id = ".$row2["id"]."
                            order by a.itemid asc";
                $command=$connection->createCommand($query);
                $doctrnxs_dataReader=$command->query();
                $rowspan_flag = false;
                $row_counter = 1;
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
           
            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            
            if ($excel == true){
                $filename = "MaxiCare_PayToDoctor_$hmo_bill_id";
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
            $print = implode("", file(Yii::app()->getBasePath().'/modules/MaxiCare/html/printWpPayable.html'));            
             
            $billing_id =  $hmo_bill_id;
            $billing = HmoBilling::model()->findByPk((int)$billing_id );             
                         
            $print = str_replace("[date_prepared]",date("Y-M-d",strtotime($billing->date_prepared) ), $print);                        
            $print = str_replace("[due_date]",date("Y-M-d",strtotime($billing->date_due) ),$print);                                    
            
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
                        order by a.itemid asc";
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
                        and b.payto = 'WPCLINIC'     ";                                                                              
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
                        and b.payto = 'WPCLINIC'";                                                                              
                                                                     
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
                        and b.payto = 'WPCLINIC'  ";     
                                                         
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
                        and b.payto = 'WPCLINIC' ";                                    
            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $billtotal = number_format($row["billtotal"],2);
            }
            $print = str_replace("[gt]",$billtotal,$print);   
            
            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            
            if ($excel == true){
                    $filename = "MaxiCare_PayToWp_$hmo_bill_id";
                    header("Content-Disposition: attachment; filename=\"$filename\""); 
                    header("Content-Type: application/vnd.ms-excel");
                    echo $print;
                
            }else{
                echo "<button class='noprint' onclick=\"window.location = '../../printWpPayableExcel/id/$hmo_bill_id'\" value='' >Export to Excel</button>";
                echo $print;          
            }
    }
    
    
    
    
}