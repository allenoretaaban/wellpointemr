<?php
  
            $dstart  = $_GET["start"];
            $dend  = $_GET["end"];
            $toexcel = $_GET["toexcel"];

            $connection=Yii::app()->db; 

            //get checks for the period
            $query = "select a.form_itemid, a.check_id, a.paid_amnt, a.wtax, a.doc_tax, a.provider_xces, a.member_xces,
                    b.check_no, b.check_date, b.check_amnt, b.payto, c.name, d.claim_doctor_id , e.lastname, e.firstname
                     from hmoar_chkapply a
                     left join hmoar_checks b
                     on a.check_id = b.checkid
                     left join hmo c
                     on b.hmo_id = c.id
                     left join hmo_form_items d
                     on a.form_itemid = d.itemid
                     left join doctor e
                     on d.claim_doctor_id = e.id
                     where b.payto = 'WPCLINIC'  and
                     d.payto = 'DOCTOR' and
                     b.entry_date between '$dstart' and '$dend'
                     order by e.lastname asc, e.firstname asc, a.check_id asc, c.name
                     ";
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            $checks  = array();
            if ($datareader){
                foreach($datareader as $recd) {         
                    $checks[] = $recd;     
                }
            }

            if (count($checks) == 0){
                echo "No result found";return;
            }

            $contents = "";
            $run_wtax = 0;
            $run_gross = 0;
            $run_doctax = 0;
            $run_net = 0;
            $fee_total = 0;
            $excess_total = 0;
            $approve_total = 0;
            
            foreach ($checks as $chk){
                 //get doctor
                 $doctor_name = $chk["lastname"]. " ".$chk["firstname"]; 
                 /*$query = "select * from doctor where id = ".$chk["claim_doctor_id"]. " limit 1";
                  $command=$connection->createCommand($query);
                    $datareader=$command->query();
                    if ($datareader){
                        foreach($datareader as $recd) {
                            $doctor_name = $recd["firstname"]. " ".$recd["lastname"]; 
                        }
                    }                                                                            */
                     
                  //get form tranx
                  $query = "select a.itemid, a.hmo_form_id, a.payto,a.med_service, a.charge_fee, b.avail_date,
                                        b.patient_name 
                                        from hmo_form_items a
                                        left join hmo_form b
                                        on a.hmo_form_id = b.id
                                        where a.itemid = ".$chk["form_itemid"].
                                        " order by b.patient_name asc";
                  $command=$connection->createCommand($query);
                    $datareader=$command->query();
                    if ($datareader){
                        foreach($datareader as $recd) {
                            $frmtrnx = $recd; 
                        }
                    }
                    $excess = floatval($chk["provider_xces"]) + floatval($chk["member_xces"]);
                    $approved =  floatval($frmtrnx["charge_fee"]) - $excess ;
                    $net_fee  = (floatval($approved) - floatval($chk["wtax"])) - floatval($chk["doc_tax"]);
                    
                    $run_wtax += floatval($chk["wtax"]);
                    $run_gross += floatval($chk["paid_amnt"]);
                    $run_doctax += floatval($chk["doc_tax"]);
                    $run_net += $net_fee;        
                    
                    $fee_total += floatval($frmtrnx["charge_fee"]);
                    $excess_total += $excess;
                    $approve_total += $approved;
                      
                    $contents .=  "<tr>
                                <td>".strtoupper($doctor_name)."</td>
                                <td>".$chk["name"]."</td>
                                <td>".$chk["check_no"]."</td>
                                <td>".$chk["check_date"]."</td>
                                <td>".$frmtrnx["patient_name"]."</td>
                                <td>".$frmtrnx["med_service"]."</td>
                                <td>".$frmtrnx["avail_date"]."</td>
                                <td class='money'>".number_format($frmtrnx["charge_fee"],2)."</td>
                                <td class='money'>".number_format($excess, 2)."</td>
                                <td class='money'>".number_format($approved, 2)."</td>
                                <td class='money'>".number_format($chk["wtax"],2)."</td>
                                <td class='money'>".number_format($chk["paid_amnt"],2)."</td>
                                
                                <td class='money'>".number_format($chk["doc_tax"],2)."</td>
                                <td class='money'>".number_format($net_fee,2)."</td>
                                
                                </tr>    "    ;     
                
            }
            
            $print = implode("", file(Yii::app()->getBasePath().'/modules/hmoarreports/includes/printhmoalldocs.html'));
            //$print = implode("", file(Yii::app()->getBasePath().'\modules\hmoarreports\includes\printhmoalldocs.html'));
             $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
             $print = str_replace("[logopath]",$logo,$print);
             $print = str_replace("[datestart]",$dstart,$print);
             $print = str_replace("[dateend]",$dend,$print);
             $print = str_replace("[fee_total]",number_format($fee_total, 2),$print);
             $print = str_replace("[excess_total]",number_format($excess_total, 2),$print);
             $print = str_replace("[approve_total]",number_format($approve_total, 2),$print);
             $print = str_replace("[run_wtax]",number_format($run_wtax, 2),$print);
             $print = str_replace("[run_gross]",number_format($run_gross, 2),$print);
             $print = str_replace("[run_doctax]",number_format($run_doctax, 2),$print);
             $print = str_replace("[run_net]",number_format($run_net, 2),$print);
             $profile=Yii::app()->getModule('user')->user()->profile;                
             $prepared_by = $profile->first_name.' '.$profile->last_name; 
             $print = str_replace("[preparedy_by]",$prepared_by,$print);
             
             $print = str_replace("[contents]",$contents,$print);
             if ($toexcel == "1"){
                    $filename = "HmoChecksAllDoctors";
                    header("Content-Disposition: attachment; filename=\"$filename\""); 
                    header("Content-Type: application/vnd.ms-excel");
                    echo $print;
            }else{
                echo "<button class='noprint' onclick=\"window.location = 'bcreport?task=hmoalldocs_generate&start=$dstart&end=$dend&toexcel=1'\" value='' >Export to Excel</button>";
                echo $print;
            }
                                     
            
?>