<?php
include ("wdbconfig.php"); 

include ("objects.php");

if (!$_GET["a"]){
    echo "0:error on request";
    return;
}

$act = $_GET["a"];
$percenttax = $_GET["p"];
switch ($act){
    
    case "checkid":
        $check_no = $_GET['check_no'];                   
        
        $query  = "select * 
        from hmoar_checks
        where check_no = '$check_no'";
        $query = mysql_query($query) ;
        $data = mysql_fetch_assoc($query);
        echo $data['checkid'];   
    break;
    case "searchUnapplied":
        $soa = $_GET['soa'];  
        $cw_total = $_GET['cw_total'];                
        
        $query  = "select * 
        from hmo_form_items 
        where hmo_form_id in (
        select id from hmo_form where hmo_billing_id = '$soa'
        ) and isapplied = 0 and charge_fee <= '$cw_total' 
        ORDER BY charge_fee ASC";
        $query = mysql_query($query) ;
        $data = mysql_fetch_assoc($query);
        echo json_encode($data);   
    break;
    case "checkbilled":
        $soa = $_GET['soa'];                   
        
        $query  = "select sum(charge_fee) as bill 
        from hmo_form_items 
        where hmo_form_id in (
        select id from hmo_form where hmo_billing_id = '$soa'
        ) and isapplied = 0";
        $query = mysql_query($query) ;
        $data = mysql_fetch_assoc($query);
        echo $data['bill'];   
    break;
    case "countcheckbilled":
        $soa = $_GET['soa'];                   
        
        $query  = "select itemid as bill 
        from hmo_form_items 
        where hmo_form_id in (
        select id from hmo_form where hmo_billing_id = '$soa'
        ) and isapplied = 0";
        $query = mysql_query($query) ;
        $data = mysql_num_rows($query);
        echo $data;   
    break;
    
    case "ApplyToAll":
        //$itemid = $_GET["itemid"];
    
    break;
    case "DisApply":
        $item_id = $_GET["itemid"];
        
        $query = "DELETE FROM hmoar_chkapply WHERE form_itemid = $item_id";
        $qresult = mysql_query($query) ;        
        
        $query  = "UPDATE hmo_form_items
                    SET isapplied = 0,item_update_date = NOW()
                    WHERE itemid = ". $item_id;
        $xqresult = mysql_query($query) ;           
            
        echo "Disapplied!";
        
    break;
    case "wtax":
        if($percenttax == "2"){
            $query = "SELECT value FROM hmoar_settings WHERE settings='default_value'";
            $query2 = mysql_query($query);
            $value = mysql_fetch_assoc($query2);
            $percent = $value["value"]/100;
        }else{
            $percent = $percenttax/100;
        }
        $wtax = $_GET['fee'] * $percent;         
        echo $wtax;
    break;
    case "SaveApply":
            $params = explode("|",$_GET["params"]);

            $form_itemid = $params[0];
            $apply_amnt = floatval($params[1]);
            $apply_tax = floatval($params[2]);
            $check_id= $params[3];
            $provider_xces = floatval($params[4]);
            $member_xces = floatval($params[5]);
            $hmo_xces = floatval($params[6]);
            $hmo_xces_rem = $params[7];
            
            $query = "select a.itemid, a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.diagnosis, 
                        a.med_service, a.service_type, a.charge_type, a.charge_fee, 
                        b.hmo_billing_id, b.hmo_name, b.patient_name, b.avail_date, b.entry_date 
                        from hmo_form_items a 
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where a.itemid = $form_itemid
                        limit 1
                    ";
            $qresult = mysql_query($query) ;                 
            $qerror = mysql_error();
            while ( $trnx = mysql_fetch_array($qresult)) 
            {
                $hmo_trnx = $trnx;
            }
            $charge_fee = floatval($hmo_trnx["charge_fee"]);
            $loss = $charge_fee - ($apply_amnt + $apply_tax);
            
            /*if (floatval($loss) < 0){
                echo "false";
                return;
            }      */
            
            $ref_doc_id = intval($hmo_trnx["claim_doctor_id"]);
            switch($ref_doc_id){
                case 4:
                case 27:
                case 13:
                    $wtaxperc = 0.10;
                    break;
                default:
                    $wtaxperc = 0.15;
                    break;
            }
            $doc_tax = 0;
			$net_fee = 0;
            if ($hmo_trnx["payto"] == 'DOCTOR'){
                $doc_tax =  floatval($apply_amnt) * $wtaxperc;
                $net_fee  = floatval($apply_amnt) - $doc_tax;
            }
			
			
            
            $query  = "INSERT INTO hmoar_chkapply 
                    (`form_itemid`, `check_id`, `paid_amnt`, `wtax`, `loss`, date_applied, provider_xces, member_xces, hmo_xces, hmo_xces_rem, doc_tax, net_fee) 
                    VALUES ($form_itemid, $check_id, $apply_amnt, $apply_tax, $loss, NOW(), $provider_xces, $member_xces, $hmo_xces, '$hmo_xces_rem', $doc_tax, $net_fee )";
            $qresult = mysql_query($query) ;  
            
             
            
            
            if ($qresult == false){
                //echo "false";
				echo mysql_error();
            }else{
				$query  = "UPDATE hmo_form_items
                    SET isapplied = 1,item_update_date = NOW()
                    WHERE itemid = ". $form_itemid;
				$xqresult = mysql_query($query) ;                  
				echo "Saved!";    
            }           
        
    break;
    
    case "GetCheckPaidTrnxs":
          $context = $_GET;    
          $checkid = $_GET["checkid"]; 
          $pid = $_GET["pid"]; 
          if ($checkid == "undefined"){ return; }
        
          $page = $_GET["page"];   //page no.
          $rows = $_GET["rows"];   // no of rows per page
          $sidx = $_GET["sidx"];  //sort by id        
          $sord = $_GET["sord"];  //sort order 
                          
          $totalRecords = 0;    
            if($_search){  
                $filterString  = "" ;    
            }
            
            $result = new JQGridResults();  
            
            if (intval($page) <= 1){
                $page = 1;
            }
            $startpoint = ($page * $rows) - $rows;
            
            /*select a.itemid, a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, 
                        a.diagnosis, a.med_service, a.service_type, a.charge_type, a.charge_fee, 
                        b.hmo_billing_id, b.hmo_name, b.patient_name, b.avail_date, b.entry_date, a.isapplied,
                        c.firstname, c.lastname, c.middleinitial   */
            
            $and_where = "";
            if ($_GET["pid"]){
                $and_where = "AND c.patient_id = ".$pid;
            }
                      
            $query = "select b.*,a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, 
                        a.diagnosis, a.med_service, a.service_type, a.charge_type, a.charge_fee, a.isapplied,
                        c.hmo_billing_id, c.hmo_name, c.patient_name, c.avail_date, c.entry_date , d.firstname, d.lastname
                        from hmoar_chkapply b
                        left join hmo_form_items a
                        on b.form_itemid = a.itemid
                        left join hmo_form c
                        on a.hmo_form_id = c.id
                        left join patient d
                        on c.patient_id = d.id
                        where  b.check_id = $checkid
                        $and_where
                        order by d.lastname asc
                        limit $startpoint, $rows
                    ";
            $qresult = mysql_query($query) ;                 
            $qerror = mysql_error();
            
              $result = new JQGridResults(); 
            
            if(!$qresult || mysql_num_rows($qresult) == 0){    
                    $result->rows = '';      
                    $result->page = 0;
                    $result->total = 0;
                    $result->records = 0;    
                    $json_out = json_encode($result);  
            }else{
                $trnxs = array();
                while ( $trnx = mysql_fetch_array($qresult)) 
                {
                    $trnxtemp = new Trnx();
                    $trnxtemp->itemid = $trnx["form_itemid"];
                    $trnxtemp->payto = $trnx["payto"];
                    $trnxtemp->hmo_name = $trnx["hmo_name"];
                    $trnxtemp->patient_name = $trnx["lastname"].", ".$trnx["firstname"];
                    $trnxtemp->claim_doctor_name = $trnx["claim_doctor_name"];
                    $trnxtemp->med_service = $trnx["med_service"];
                    $trnxtemp->charge_type = $trnx["charge_type"];
                    $trnxtemp->charge_fee = number_format($trnx["charge_fee"], 2);
                    $trnxtemp->avail_date = $trnx["avail_date"];
                    $trnxtemp->entry_date = $trnx["entry_date"];
                    $trnxtemp->paid_amnt =  $trnx["paid_amnt"];
                    $trnxtemp->wtax =  $trnx["wtax"];
                    $trnxtemp->isapplied =  $trnx["isapplied"];
                    $trnxtemp->hmo_billing_id = $trnx["hmo_billing_id"];
                    $trnxtemp->hmo_xces_rem =   $trnx["hmo_xces_rem"];
                    
                    $trnxtemp->paid_details =  $trnxtemp->patient_name ."<br/>".
                                        "<small>(".$trnxtemp->hmo_name.")</small> <br/>".
                                        "Service: ".$trnxtemp->med_service ."<br/>".
                                        "Availed: ".$trnxtemp->avail_date ."<br/>".
                                        "(ChargeType: ".$trnxtemp->charge_type." )"."<br/>".
                                        "(Doctor: ".$trnxtemp->claim_doctor_name." )" 
                                        ;
                                        
                    $trnxtemp->paid_charge  =  $trnxtemp->charge_fee ."<br/>".
                                                 "(Payto: ".$trnxtemp->payto ." ) <br/>".
                                                 "Encoded: ".$trnxtemp->entry_date  ;
                    
                    $trnxtemp->paid_applied = "Applied amnt: ".$trnx["paid_amnt"]. "<br/>".
                                                "Wtax applied: ".$trnx["wtax"]. "<br/>".
                                                "Diff: ".$trnx["loss"]. "<br/>".
                                                "Provider Xces: ".$trnx["provider_xces"]. "<br/>".
                                                "Member Xces: ".$trnx["member_xces"]. "<br/>".
                                                "Doc Tax: ".$trnx["doc_tax"]
                                                ;
                    /*$trnxtemp->paid_applied = "Applied amnt: ".$trnx["paid_amnt"]. "<br/>".
                                                "Wtax applied: ".$trnx["wtax"]. "<br/>".
                                                "Diff: ".$trnx["loss"]. "<br/>".
                                                "Provider Xces: ".$trnx["provider_xces"]. "<br/>".
                                                "Member Xces: ".$trnx["member_xces"]. "<br/>".
                                                "Hmo Xces: ".$trnx["hmo_xces"]. "<br/>".
                                                "Hmo Xces Rem: <br/>".$trnx["hmo_xces_rem"]
                                                ;                                          */
                                                 
                    $trnxs[] = $trnxtemp;
                }
                
                if ($trnxs){
                $rows = array(); 
                foreach($trnxs as $utrnx){
                            $ccount = 0;
                            $row = new JQGridRow();
                            $row->id = $utrnx->itemid;
                            $cell = array();
                            $cell[$ccount] = $utrnx->itemid  ;                           
                            $ccount++;
                            $cell[$ccount] = $utrnx->patient_name;
                            $ccount++;
                            $cell[$ccount] = $utrnx->hmo_name;   
                            $ccount++;
                            $cell[$ccount] = $utrnx->payto;
                            $ccount++;
                            
                            $cell[$ccount] = $utrnx->claim_doctor_name;
                            $ccount++;
                            $cell[$ccount] = $utrnx->med_service;
                            $ccount++;
                            /*$cell[$ccount] = $utrnx->charge_type;
                            $ccount++;     */
                            $cell[$ccount] = $utrnx->charge_fee;
                            $ccount++;
                            $cell[$ccount] = $utrnx->avail_date;
                            $ccount++;
                            $cell[$ccount] = $utrnx->entry_date;
                            $ccount++;
                            /*$cell[10] = $utrnx->detail_patient;
                            $cell[11] = $utrnx->detail_service;
                            $cell[12] = $utrnx->detail_charge;*/
                            $cell[$ccount] = $utrnx->paid_amnt;
                            $ccount++;
                            $cell[$ccount] = $utrnx->wtax;
                            $ccount++;
                            $cell[$ccount] = $utrnx->provider_xces;
                            $ccount++;
                            $cell[$ccount] = $utrnx->member_xces;
                            $ccount++;
                            $cell[$ccount] = $utrnx->hmo_xces;
                            $ccount++;
                            $cell[$ccount] = $utrnx->isapplied;
                            $ccount++;               
                            if ($utrnx->hmo_xces_rem != "undefined"){
                                $cell[$ccount] = $utrnx->hmo_xces_rem;
                                $ccount++;    
                            }else{
                                $cell[$ccount] = "&nbsp;";    
                                $ccount++;  
                            }
                            
                            $cell[$ccount] = $utrnx->hmo_billing_id;
                            $ccount++;      
                            $cell[$ccount] = $utrnx->apply_checkno;
                            $ccount++;
                            $cell[$ccount] = $utrnx->apply_bank;
                            $ccount++;
                            
                            
                            
                            $row->cell = $cell;
                            $rows[] = $row;   
                    }
                    $result->rows = $rows;      
                    $result->page = $page;
                    $result->total = count($trnxs);
                    $result->records = count($trnxs);    
                    
                    $json_out = json_encode($result);    
                }else{
                    $result->rows = '';      
                    $result->page = 0;
                    $result->total = 0;
                    $result->records = 0;    
                    $json_out = json_encode($result);    
                }                
                
            }
            
             echo $json_out;
            
    break; 
    
    case "GetPaidTrnxs":
          $context = $_GET;    
          $checkid = $_GET["checkid"]; 
          if ($checkid == "undefined"){ return; }
        
          $page = $_GET["page"];   //page no.
          $rows = $_GET["rows"];   // no of rows per page
          $sidx = $_GET["sidx"];  //sort by id        
          $sord = $_GET["sord"];  //sort order 
                          
          $totalRecords = 0;    
            if($_search){
                $filterString  = "" ;    
            }
            
            $result = new JQGridResults();  
            
            if (intval($page) <= 1){
                $page = 1;
            }
            $startpoint = ($page * $rows) - $rows;
                      
            $query = "select b.*,a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.diagnosis, a.med_service, a.service_type, a.charge_type, a.charge_fee,
                        c.hmo_billing_id, c.hmo_name, c.patient_name, c.avail_date, c.entry_date
                        from hmoar_chkapply b
                        left join hmo_form_items a
                        on b.form_itemid = a.itemid
                        left join hmo_form c
                        on a.hmo_form_id = c.id
                        where  b.check_id = $checkid
                        limit $startpoint, $rows
                    ";
            $qresult = mysql_query($query) ;                 
            $qerror = mysql_error();
            
              $result = new JQGridResults(); 
            
            if(!$qresult || mysql_num_rows($qresult) == 0){    
                    $result->rows = '';      
                    $result->page = 0;
                    $result->total = 0;
                    $result->records = 0;    
                    $json_out = json_encode($result);  
            }else{
                $trnxs = array();
                while ( $trnx = mysql_fetch_array($qresult)) 
                {
                    $trnxtemp = new Trnx();
                    $trnxtemp->itemid = $trnx["form_itemid"];
                    $trnxtemp->payto = $trnx["payto"];
                    $trnxtemp->hmo_name = $trnx["hmo_name"];
                    $trnxtemp->patient_name = $trnx["patient_name"];
                    $trnxtemp->claim_doctor_name = $trnx["claim_doctor_name"];
                    $trnxtemp->med_service = $trnx["med_service"];
                    $trnxtemp->charge_type = $trnx["charge_type"];
                    $trnxtemp->charge_fee = number_format($trnx["charge_fee"], 2);
                    $trnxtemp->avail_date = $trnx["avail_date"];
                    $trnxtemp->entry_date = $trnx["entry_date"];
                    
                    $trnxtemp->paid_details =  $trnxtemp->patient_name ."<br/>".
                                        "<small>(".$trnxtemp->hmo_name.")</small> <br/>".
                                        "Service: ".$trnxtemp->med_service ."<br/>".
                                        "Availed: ".$trnxtemp->avail_date ."<br/>".
                                        "(ChargeType: ".$trnxtemp->charge_type." )"."<br/>".
                                        "(Doctor: ".$trnxtemp->claim_doctor_name." )" 
                                        ;
                                        
                    $trnxtemp->paid_charge  =  $trnxtemp->charge_fee ."<br/>".
                                                 "(Payto: ".$trnxtemp->payto ." ) <br/>".
                                                 "Encoded: ".$trnxtemp->entry_date  ;
                    
                    $trnxtemp->paid_applied = "Applied amnt: ".$trnx["paid_amnt"]. "<br/>".
                                                "Wtax applied: ".$trnx["wtax"]. "<br/>".
                                                "Diff: ".$trnx["loss"]. "<br/>".
                                                "Provider Xces: ".$trnx["provider_xces"]. "<br/>".
                                                "Member Xces: ".$trnx["member_xces"]. "<br/>".
                                                "Doc Tax: ".$trnx["doc_tax"]
                                                ;
                    /*$trnxtemp->paid_applied = "Applied amnt: ".$trnx["paid_amnt"]. "<br/>".
                                                "Wtax applied: ".$trnx["wtax"]. "<br/>".
                                                "Diff: ".$trnx["loss"]. "<br/>".
                                                "Provider Xces: ".$trnx["provider_xces"]. "<br/>".
                                                "Member Xces: ".$trnx["member_xces"]. "<br/>".
                                                "Hmo Xces: ".$trnx["hmo_xces"]. "<br/>".
                                                "Hmo Xces Rem: <br/>".$trnx["hmo_xces_rem"]
                                                ;                                          */
                                                 
                    $trnxs[] = $trnxtemp;
                }
                
                if ($trnxs){
                $rows = array(); 
                foreach($trnxs as $utrnx){
                            $row = new JQGridRow();
                            $row->id = $utrnx->itemid;
                            $cell = array();
                            $cell[0] = $utrnx->itemid  ;                           
                            $cell[1] = $utrnx->payto;
                            $cell[2] = $utrnx->hmo_name;
                            $cell[3] = $utrnx->patient_name;
                            $cell[4] = $utrnx->claim_doctor_name;
                            $cell[5] = $utrnx->med_service;
                            $cell[6] = $utrnx->charge_type;
                            $cell[7] = $utrnx->charge_fee;
                            $cell[8] = $utrnx->avail_date;
                            $cell[9] = $utrnx->entry_date;
                            $cell[10] = $utrnx->paid_details;
                            $cell[11] = $utrnx->paid_charge;
                            $cell[12] = $utrnx->paid_applied;
                           
                            $row->cell = $cell;
                            $rows[] = $row;   
                    }
                    $result->rows = $rows;      
                    $result->page = $page;
                    $result->total = count($trnxs);
                    $result->records = count($trnxs);    
                    
                    $json_out = json_encode($result);    
                }else{
                    $result->rows = '';      
                    $result->page = 0;
                    $result->total = 0;
                    $result->records = 0;    
                    $json_out = json_encode($result);    
                }                
                
            }
            
             echo $json_out;
            
    break;     
    
     case "GetHmoTrnxs":
          $context = $_GET;    
          $bid = $_GET["bid"]; 
          $pid = $_GET["pid"]; 
          if ($bid == "undefined"){ return; }
          $hmo_id = $_GET["hid"];
          $page = $_GET["page"];   //page no.
          $rows1 = $_GET["rows"];   // no of rows per page
          $sidx = $_GET["sidx"];  //sort by id        
          $sord = $_GET["sord"];  //sort order 
                          
          $totalRecords = 0;    
            if($_search){
                $filterString  = "" ;    
            }
            
            $result = new JQGridResults();  
            
            if (intval($page) <= 1){
                $page = 1;
            }
            $startpoint = ($page * $rows1) - $rows1;
            
            $and_where = "";
            if ($_GET["pid"]){
                $and_where = "AND b.patient_id = ".$pid;
            }
            
                      
           /* $query = "select a.itemid, a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.diagnosis, a.med_service, a.service_type, a.charge_type, a.charge_fee, 
                        b.hmo_billing_id, b.hmo_name, b.patient_name, b.avail_date, b.entry_date 
                        from hmo_form_items a 
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where b.hmo_id = $hmo_id  and
                        b.hmo_billing_id > 0 and 
                        b.patient_id = $pid  and 
                        isapplied = 0
                        limit $startpoint, $rows
                    ";
                                                          */
           $query = "select a.itemid, a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, 
                        a.diagnosis, a.med_service, a.service_type, a.charge_type, a.charge_fee, 
                        b.hmo_billing_id, b.hmo_name,b.patient_id, b.patient_name, b.avail_date, b.entry_date, a.isapplied,
                        c.firstname, c.lastname, c.middleinitial
                        from hmo_form_items a 
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        left join patient c
                        on b.patient_id = c.id
                        where b.hmo_billing_id = $bid
                        $and_where
                        order by a.isapplied asc,c.lastname asc                    
                        limit $startpoint, $rows1
                    ";
            $qresult = mysql_query($query) ;                 
            $qerror = mysql_error();
            
            $result = new JQGridResults(); 
            
            $i = mysql_num_rows($qresult);
            
            if(!$qresult || mysql_num_rows($qresult) == 0){    
                    $result->rows = '';      
                    $result->page = 0;
                    $result->total = 0;
                    $result->records = 0;    
                    $json_out = json_encode($result);  
            }else{
                $trnxs = array();
                while ( $trnx = mysql_fetch_array($qresult)) 
                {
                    $trnxtemp = new Trnx();
                    $trnxtemp->itemid = $trnx["itemid"];
                    $trnxtemp->patient_name = $trnx["lastname"]. ", ". $trnx["firstname"]. " (".$trnx["patient_id"].")";
                    $trnxtemp->payto = $trnx["payto"];
                    $trnxtemp->hmo_name = $trnx["hmo_name"];
                    
                    $trnxtemp->claim_doctor_name = $trnx["claim_doctor_name"] ."<br/>". preg_replace("/'/", "", $trnx["med_service"]) ."<br/>". $trnx["avail_date"];
                    //$trnxtemp->claim_doctor_name = $trnx["claim_doctor_name"] ;
                    //$trnxtemp->med_service = preg_replace("/'/", "", $trnx["med_service"]);
                    $trnxtemp->charge_type = $trnx["charge_type"];
                    $trnxtemp->charge_fee = number_format($trnx["charge_fee"], 2);
                    //$trnxtemp->avail_date = $trnx["avail_date"];
                    $trnxtemp->entry_date = $trnx["entry_date"];
                    
                    $trnxtemp->detail_patient =  $trnxtemp->patient_name ."<br/>".
                                        "(".$trnxtemp->hmo_name.")";
                                        
                    $trnxtemp->detail_service =  $trnxtemp->med_service ."<br/>".
                                        "Availed: ".$trnxtemp->avail_date ."<br/>".
                                        "(ChargeType: ".$trnxtemp->charge_type." )"."<br/>".
                                        "(Doctor: ".$trnxtemp->claim_doctor_name." )" 
                                        ;
                    
                    $trnxtemp->detail_charge  =  $trnxtemp->charge_fee ."<br/>".
                                                 "(Payto: ".$trnxtemp->payto ." ) <br/>".
                                                 "Encoded: ".$trnxtemp->entry_date  ;
                    
                    if ($trnx["isapplied"] == 1){
                        //get check no
                        $query = "select a.check_id,a.paid_amnt,a.wtax,a.provider_xces,a.member_xces,a.hmo_xces, b.check_no, c.bank_title 
                                    from hmoar_chkapply a
                                    left join hmoar_checks b
                                    on a.check_id = b.checkid
                                    left join hmoar_banks c
                                    on b.bank_id = c.bankid
                                    where a.form_itemid = ".$trnx["itemid"];
                         $qxresult = mysql_query($query) ;
                          while ( $check = mysql_fetch_array($qxresult)) 
                            {
                                $trnxtemp->apply_checkno = $check["check_no"];
                                $trnxtemp->apply_bank = $check["bank_title"];
                                $trnxtemp->paid_amnt = $check["paid_amnt"];
                                $trnxtemp->wtax = $check["wtax"];
                                $trnxtemp->provider_xces = $check["provider_xces"]; 
                                $trnxtemp->member_xces = $check["member_xces"];
                                $trnxtemp->hmo_xces = $check["hmo_xces"];                                   
                            }
                    }
                    
                    $trnxtemp->isapplied = $trnx["isapplied"];
                                                 
                    $trnxs[] = $trnxtemp;
                }
                
                if ($trnxs){
                $rows = array(); 
                
                foreach($trnxs as $utrnx){
                            $ccount = 0;
                            $row = new JQGridRow();
                            $row->id = $utrnx->itemid;
                            $cell = array();
                            $cell[$ccount] = $utrnx->itemid  ;                           
                            $ccount++;
                            $cell[$ccount] = $utrnx->patient_name;
                            $ccount++;
                            $cell[$ccount] = $utrnx->hmo_name;   
                            $ccount++;
                            $cell[$ccount] = $utrnx->payto;
                            $ccount++;
                            
                            $cell[$ccount] = $utrnx->claim_doctor_name;
                            $ccount++;
                            //$cell[$ccount] = $utrnx->med_service;
                            //$ccount++;
                            /*$cell[$ccount] = $utrnx->charge_type;
                            $ccount++;     */
                            $cell[$ccount] = $utrnx->charge_fee;
                            $ccount++;
                            //$cell[$ccount] = $utrnx->avail_date;
                            //$ccount++;
                            $cell[$ccount] = $utrnx->entry_date;
                            $ccount++;
                            /*$cell[10] = $utrnx->detail_patient;
                            $cell[11] = $utrnx->detail_service;
                            $cell[12] = $utrnx->detail_charge;*/
                            $cell[$ccount] = $utrnx->paid_amnt;
                            $ccount++;
                            $cell[$ccount] = $utrnx->wtax;
                            $ccount++;
                            $cell[$ccount] = $utrnx->provider_xces;
                            $ccount++;
                            $cell[$ccount] = $utrnx->member_xces;
                            $ccount++;
                            $cell[$ccount] = $utrnx->hmo_xces;
                            $ccount++;
                            $cell[$ccount] = $utrnx->isapplied;
                            $ccount++;
                            $cell[$ccount] = $utrnx->apply_checkno;
                            $ccount++;
                            $cell[$ccount] = $utrnx->apply_bank;
                           
                            $row->cell = $cell;
                            $rows[] = $row;   
                    }      
                    
                    $query = "select a.itemid, a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, 
                    a.diagnosis, a.med_service, a.service_type, a.charge_type, a.charge_fee, 
                    b.hmo_billing_id, b.hmo_name,b.patient_id, b.patient_name, b.avail_date, b.entry_date, a.isapplied,
                    c.firstname, c.lastname, c.middleinitial
                    from hmo_form_items a 
                    left join hmo_form b
                    on a.hmo_form_id = b.id
                    left join patient c
                    on b.patient_id = c.id
                    where b.hmo_billing_id = $bid
                    $and_where
                    ";
                    $qresult = mysql_query($query) ;      
                    $i = mysql_num_rows($qresult);
                    if($i){
                    $rows1 = count($rows);  
                    $page1 = count($page); 
                    $total = $i;
                    $records = $i; 
                    }else{
                    $rows1 = count($rows);  
                    $page1 = count($page); 
                    $total = count($trnxs);
                    $records = count($trnxs);
                    } 
                    $result->rows = $rows;      
                    $result->page = $page;
                    $result->total = round($total / $rows1);
                    $result->records = round($records / $rows1);    
                    
                    $json_out = json_encode($result);    
                }else{
                    $result->rows = '';      
                    $result->page = 0;
                    $result->total = 0;
                    $result->records = 0;    
                    $json_out = json_encode($result);    
                }                
                
            }
            
             echo $json_out;
    
    break;
       
    
    case "GetTrnxs":
          $context = $_GET;    
          $pid = $_GET["pid"]; 
          if ($pid == "undefined"){ return; }
          $hmo_id = $_GET["hid"];
          $page = $_GET["page"];   //page no.
          $rows = $_GET["rows"];   // no of rows per page
          $sidx = $_GET["sidx"];  //sort by id        
          $sord = $_GET["sord"];  //sort order 
                          
          $totalRecords = 0;    
            if($_search){
                $filterString  = "" ;    
            }
            
            $result = new JQGridResults();  
            
            if (intval($page) <= 1){
                $page = 1;
            }
            $startpoint = ($page * $rows) - $rows;
                      
           /* $query = "select a.itemid, a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.diagnosis, a.med_service, a.service_type, a.charge_type, a.charge_fee, 
                        b.hmo_billing_id, b.hmo_name, b.patient_name, b.avail_date, b.entry_date 
                        from hmo_form_items a 
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where b.hmo_id = $hmo_id  and
                        b.hmo_billing_id > 0 and 
                        b.patient_id = $pid  and 
                        isapplied = 0
                        limit $startpoint, $rows
                    ";
                                                          */
           $query = "select a.itemid, a.hmo_form_id, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.diagnosis, a.med_service, a.service_type, a.charge_type, a.charge_fee, 
                        b.hmo_billing_id, b.hmo_name, b.patient_name, b.avail_date, b.entry_date, a.isapplied
                        from hmo_form_items a 
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where b.hmo_id = $hmo_id  and
                        b.hmo_billing_id > 0 and 
                        b.patient_id = $pid  
                        limit $startpoint, $rows
                    ";
            $qresult = mysql_query($query) ;                 
            $qerror = mysql_error();
            
            $result = new JQGridResults(); 
            
            $i = mysql_num_rows($qresult);
            
            if(!$qresult || mysql_num_rows($qresult) == 0){    
                    $result->rows = '';      
                    $result->page = 0;
                    $result->total = 0;
                    $result->records = 0;    
                    $json_out = json_encode($result);  
            }else{
                $trnxs = array();
                while ( $trnx = mysql_fetch_array($qresult)) 
                {
                    $trnxtemp = new Trnx();
                    $trnxtemp->itemid = $trnx["itemid"];
                    $trnxtemp->payto = $trnx["payto"];
                    $trnxtemp->hmo_name = $trnx["hmo_name"];
                    $trnxtemp->patient_name = $trnx["patient_name"];
                    $trnxtemp->claim_doctor_name = $trnx["claim_doctor_name"];
                    $trnxtemp->med_service = preg_replace("/'/", "", $trnx["med_service"]);  ;
                    $trnxtemp->charge_type = $trnx["charge_type"];
                    $trnxtemp->charge_fee = number_format($trnx["charge_fee"], 2);
                    $trnxtemp->avail_date = $trnx["avail_date"];
                    $trnxtemp->entry_date = $trnx["entry_date"];
                    
                    $trnxtemp->detail_patient =  $trnxtemp->patient_name ."<br/>".
                                        "(".$trnxtemp->hmo_name.")";
                                        
                    $trnxtemp->detail_service =  $trnxtemp->med_service ."<br/>".
                                        "Availed: ".$trnxtemp->avail_date ."<br/>".
                                        "(ChargeType: ".$trnxtemp->charge_type." )"."<br/>".
                                        "(Doctor: ".$trnxtemp->claim_doctor_name." )" 
                                        ;
                    
                    $trnxtemp->detail_charge  =  $trnxtemp->charge_fee ."<br/>".
                                                 "(Payto: ".$trnxtemp->payto ." ) <br/>".
                                                 "Encoded: ".$trnxtemp->entry_date  ;
                    
                    if ($trnx["isapplied"] == 1){
                        //get check no
                        $query = "select a.check_id, b.check_no, c.bank_title 
                                    from hmoar_chkapply a
                                    left join hmoar_checks b
                                    on a.check_id = b.checkid
                                    left join hmoar_banks c
                                    on b.bank_id = c.bankid
                                    where a.form_itemid = ".$trnx["itemid"];
                         $qxresult = mysql_query($query) ;
                          while ( $check = mysql_fetch_array($qxresult)) 
                            {
                                $trnxtemp->apply_checkno = $check["check_no"];
                                $trnxtemp->apply_bank = $check["bank_title"];
                            }
                    }
                    
                    $trnxtemp->isapplied = $trnx["isapplied"];
                                                 
                    $trnxs[] = $trnxtemp;
                }
                
                if ($trnxs){
                $rows = array(); 
                foreach($trnxs as $utrnx){
                            $row = new JQGridRow();
                            $row->id = $utrnx->itemid;
                            $cell = array();
                            $cell[0] = $utrnx->itemid  ;                           
                            $cell[1] = $utrnx->payto;
                            $cell[2] = $utrnx->hmo_name;
                            $cell[3] = $utrnx->patient_name;
                            $cell[4] = $utrnx->claim_doctor_name;
                            $cell[5] = $utrnx->med_service;
                            $cell[6] = $utrnx->charge_type;
                            $cell[7] = $utrnx->charge_fee;
                            $cell[8] = $utrnx->avail_date;
                            $cell[9] = $utrnx->entry_date;
                            $cell[10] = $utrnx->detail_patient;
                            $cell[11] = $utrnx->detail_service;
                            $cell[12] = $utrnx->detail_charge;
                            $cell[13] = $utrnx->isapplied;
                            $cell[14] = $utrnx->apply_checkno;
                            $cell[15] = $utrnx->apply_bank;
                           
                            $row->cell = $cell;
                            $rows[] = $row;   
                    }
                    $result->rows = $rows;      
                    $result->page = $page;
                    $result->total = count($trnxs);
                    $result->records = count($trnxs);    
                    
                    $json_out = json_encode($result);    
                }else{
                    $result->rows = '';      
                    $result->page = 0;
                    $result->total = 0;
                    $result->records = 0;    
                    $json_out = json_encode($result);    
                }                
                
            }
            
             echo $json_out;
    
    break;
}


?>
