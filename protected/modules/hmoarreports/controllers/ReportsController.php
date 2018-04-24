<?php
class ReportsController extends Controller
{
    public function actionAdjustDocTax(){
        $this->AdjustDocTax();
    }
    
    public function actionArsum()
    {
        $this->render('arsummary');
    }
    
    public function actionPrintSummary(){            
            $this->PrintSummary();       
    }
    
    public function actionBcreport(){
        $task = $_GET["task"];
        
        switch ($task){
            
            case "hmopaidtrnxs":
                $hmoid = $_GET["hmoid"];
                $dstart = $_GET["start"];
                $dend = $_GET["end"]; 
                $this->render('bc2_hmopaidtrnxs');
            break;
 
            case "grabber":
                $this->render('grabber');
            break;
            
            case "hmonotpaidtrnxs":
                $hmoid = $_GET["hmoid"];
                $dstart = $_GET["start"];
                $dend = $_GET["end"]; 
                $this->render('bc2_hmonotpaidtrnxs');
            break;

            
            case "hmochecks_generate":
                include Yii::app()->getBasePath().'/modules/hmoarreports/hmochecks_report.php';
            break;
                                    
            case "hmochecks_params":
                $this->render('hmochecks_params');
            break;
            
            case "hmochecks_paid":
                $this->render('bc2_hmochecks_paid');
            break;
            
             case "hmoindchecks_generate":
                include Yii::app()->getBasePath().'/modules/hmoarreports/hmoindchecks_report.php';
            break;                                                                              
            case "hmoindchecks_params":
                $this->render('hmoindchecks_params');
            break;
            
            case "hmoalldocs_generate":
                $this->generateHMOAllDocs();
            break;
            case "hmoalldocs_params":
                $this->render('hmoalldocs_params');
            break;
            
            case "searchtrnxs":
                $this->render('bc4_searchtrnxs');
            break;
            case "searchparam":
                $this->render('bc4_searchparams');
            break;
            case "wpgenerate":
                $this->render('bc3_wptrnxs');
                
            break;
            case "wpparams":
                $this->render('bc3_wpparams');
            break;
                
            case "doctrnxs":
                $this->render('bc2_doctrnxs');
                
            break;
            case "docgenerate":
                $this->render('bc2_docgenerate');
                
            break;
            case "docparams":
                $this->render('bc2_docparams');
                break;
            
            case "trnxs":                
                $billid = $_GET["billid"];           
                $this->render('bc1_trnxs');                
            break;
            
            case "generate":
                $hmoid = $_GET["hmoid"];
                $dstart = $_GET["start"];
                $dend = $_GET["end"];      
                $this->render('bc1_generate');
            break;
            
            default:
                $this->render('bc1_params');
            break;
        }
    }
    
    public function customLinks($data,$row){
        echo "<a href='http://".$_SERVER["HTTP_HOST"]."/hmoarreports/reports/bcreport?task=trnxs&billid=".$data->id."'>View Trnxs</a>";
    }
    
    public function docCustomLinks($data,$row){
        $dstart  = $_GET["start"];
            $dend  = $_GET["end"];
        echo "<a href='http://".$_SERVER["HTTP_HOST"]."/hmoarreports/reports/bcreport?task=doctrnxs&docid=".$data->id."&start=".$dstart."&end=".$dend."'>View Trnxs</a>";
    }
    
    public function getItemId($hbi, $hi){           
            $connection=Yii::app()->db;
           $query = "SELECT id FROM hmo_form WHERE hmo_billing_id = ". $hbi . " AND hmo_id = ". $hi ;
            $hmo_id = array();
            $command=$connection->createCommand($query);
            $datareader=$command->query();            
            if ($datareader){    
                foreach($datareader as $recd) { 
                    $hmo_id[] = $recd["id"];
                }
            }
                 
            //get hmo_ids
            $hmo_ids = implode(",",$hmo_id);
            if($hmo_ids==""){
                $hmo_ids = 0;
            }             

            $query = "SELECT * FROM hmo_form_items WHERE hmo_form_id IN (".$hmo_ids.")";
            $itemid = array();
            $command=$connection->createCommand($query);
            $datareader=$command->query();            
            if ($datareader){    
                foreach($datareader as $recd) { 
                    $itemid[] = $recd["itemid"];
                }
            }

            //get itemid
            $itemids = implode(",",$itemid);
            if($itemids==""){
                $itemids = 0;
            } 
            return  $itemids;
    }
    
    public function getPaidTotal($data,$row){            
            $connection=Yii::app()->db;
            
            $hmo_id = $data->hmo_id;
            $hmo_billing_id = $data->id;      
   
            $itemids = $this->getItemId($hmo_billing_id, $hmo_id);    
            
            $query ="select sum(paid_amnt) as totpaid
            from hmoar_chkapply where form_itemid in(".$itemids.")";  
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    if (floatval($recd["totpaid"]) > 0){
                        echo number_format($recd["totpaid"], 2);    
                    }else{
                        echo "0.00";
                    }
                    
                }
            }
    }
    
    public function getWtaxTotal ($data,$row){ 
            $connection=Yii::app()->db;
            
            $hmo_id = $data->hmo_id;
            $hmo_billing_id = $data->id;
   
            $itemids = $this->getItemId($hmo_billing_id, $hmo_id);
            
            $query ="select sum(wtax) as totwtax
            from hmoar_chkapply where form_itemid in(".$itemids.")"; 
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totwtax"]) > 0){
                        echo number_format($recd["totwtax"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }
        
    }
    
    public function getLossTotal ($data,$row){
            $connection=Yii::app()->db;
            
            $hmo_id = $data->hmo_id;
            $hmo_billing_id = $data->id;
   
            $itemids = $this->getItemId($hmo_billing_id, $hmo_id); 
            $query ="select sum(loss) 
            from hmoar_chkapply where form_itemid in(".$itemids.")"; 
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totloss"]) > 0){
                        echo number_format($recd["totloss"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }      
    }
    
    public function getBalance ($data,$row){
             $connection=Yii::app()->db;
            
            $hmo_id = $data->hmo_id;
            $hmo_billing_id = $data->id;
   
            $itemids = $this->getItemId($hmo_billing_id, $hmo_id);
            $query ="select sum(paid_amnt) as totpaid,
                sum(wtax) as tottax,
                sum(loss) as totloss  
                from hmoar_chkapply where form_itemid in(".$itemids.")";
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
                    $receivable = floatval($data->bill_total) - $tmp_paidtot;
                    if ($receivable > 0){
                        echo number_format($receivable, 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }      
    }
    
    //Transaction info
    
     public function getTrnxBalance ($data,$row){
           $connection=Yii::app()->db; 
            
            $itemid =  $data->itemid;    
            
            echo "<script>getTrnxBalance(".$itemid.")</script><span id='getTrnxBalance".$itemid."'>Loading...</span>";
//            $connection=Yii::app()->db;  
//            $query ="select sum(a.paid_amnt) as totpaid,
//                sum(a.wtax) as tottax,
//                sum(a.loss) as totloss
//                from hmoar_chkapply a
//                left join hmo_form_items b
//                on a.form_itemid = b.itemid
//                where a.form_itemid = ".$data->itemid;
//            
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){                      
//                foreach($datareader as $recd) { 
//                    $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);        
//                    $receivable = floatval($data->charge_fee) - $tmp_paidtot;
//                    if ($receivable > 0){
//                        echo number_format($receivable, 2);    
//                    }else{                                   
//                        echo "0.00";
//                    }
//                }
//            }         
    }
    
    public function getTrnxPaidTotal($data,$row){            
            $connection=Yii::app()->db; 
            
            $itemid =  $data->itemid;    
            
            echo "<script>getTrnxPaidTotal(".$itemid.")</script><span id='getTrnxPaidTotal".$itemid."'>Loading...</span>";
//            $query ="select sum(a.paid_amnt) as totpaid
//                from hmoar_chkapply a
//                left join hmo_form_items b
//                on a.form_itemid = b.itemid
//                where a.form_itemid = ".$data->itemid;
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){
//                foreach($datareader as $recd) { 
//                    if (floatval($recd["totpaid"]) > 0){
//                        echo number_format($recd["totpaid"], 2);    
//                    }else{
//                        echo "0.00";
//                    }
//                    
//                }
//            }
    }

    public function getTrnxWtaxTotal ($data,$row){
        $connection=Yii::app()->db; 
            
            $itemid =  $data->itemid;    
            
            echo "<script>getTrnxWtaxTotal(".$itemid.")</script><span id='getTrnxWtaxTotal".$itemid."'>Loading...</span>";
        
        
            //$connection=Yii::app()->db;  
//            $query ="select sum(a.wtax) as totwtax
//                from hmoar_chkapply a
//                left join hmo_form_items b
//                on a.form_itemid = b.itemid
//                where a.form_itemid = ".$data->itemid;
//            
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){
//                foreach($datareader as $recd) { 
//                    
//                    if (floatval($recd["totwtax"]) > 0){
//                        echo number_format($recd["totwtax"], 2);    
//                    }else{
//                        echo "0.00";
//                    }
//                }
//            }   
    }
    
    public function getTrnxLossTotal ($data,$row){
        
            $itemid =  $data->itemid;    
            echo "<script>getTrnxLossTotal(".$itemid.")</script><span id='getTrnxLossTotal".$itemid."'>Loading...</span>";
            
//            $connection=Yii::app()->db;  
//            $query ="select sum(a.loss) as totloss
//                from hmoar_chkapply a
//                left join hmo_form_items b
//                on a.form_itemid = b.itemid
//                where a.form_itemid = ".$data->itemid;
//            
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){
//                foreach($datareader as $recd) { 
//                    
//                    if (floatval($recd["totloss"]) > 0){
//                        echo number_format($recd["totloss"], 2);    
//                    }else{
//                        echo "0.00";
//                    }
//                }
//            }
        
    }
    
    //Check Apply
    
    public function getChkapplyHmoXces($data,$row){
    
        $itemid =  $data->itemid;    
        echo "<script>getChkapplyHmoXces(".$itemid.")</script><span id='getChkapplyHmoXces".$itemid."'>Loading...</span>";
            
//        $connection=Yii::app()->db;   
//        $query ="select a.hmo_xces
//            from hmoar_chkapply a
//            left join hmo_form_items b
//            on a.form_itemid = b.itemid
//            where a.form_itemid = ".$data->itemid;
//        $command=$connection->createCommand($query);
//        $datareader=$command->query();    
//        if ($datareader){
//            foreach($datareader as $recd) {  
//                $hmo_xces = $recd['hmo_xces'];   
//            }
//        }    
//        if ($hmo_xces ==""){
//            echo number_format($hmo_xces, 2);    
//        }else{
//            echo "0.00";
//        }
    }

    public function getChkapplyProviderXces($data,$row){
    
        $itemid =  $data->itemid;    
        echo "<script>getChkapplyProviderXces(".$itemid.")</script><span id='getChkapplyProviderXces".$itemid."'>Loading...</span>";
                      
//            $connection=Yii::app()->db;   
//            $query ="select a.provider_xces
//                from hmoar_chkapply a
//                left join hmo_form_items b
//                on a.form_itemid = b.itemid
//                where a.form_itemid = ".$data->itemid;
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){
//                foreach($datareader as $recd) { 
//                    $provider_xces =  $recd['provider_xces'];
//                }
//            }
//            
//            if ($provider_xces ==""){
//                echo number_format($provider_xces, 2);    
//            }else{
//                echo "0.00";
//            }
    }
    //Checks
    public function getChecksNo($data,$row){ 
    
        $itemid =  $data->itemid;    
        echo "<script>getChecksNo(".$itemid.")</script><span id='getChecksNo".$itemid."'>Loading...</span>";
                     
//            $connection=Yii::app()->db;   
//            $check_id= array();
//            $query ="select a.check_id
//                from hmoar_chkapply a
//                left join hmo_form_items b
//                on a.form_itemid = b.itemid
//                where a.form_itemid = ".$data->itemid;
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){
//                foreach($datareader as $recd) { 
//                   $check_id[] = $recd['check_id'];
//                  
//                }
//            }
//            $check_id = implode(',',$check_id);
//            $query = "select check_no from hmoar_checks where checkid in('$check_id')";
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){
//                foreach($datareader as $recd) { 
//                  echo $recd['check_no'];
//                }
//            }   
    }  
    
    public function getChecksDate($data,$row){
        $itemid =  $data->itemid;    
        echo "<script>getChecksDate(".$itemid.")</script><span id='getChecksDate".$itemid."'>Loading...</span>";
                        
//            $connection=Yii::app()->db;   
//            $check_id= array();
//            $query ="select a.check_id
//                from hmoar_chkapply a
//                left join hmo_form_items b
//                on a.form_itemid = b.itemid
//                where a.form_itemid = ".$data->itemid;
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){
//                foreach($datareader as $recd) { 
//                   $check_id[] = $recd['check_id'];
//                  
//                }
//            }
//            $check_id = implode(',',$check_id);   
//            $query = "select check_date from hmoar_checks where checkid in('$check_id')";
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){
//                foreach($datareader as $recd) { 
//                  echo $recd['check_date'];
//                }
//            }   
    }
    
    //Doctors
    public function getDocBilled ($data,$row){
            $connection=Yii::app()->db;
            $dstart  = $_GET["start"];
            $dend  = $_GET["end"];
            $claim_doctor_id = $data->id;
            
            echo "<script>getDocBilled(".$claim_doctor_id.")</script><span id='tr1".$claim_doctor_id."'>Loading...</span>";
//            $billed_total = 0;  
//            
//            $query = "select sum(a.charge_fee) as bill_total
//                    from hmo_form_items a
//                    left join hmo_form b
//                    on a.hmo_form_id = b.id
//                    where a.claim_doctor_id = $claim_doctor_id and
//                     b.avail_date between '".$dstart."' AND '".$dend."'";   
//                     
//            $command=$connection->createCommand($query);
//            $datareader=$command->query();
//            if ($datareader){                    
//                foreach($datareader as $recd) {   
//                    $billed_total = $recd["bill_total"];    
//                }
//            }        
//            
//            echo number_format($billed_total, 2);
    }
    
    public function getDocBalance ($data,$row){
         
     //   $connection=Yii::app()->db;
     //   $dstart  = $_GET["start"];
     //   $dend  = $_GET["end"];
        $claim_doctor_id = $data->id;   
        echo "<script>getDocBalance(".$claim_doctor_id.")</script><span id='tr2".$claim_doctor_id."'>Loading...</span>";   
          
        
     //   $query = "SELECT 
//                sum(a.paid_amnt) as totpaid,    
//                sum(a.wtax) as tottax,      
//                sum(a.loss) as totloss,
//                sum(b.charge_fee) as bill_total      
//                from hmoar_chkapply a
//                left join hmo_form_items b
//                on a.form_itemid = b.itemid
//                left join hmo_form c
//                on b.hmo_form_id = c.id
//                where c.avail_date between '".$dstart."' AND '".$dend."'
//                and b.claim_doctor_id = $claim_doctor_id";
//        
//        $command=$connection->createCommand($query);
//        $datareader=$command->query();
//        if ($datareader){
//            foreach($datareader as $recd) { 
//                $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
//                $receivable = floatval($recd["bill_total"]) - $tmp_paidtot;
//                echo number_format($tmp_paidtot, 2) ." / ". number_format($receivable, 2);
//            }
//        }     
    
    }
    
    public function PrintSummary(){
        $connection=Yii::app()->db;             

        $total_bal = 0;

        //query hmoids        
        $query = "select id,name from hmo";
        $command=$connection->createCommand($query);
        $dataReader=$command->query();

        $hmos = array();

        foreach($dataReader as $row) { 
                $hmo = array();
                $hmo["id"] = $row["id"];
                $hmo["name"] = $row["name"];
                
                $query2 = "select sum(bill_total) as biltot from hmo_billing where hmo_id =  ".$hmo["id"];
                $command2=$connection->createCommand($query2);
                $dataReader2 = $command2->query();
                foreach($dataReader2 as $row2) 
                {
                    $hmo["billtot"] = $row2["biltot"];
                }
                
                $query3 = "select c.hmo_billing_id, sum(a.paid_amnt) as totpaid,
                        sum(a.wtax) as tottax,
                        sum(a.loss) as totloss
                        from hmoar_chkapply a
                        left join hmo_form_items b
                        on a.form_itemid = b.itemid
                        left join hmo_form c
                        on b.hmo_form_id = c.id
                        where c.hmo_id = ".$hmo["id"];
                $command3=$connection->createCommand($query3);
                $dataReader3 = $command3->query();
                foreach($dataReader3 as $row3) {
                    $tmp_paidtot = floatval($row3["totpaid"]) + floatval($row3["tottax"]) + floatval($row3["totloss"]);
                }
    
                $receivable = floatval($hmo["billtot"]) - $tmp_paidtot;
                $hmo["balance"] =  $receivable;
    
                $total_bal += $receivable;
    
                $hmos[] = $hmo;
                
        }
        
        foreach ($hmos as $xhmo){        
                    $xcontents .= '<tr>
                            <td class="lbl">
                            <span style="width:150px">'.$xhmo["name"] .':</span>
                            </td>
                            <td class="val">
                                <span>'. number_format($xhmo["balance"], 2) .'</span>
                            </td>    
                    </tr>';
        
        }
        
        $contents = "
                    <fieldset>
                        <legend>HMO Balances:</legend>
                            <table>
                            $xcontents
                    ";
        $contents .= "</table>
                    </fieldset>";
        
        $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'/modules/hmoarreports/includes/hmoar_summary.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';

        $settings = Settings::model()->findByPk(1);   
        $print = str_replace("[bacoor_address_html]",$settings->bacoor_address_html,$print);
        $print = str_replace("[dasma_address_html]",$settings->dasma_address_html,$print);
        $print = str_replace("[address]",$settings->address,$print);

        $print = str_replace("[logopath]",$logo,$print);
        $print = str_replace("{receivable_total}",$total_bal,$print); 
        $print = str_replace("[contents]",$contents,$print);
        echo $print;
        exit;
    }
    
    function generateHMOAllDocs(){
            include Yii::app()->getBasePath().'/modules/hmoarreports/hmoalldocs_report.php';
            
    }
    
    function AdjustDocTax(){
        $connection=Yii::app()->db;  
        $query = "select a.form_itemid, a.check_id, a.paid_amnt, a.wtax, a.doc_tax, a.provider_xces, a.member_xces,
                    b.check_no, b.check_date, b.check_amnt, c.name, d.claim_doctor_id
                     from hmoar_chkapply a
                     left join hmoar_checks b
                     on a.check_id = b.checkid
                     left join hmo c
                     on b.hmo_id = c.id
                     left join hmo_form_items d
                     on a.form_itemid = d.itemid
                     where d.payto = 'DOCTOR'
                     order by c.name, a.check_id";        
        $command=$connection->createCommand($query);
        $dr_tmp=$command->query();
        
        while(($row=$dr_tmp->read())!==false) { 
                $doctax = floatval($row["paid_amnt"]) * .15;
                //echo $row["form_itemid"]. " - ". $row["check_no"]. "- ".$row["paid_amnt"]." / $doctax <br/>";
                $qry = "UPDATE hmoar_chkapply a
                            set a.doc_tax = $doctax
                            where a.form_itemid = ".$row["form_itemid"];
                $command=$connection->createCommand($qry);
                $res = $command->query();
                
        }
    }

    public function actionHmodoctrnxexcel(){
            $connection=Yii::app()->db;          
            if($_GET['start']){
                $dstart = $_GET["start"];
            }
            if($_GET['end']){
                $dend   = $_GET["end"];
            }
            if($_GET['paid']){
                $paid   = $_GET["paid"];
            }
            if($_GET['docid']){
                $docid   = $_GET["docid"];
            }
             
            $search = 
            $_GET['hmo_company']
            ||$_GET['avail_date']
            ||$_GET['claim_doctor_name']
            ||$_GET['med_service']
            ||$_GET['patient_name']
            ||$_GET['payable_to']
            ||$_GET['check_number']
            ||$_GET['check_date']
            ;
            
            

                
                $query[] =  "select hfi.itemid, hfi.hmo_form_id, hf.hmo_name, hf.patient_name, hca.paid_amnt, hfi.payto,
                            hf.avail_date, hfi.claim_doctor_name, hfi.med_service,
                            hfi.charge_fee, hca.wtax, hca.loss, hca.hmo_xces, hca.provider_xces,
                            hc.check_no, hc.check_date
                            from hmo_form_items hfi       
                            left join hmo_form hf      
                            on hfi.hmo_form_id = hf.id
                            left join hmoar_chkapply hca
                            on hfi.itemid = hca.form_itemid
                            left join hmoar_checks hc
                            on hca.check_id = hc.checkid  
                            left join hmo_billing hb
                            on hf.hmo_billing_id = hb.id                          
                            where 
                            hfi.claim_doctor_id = '$docid'
                            and
                            hfi.payto = 'DOCTOR'
                            and
                            hb.date_prepared 
                            between '$dstart' and '$dend'";
                    if($paid==1){
                        $query[]="
                        and hfi.itemid in (SELECT form_itemid from hmoar_chkapply)
                        ";
                    }
                    if($paid==0&&$_GET['paid']!=''){
                        $query[]="
                        and hfi.itemid not in (SELECT form_itemid from hmoar_chkapply)
                        ";
                    }             
                            
                if(!$search){         
                }else{
                if($_GET['hmo_company']!=''){
                $hmo_company = $_GET['hmo_company'];
                $query[] = "and hf.hmo_name like '%".$hmo_company."%'";
                }
                
                if($_GET['avail_date']!=''){
                $avail_date = $_GET['avail_date'];
                $query[] = "and hf.avail_date = '$avail_date'";
                }
                
                if($_GET['claim_doctor_name']){
                $claim_doctor_name = $_GET['claim_doctor_name'];
                $query[] = "and hfi.claim_doctor_name like '%".$claim_doctor_name."%'";
                }
                if($_GET['med_service']){
                $med_service = $_GET['med_service'];
                $query[] = "and hfi.med_service like '%".$med_service."%'";
                }
                if($_GET['patient_name']){
                $patient_name = $_GET['patient_name'];
                $query[] = "and hf.patient_name like '%".$patient_name."%'";
                }
                if($_GET['payable_to']){
                $payable_to = $_GET['payable_to'];
                $query[] = "and hfi.payto like '%".$payable_to."%'";
                }
                if($_GET['check_number']){
                $check_number = $_GET['check_number'];
                $query[] = "and hc.check_no = '$check_number'";
                }
                if($_GET['check_date']){
                $check_date = $_GET['check_date'];
                $query[] = "and hc.check_date = '$check_date'";
                }
                    
                    
                }       
                
                
                
                $query[] ='order by hfi.itemid';
                $query = implode(' ',$query);
                $command=$connection->createCommand($query);
                $datareader=$command->query();
                if ($datareader){
                    $table = "<table border='1' style='width:200px;'>";
                    $table .="<tr><td>Itemid</td><td>Hmo Form</td><td>HMO Company</td><td>Patient Name</td><td>Payable To</td><td>Availment Date</td><td>Doctor</td><td>Services</td><td>Charge Fee</td><td>Paid</td><td>Wtax</td><td>Loss</td><td>Unpaid</td><td>Hmo Excess</td><td>Provider Excess</td><td>Check Number</td><td>Check Date</td></tr>";
                    foreach($datareader as $key => $value ) { 
                        $table .="<tr>"; 
                        $table .= '<td>'.$value['itemid'].'</td><td>'.$value['hmo_form_id'].'</td><td>'
                        .$value['hmo_name'].'</td><td>'
                        .$value['patient_name'].'</td><td>'.$value['payto'].'</td><td>'.$value['avail_date'].'</td><td>'
                        .$value['claim_doctor_name'].'</td><td>'.$value['med_service'].'</td><td>'.$value['charge_fee']
                        .'</td><td>'.$value['paid_amnt'].'</td><td>'.$value['wtax'].'</td><td>'.$value['loss'].'</td>
                        <td>'.($value['charge_fee']-($value['paid_amnt']+$value['wtax']+$value['loss'])).
                        '</td><td>'.$value['hmo_xces'].'</td><td>'.$value['provider_xces'].'</td><td>'
                        .$value['check_no'].'</td><td>'.$value['check_date'].'</td>';
                         $table .="</tr>";  
                    }
                    $table .= "</table>";
                }

                

                $string[] = str_replace('-','_',$dstart);
                $string[] = '_';
                $string[] = str_replace('-','_',$dend);
                $string = implode('',$string);

                $filename ='hmodoctrnxs'.$string;
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-Disposition: attachment; filename=$filename.xls");
                echo $table;     
    }

    public function actionHmopaidtrnxsexcel(){
        $connection=Yii::app()->db;
            if($_GET['hmoid']){
                $hmoid  = $_GET['hmoid'];
            }          
            if($_GET['start']){
                $dstart = $_GET["start"];
            }
            if($_GET['end']){
                $dend   = $_GET["end"];
            }
            if($_GET['paid']){
                $paid   = $_GET["paid"];
            }
            if($_GET['billid']){
                $billid   = $_GET["billid"];
            }
             
            $search = 
            $_GET['avail_date']
            ||$_GET['claim_doctor_name']
            ||$_GET['med_service']
            ||$_GET['patient_name']
            ||$_GET['payable_to']
            ||$_GET['check_number']
            ||$_GET['check_date']
            ;
                $query[] ="  
                SELECT hfi.itemid, hfi.hmo_form_id, hf.patient_name, hca.paid_amnt, hfi.payto,
                hf.avail_date, hfi.claim_doctor_name, hfi.med_service,
                hfi.charge_fee, hca.wtax, hca.loss, hca.hmo_xces, hca.provider_xces,
                hc.check_no, hc.check_date
                FROM hmo_form_items hfi
                LEFT join hmo_form hf
                ON hfi.hmo_form_id = hf.id
                LEFT join hmoar_chkapply hca
                ON hfi.itemid = hca.form_itemid
                LEFT join hmoar_checks hc
                ON hca.check_id = hc.checkid      
                WHERE hfi.hmo_form_id 
                IN(
                SELECT id FROM hmo_form WHERE hmo_billing_id IN 
                (";
                if(!$billid){
                    $query[].= "'
                    SELECT id FROM hmo_billing 
                    WHERE hmo_id = '$hmoid'
                    AND date_prepared 
                    BETWEEN '$dstart' AND '$dend'";
                }
                else{
                    $query[] .= $billid;
                }
                $query[] .= ")
                )";
            
            if($paid==1){  
                $query[]="
                AND hfi.itemid IN (SELECT form_itemid from hmoar_chkapply)
                ";
                }
            if($paid==0&&$_GET['paid']!=''){
                $query[]="
                 AND hfi.itemid NOT IN (SELECT form_itemid from hmoar_chkapply)
                ";
            }
                if(!$search){         
                }else{
                    if($_GET['avail_date']!=''){
                        $avail_date = $_GET['avail_date'];
                        $query[] = "AND hf.avail_date = '$avail_date'";
                    }
                    
                    if($_GET['claim_doctor_name']){
                        $claim_doctor_name = $_GET['claim_doctor_name'];
                        $query[] = "AND hfi.claim_doctor_name LIKE '%".$claim_doctor_name."%'";
                    }
                    if($_GET['med_service']){
                        $med_service = $_GET['med_service'];
                        $query[] = "AND hfi.med_service like '%".$med_service."%'";
                    }
                    if($_GET['patient_name']){
                        $patient_name = $_GET['patient_name'];
                        $query[] = "AND hf.patient_name like '%".$patient_name."%'";
                    }
                    if($_GET['payable_to']){
                        $payable_to = $_GET['payable_to'];
                        $query[] = "AND hfi.payto like '%".$payable_to."%'";
                    }
                    if($_GET['check_number']){
                        $check_number = $_GET['check_number'];
                        $query[] = "AND hc.check_no = '$check_number'";
                    }
                    if($_GET['check_date']){
                        $check_date = $_GET['check_date'];
                        $query[] = "AND hc.check_date = '$check_date'";
                    }          
                }           
                $query[] ='ORDER BY hfi.itemid';
                $query = implode(' ',$query);
                $command=$connection->createCommand($query);
                $datareader=$command->query();
                if ($datareader){
                    $table = "<table border='1' style='width:200px;'>";
                    $table .="<tr><td>Itemid</td><td>Hmo Form</td><td>Patient Name</td><td>Payable To</td><td>Availment Date</td><td>Doctor</td><td>Services</td><td>Charge Fee</td><td>Paid</td><td>Wtax</td><td>Loss</td><td>Unpaid</td><td>Hmo Excess</td><td>Provider Excess</td><td>Check Number</td><td>Check Date</td></tr>";
                    foreach($datareader as $key => $value ) { 
                        $table .="<tr>"; 
                        $table .= '<td>'
                            .$value['itemid'].'</td><td>'
                            .$value['hmo_form_id'].'</td><td>' 
                            .$value['patient_name'].'</td><td>'
                            .$value['payto'].'</td><td>'
                            .$value['avail_date'].'</td><td>'
                            .$value['claim_doctor_name'].'</td><td>'
                            .$value['med_service'].'</td><td>'
                            .$value['charge_fee'].'</td><td>'
                            .$value['paid_amnt'].'</td><td>'
                            .$value['wtax'].'</td><td>'
                            .$value['loss'].'</td><td>'.($value['charge_fee']-($value['paid_amnt']+$value['wtax']+$value['loss'])).'</td><td>'
                            .$value['hmo_xces'].'</td><td>'
                            .$value['provider_xces'].'</td><td>'
                            .$value['check_no'].'</td><td>'
                            .$value['check_date'].'</td>';
                        $table .="</tr>";  
                    }
                    $table .= "</table>";
                }
                
                $string[] = str_replace('-','_',$dstart);
                $string[] = '_';
                $string[] = str_replace('-','_',$dend);
                $string = implode('',$string);

                $filename ='hmotrnxs'.$string;
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-Disposition: attachment; filename=$filename.xls");
                echo $table; 
 
          
     }
     
     public function actionHmowptrnxexcel(){
            $connection=Yii::app()->db;
            /*$query = "SELECT * FROM hmo_form";
            $command=$connection->createCommand($query);
                $datareader=$command->query();
                if ($datareader){                              
                     foreach($datareader as $key => $value ) {
                     foreach($datareader as $array ) {
                        print_r($array);echo '<br/>'; 
                     }
                } 
                
                $query = "SELECT * FROM hmo_form_items";
            $command=$connection->createCommand($query);
                $datareader=$command->query();
                if ($datareader){                              
                     foreach($datareader as $key => $value ) {
                     foreach($datareader as $array ) {
                        print_r($array);echo '<br/>'; 
                     }
                } */        
            if($_GET['start']){
                $dstart = $_GET["start"];
            }
            if($_GET['end']){
                $dend   = $_GET["end"];
            }
            if($_GET['paid']){
                $paid   = $_GET["paid"];
            }
            if($_GET['trnx']){
                $task   = $_GET['trnx'];
            }
             
            $search = 
            $_GET['hmo_company']
            ||$_GET['avail_date']
            ||$_GET['claim_doctor_name']
            ||$_GET['med_service']
            ||$_GET['patient_name']
            ||$_GET['payable_to']
            ||$_GET['check_number']
            ||$_GET['check_date']
            ;

                $query[] =  "select hfi.itemid, hfi.hmo_form_id, hf.hmo_name, hf.patient_name, hca.paid_amnt, hfi.payto,
                            hf.avail_date, hfi.claim_doctor_name, hfi.med_service,
                            hfi.charge_fee, hca.wtax, hca.loss, hca.hmo_xces, hca.provider_xces,
                            hc.check_no, hc.check_date
                            from hmo_form_items hfi       
                            left join hmo_form hf      
                            on hfi.hmo_form_id = hf.id
                            left join hmoar_chkapply hca
                            on hfi.itemid = hca.form_itemid
                            left join hmoar_checks hc
                            on hca.check_id = hc.checkid  
                            left join hmo_billing hb
                            on hf.hmo_billing_id = hb.id                        
                            where 
                            hfi.payto = 'WPCLINIC'
                            and
                            hb.date_prepared     
                            between '$dstart' and '$dend'";
                    if($paid==1){
                        $query[]="
                        and hfi.itemid in (SELECT form_itemid from hmoar_chkapply)
                        ";
                    }
                    if($paid==0&&$_GET['paid']!=''){
                        $query[]="
                        and hfi.itemid not in (SELECT form_itemid from hmoar_chkapply)
                        ";
                    }             
                            
                if(!$search){         
                }else{
                if($_GET['hmo_company']!=''){
                $hmo_company = $_GET['hmo_company'];
                $query[] = "and hf.hmo_name like '%".$hmo_company."%'";
                }
                
                if($_GET['avail_date']!=''){
                $avail_date = $_GET['avail_date'];
                $query[] = "and hf.avail_date = '$avail_date'";
                }
                
                if($_GET['claim_doctor_name']){
                $claim_doctor_name = $_GET['claim_doctor_name'];
                $query[] = "and hfi.claim_doctor_name like '%".$claim_doctor_name."%'";
                }
                if($_GET['med_service']){
                $med_service = $_GET['med_service'];
                $query[] = "and hfi.med_service like '%".$med_service."%'";
                }
                if($_GET['patient_name']){
                $patient_name = $_GET['patient_name'];
                $query[] = "and hf.patient_name like '%".$patient_name."%'";
                }
                if($_GET['payable_to']){
                $payable_to = $_GET['payable_to'];
                $query[] = "and hfi.payto like '%".$payable_to."%'";
                }
                if($_GET['check_number']){
                $check_number = $_GET['check_number'];
                $query[] = "and hc.check_no = '$check_number'";
                }
                if($_GET['check_date']){
                $check_date = $_GET['check_date'];
                $query[] = "and hc.check_date = '$check_date'";
                }
                    
                    
                }       
                              
                $query[] ='order by hfi.itemid';
                $query[] ='limit 1';
                $query = implode(' ',$query);
                $command=$connection->createCommand($query);
                $datareader=$command->query();
                if ($datareader){
                    $table = "<table border='1' style='width:200px;'>";
                    $table .="<tr><td>Itemid</td><td>Hmo Form</td><td>Hmo Company</td><td>Patient Name</td><td>Payable To</td><td>Availment Date</td><td>Doctor</td><td>Services</td><td>Charge Fee</td><td>Paid</td><td>Wtax</td><td>Loss</td><td>Unpaid</td><td>Hmo Excess</td><td>Provider Excess</td><td>Check Number</td><td>Check Date</td></tr>";
                    foreach($datareader as $key => $value ) { 
                        $table .="<tr>";
                        $table .="<tr><td>Itemid</td><td>Hmo Form</td><td>Patient Name</td><td>Payable To</td><td>Availment Date</td><td>Doctor</td><td>Services</td><td>Charge Fee</td><td>Paid</td><td>Wtax</td><td>Loss</td><td>Unpaid</td><td>Hmo Excess</td><td>Provider Excess</td><td>Check Number</td><td>Check Date</td></tr>";
                        $table .= '<td>'.$value['itemid'].'</td><td>'.$value['hmo_form_id'].'</td><td>'
                        .$value['hmo_name'].'</td><td>'
                        .$value['patient_name'].'</td><td>'.$value['payto'].'</td><td>'.$value['avail_date'].'</td><td>'
                        .$value['claim_doctor_name'].'</td><td>'.$value['med_service'].'</td><td>'.$value['charge_fee']
                        .'</td><td>'.$value['paid_amnt'].'</td><td>'.$value['wtax'].'</td><td>'.$value['loss'].'</td>
                        <td>'.($value['charge_fee']-($value['paid_amnt']+$value['wtax']+$value['loss'])).
                        '</td><td>'.$value['hmo_xces'].'</td><td>'.$value['provider_xces'].'</td><td>'
                        .$value['check_no'].'</td><td>'.$value['check_date'].'</td>';
                         $table .="</tr>";  
                    }
                    $table .= "</table>";
                }
                
                $string[] = str_replace('-','_',$dstart);
                $string[] = '_';
                $string[] = str_replace('-','_',$dend);
                $string = implode('',$string);

                $filename ='wptrnx'.$string;
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-Disposition: attachment; filename=$filename.xls");
                echo $table;   
    }    
     
     
     


}
?>
