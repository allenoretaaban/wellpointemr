<?php

$dstart  = $_GET["start"];
$dend  = $_GET["end"];
$toexcel = $_GET["toexcel"];

$logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
$profile=Yii::app()->getModule('user')->user()->profile;                
$prepared_by = $profile->first_name.' '.$profile->last_name; 


$connection=Yii::app()->db; 

if ($toexcel == "1"){
    $filename = "HmoChecks";
    header("Content-Disposition: attachment; filename=\"$filename\""); 
    header("Content-Type: application/vnd.ms-excel");    
}



?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>WellPoint Reports</title>
    <style>
        body {font-family:arial;font-size:9pt}
        table {
            font-family:arial;font-size:9pt;
        }                                   
        td.money{text-align:right;padding: 0 3px;}
        table.sp tr td{
            padding: 0 3px;
        }
        div {font-family:arial;font-size:10pt}
        p {line-height: 13pt;}
        @media print {
              .noprint { display: none; }
            }
        @media print {
            thead { display: table-header-group; }
            tfoot { display: table-footer-group; }
        }
        @media screen {
            thead { display: block; }
            tfoot { display: block; }
        }
        .branch{font-size:7pt;text-align: center;}
        .underl{text-decoration: underline;font-family:arial;font-size:8pt}
        .title{color:#FF0000}
    </style>
</head>
<body>  
    <table>
           <thead>
                <tr><td>
                    <input type='button' class='noprint' onclick="window.location = 'bcreport?task=hmochecks_generate&start=<?php echo $dstart; ?>&end=<?php echo $dend; ?>&toexcel=1'" value='Export to Excel' >
                    <br/>
                   <input class='noprint' type='button' value='Print' onclick='window.print()' />
                   <div style="width:1100px;padding:0 10px 0 10px">
                   
                        <div align="center">                            
                                <table style="width:790px">
                                <tr >
                                    <td>
                                        <div class="branch"> 
                                            BACOOR BRANCH<br/>
                                            31 - 32 LGF SM City Bacoor,<br/>
                                            Tirona Cor. Aguinaldo Highway, Bacoor, Cavite<br/>
                                            Tel. No. (046) 970-1850 / Fax # (046) 970-1851
                                        </div>
                                    </td>
                                    <td style="text-align:center;" valign=top >
                                        <img src="<?php echo $logo; ?>" />
                                        <div>Medical Clinic and Diagnostic Center, Inc.</div>
                                    </td>
                                
                                    <td>
                                          <div class="branch"> 
                                               ROSARIO BRANCH<br/> 
                                                Unit 207-208 2nd Floor SM City Rosario,<br/> 
                                                Tejeros, Convention, Rosario, Cavite  <br/> 
                                                Tel. No. (046) 971-1839 / Fax #: 971-1838
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>    
                        
                   </div>
           
           </td></tr></thead>
           <tbody>
            <tr>
                <td><h1>HMO Collection - WellPoint Clinic Checks</h1></td>
            </tr>
            <tr>
                <td>Date Covered: <b><u><?php echo $dstart; ?></u></b> to <b><u><?php echo $dend; ?></u></b> </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                 <td>   
                     <div style="width:5000px;padding:0 0px 0 10px;margin-top:-10px">
                                <div id="body" align="left" style="width: 100%;display:table;" >
                                        <br/>
                                        <table class="sp" width="auto" cellpadding="5" style="border-width: 0px;border-spacing: 0px;border-style: outset;border-color: gray;" border="1px" cellpadding="0" cellspacing="0" >
                                            <tr >
                                                <th rowspan="2">HMO</th>
                                                <th rowspan="2">Check Date</th> 
                                                <th rowspan="2">Date Input</th> 
                                                <th rowspan="2">Check Number</th> 
                                                <th rowspan="2">Check Amount</th> 
                                                <th rowspan="2">Clinic's</th> 
                                                <th colspan="3">Doctors'</th>   
                                                <th>HMO Excess</th>
                                                <th rowspan="2">Billing Date</th>
                                            </tr>
                                            <tr>
                                                
                                                <td >HMO</td>
                                                <td >10% Tax</td>
                                                <td >SOA</td>
                                            </tr>
                                            <tr>
                                            <?php
                                            $check_total = 0;
                                            $clinic_total = 0;
                                            $dochmo_total = 0;
                                            $doch10perc_total = 0;
                                            $docsoa_total = 0;
                                            $hmoexces_total = 0;
                                            
                                            //get check received 
                                            $query = "SELECT a.checkid, a.check_no , a.entry_date, a.check_date, a.hmo_xces, a.bank_id, c.bank_title,
                                                            a.hmo_id, a.check_amnt,  b.name 
                                                            from hmoar_checks a
                                                            left join hmo b
                                                            on a.hmo_id = b.id
                                                            left join hmoar_banks c
                                                            on a.bank_id = c.bankid
                                                            where a.payto = 'WPCLINIC' and 
                                                            a.entry_date between '$dstart' and '$dend'
                                                            order by a.entry_date asc, b.name asc";  
                                            $command=$connection->createCommand($query);
                                            $datareader=$command->query();
                                            while(($row=$datareader->read())!==false) { 
                                                
                                                //get clinics total
                                                $query = "select sum(a.paid_amnt) as chktotal 
                                                            from hmoar_chkapply a
                                                            left join hmo_form_items b
                                                            on a.form_itemid = b.itemid
                                                            where a.check_id = ".$row["checkid"]."
                                                            and b.payto = 'WPCLINIC'";
                                                 $command=$connection->createCommand($query);
                                                $dr_clinic_chktot =$command->query();
                                                $clinic_chktot = '&nbsp;';
                                                while(($row_clinic_chktot = $dr_clinic_chktot ->read())!==false) { 
                                                    $clinic_total  += floatval($row_clinic_chktot["chktotal"]);
                                                    $clinic_chktot = number_format($row_clinic_chktot["chktotal"],2 );
                                                }
                                                
                                                // get hno total
                                                $query = "select sum(a.paid_amnt) as chktotal 
                                                            from hmoar_chkapply a
                                                            left join hmo_form_items b
                                                            on a.form_itemid = b.itemid
                                                            where a.check_id = ".$row["checkid"]."
                                                            and b.payto = 'DOCTOR'";
                                                 $command=$connection->createCommand($query);
                                                $dr_doc_chktot =$command->query();
                                                $doc_chktot = '&nbsp;';
                                                $doc_chktot_tax_str  = '&nbsp;';
                                                $doc_soa_str = '&nbsp;';
                                                
                                                while(($row_doc_chktot = $dr_doc_chktot ->read())!==false) { 
                                                    $dochmo_total  += floatval($row_doc_chktot["chktotal"]);
                                                    $doc_chktot = number_format($row_doc_chktot["chktotal"],2 );
                                                    
                                                    $doc_chktot_tax = floatval($row_doc_chktot["chktotal"]) * .1;
                                                    $doch10perc_total  += floatval($doc_chktot_tax);
                                                    
                                                    $doc_chktot_tax_str = number_format($doc_chktot_tax, 2);
                                                    $doc_soa = floatval($row_doc_chktot["chktotal"]) - $doc_chktot_tax;
                                                    $docsoa_total += floatval($doc_soa);
                                                    $doc_soa_str  = number_format($doc_soa, 2);
                                                }
                                                
                                                //get billing dates
                                                $from_date = '';
                                                $to_date = '';
                                                $show_date  = '&nbsp;';
                                                 $formitemids = '';
                                                
                                                //get FROM billing date
                                                $query = "select a.form_itemid from hmoar_chkapply a
                                                                    left join hmo_form_items b
                                                                    on a.form_itemid = b.itemid
                                                                    where a.check_id = ".$row["checkid"]."";
                                                $command=$connection->createCommand($query);
                                                $dr_tmp =$command->query();
                                                while(($row_tmp = $dr_tmp->read())!==false) { 
                                                    $formitemids[] = $row_tmp["form_itemid"];
                                                }
                                                
                                                
                                                
                                                if ($formitemids != "" ){
                                                    $formitemids = implode(",",$formitemids);
                                                    $query = "select h.hmo_billing_id, i.date_prepared
                                                                    from hmo_form_items g
                                                                    left join hmo_form h
                                                                    on g.hmo_form_id = h.id
                                                                    left join hmo_billing i
                                                                    on h.hmo_billing_id = i.id
                                                                    where g.itemid
                                                                    in
                                                                    (
                                                                    $formitemids
                                                                    )
                                                                    order by i.date_prepared asc
                                                                    limit 1
                                                                ";
                                                    $command=$connection->createCommand($query);
                                                    $dr_bill_from =$command->query();
                                                    while(($row_bill_from = $dr_bill_from ->read())!==false) { 
                                                        $from_date = $row_bill_from["date_prepared"];
                                                        $show_date = $from_date;
                                                    }
                                                    
                                                    //get TO billing date
                                                    $query = "select h.hmo_billing_id, i.date_prepared
                                                                        from hmo_form_items g
                                                                        left join hmo_form h
                                                                        on g.hmo_form_id = h.id
                                                                        left join hmo_billing i
                                                                        on h.hmo_billing_id = i.id
                                                                        where g.itemid
                                                                        in
                                                                        (
                                                                        $formitemids
                                                                        )
                                                                        order by i.date_prepared desc
                                                                        limit 1
                                                                    ";
                                                    $command=$connection->createCommand($query);
                                                    $dr_bill_to =$command->query();
                                                    while(($row_bill_to = $dr_bill_to ->read())!==false) { 
                                                        $to_date = $row_bill_to["date_prepared"];
                                                        if ($from_date != $to_date){
                                                            $show_date =  $from_date . " to ". $to_date;    
                                                        }
                                                        
                                                    }    
                                                }
                                                
                                                //hmo excess
                                                $hmoxces_str = "&nbsp;";
                                                if (floatval($row["hmo_xces"]) > 0){
                                                    $hmoexces_total += floatval($row["hmo_xces"]);
                                                    $hmoxces_str = number_format($row["hmo_xces"], 2);
                                                }
                                                
                                                echo "<tr> ";
                                                echo "<td>".$row["name"]."</td>
                                                        <td>".$row["check_date"]."</td>
                                                        <td>".date("Y-m-d", strtotime($row["entry_date"]))."</td>
                                                        
                                                        <td>".$row["check_no"]."</td>
                                                        <td class=money >".number_format($row["check_amnt"],2 )."</td>
                                                        <td class=money >".$clinic_chktot."</td>
                                                        <td class=money >".$doc_chktot."</td>
                                                        <td class=money >".$doc_chktot_tax_str."</td>
                                                        <td class=money >".$doc_soa_str."</td>
                                                        <td class=money >".$hmoxces_str."</td>
                                                        
                                                        <td class=money >".$show_date."</td>
                                                      ";  
                                                echo "</tr>";
                                                
                                                $check_total += floatval($row["check_amnt"]);
                                                
                                                
                                                
                                                
                                                
                                            }
                                            ?>   
                                               
                                            </tr>
                                            <tr>
                                                <td colspan="4">Total
                                                </td>
                                                <td align="right">
                                                    <?php echo number_format($check_total, 2);   ?>
                                                </td>
                                                <td align="right">
                                                    <?php echo number_format($clinic_total, 2);   ?>
                                                </td>
                                                <td align="right">
                                                    <?php echo number_format($dochmo_total, 2);   ?>
                                                </td>
                                                <td align="right">
                                                    <?php echo number_format($doch10perc_total, 2);   ?>
                                                </td>
                                                <td align="right">
                                                    <?php echo number_format($docsoa_total, 2);   ?>
                                                </td>
                                                <td align="right">
                                                    <?php echo number_format($hmoexces_total, 2);   ?>
                                                </td>
                                                
                                            </tr>
                                                                                
                                            
                                        </table>
                                </div>
                     
                     </div> 
                </td>
             </tr>
           </tbody>
          <tfoot><tr><td>
        
                <div style="width:1100px;padding:0 10px 0 10px">
                                
                                
                                <div id="footer" align="left" style="width: 100%;display:table;padding-top:20px;">          
                                    <div style="float:left">
                                        Prepared by:<br/>
                                        <br/>
                                        <?php echo $prepared_by; ?>
                                    </div>
                                    
                                   
                                </div>
                </div>   
           
           </td></tr></tfoot> 
    </table>
  
</body>
</html>
