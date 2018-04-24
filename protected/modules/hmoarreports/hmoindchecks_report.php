<?php

$dstart  = $_GET["start"];
$dend  = $_GET["end"];
$toexcel = $_GET["toexcel"];

$logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
             
$settings = Settings::model()->findByPk(1);   

$profile=Yii::app()->getModule('user')->user()->profile;                
$prepared_by = $profile->first_name.' '.$profile->last_name; 


$connection=Yii::app()->db; 

$query = "select * from settings where id = 1";
$command = $connection->createCommand($query);
$settings = $command->queryRow();

if ($toexcel == "1"){
    $filename = "HmoIndividualChecks";
    header("Content-Disposition: attachment; filename=\"$filename\""); 
    header("Content-Type: application/vnd.ms-excel");    
}

$grantot_orig = '&nbsp;';
$grantot_net = '&nbsp;';

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
                    <input type='button' class='noprint' onclick="window.location = 'bcreport?task=hmoindchecks_generate&start=<?php echo $dstart; ?>&end=<?php echo $dend; ?>&toexcel=1'" value='Export to Excel' >
                    <br/>
                   <input class='noprint' type='button' value='Print' onclick='window.print()' />
                   <div style="width:1100px;padding:0 10px 0 10px">
                   
                        <div align="center">                         
                            <table style="width:790px">
                                <tr>
                                    <td>
                                        <div class="branch"><?=$settings["bacoor_address_html"] ?></div>
                                    </td>
                                    <td style="text-align:center;" valign=top >
                                        <img src="<?=$logo ?>" style="height:50px;"/>
                                        <div>Medical Clinic and Diagnostic Center, Inc.</div>
                                    </td>
                                    <td>
                                        <div class="branch"><?=$settings["dasma_address_html"] ?></div>
                                    </td>
                                </tr>
                            </table>
                        </div>    
                        
                   </div>
           
           </td></tr></thead>
           <tbody>
            <tr>
                <td><h1>HMO Doctor Checks: Individual Checks Summary</h1></td>
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
                                                <th>DOCTOR</th>
                                                <th>TIN NUMBER </th> 
                                                <?php
                                                //get HMO
                                                $hmoids = array();
                                                
                                                $hmo_id_chktot = array();
                                                $hmo_id_docfeetot = array();
                                                $hmo_id_lesstaxtot = array();
                                                
                                                $query = "select a.id, a.name from hmo a order by a.name asc ";
                                                  $command=$connection->createCommand($query);
                                                    $datareader=$command->query();
                                                    if ($datareader){
                                                        foreach($datareader as $recd) {
                                                            $hmoids[] = $recd["id"]; 
                                                            echo "<th colspan=2>".$recd["name"]."</th>";
                                                            
                                                        }
                                                    }
                                                ?>                                       
                                                <td colspan="2" style="text-align: center;"><b>Total</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                                <?php
                                                for ($i = 0; $i < count($hmoids) ; $i++)  {
                                                        
                                                ?>
                                                <td >Orig. Amt.</td>
                                                <td >Net (less Tax)</td> 
                                                <?php
                                                }     
                                                ?>
                                                <td >Orig. Amt.</td>
                                                <td >Net (less Tax)</td> 
                                            </tr>
                                            
                                            <?php
                                                //Get Doctors
                                                $query = "select a.id, concat(a.lastname, ', ', a.firstname) as docname, a.tinno 
                                                            from doctor a 
                                                            order by a.lastname asc";
                                                $command=$connection->createCommand($query);
                                                    $datareader=$command->query();
                                                    if ($datareader){
                                                        foreach($datareader as $doc) {
                                                            $row_org_tot = "&nbsp;";
                                                            $row_net_tot = "&nbsp;";
                                                            $row_docfee_tot = "&nbsp;";
                                                            
                                                            if ($doc["tinno"] == ""){    
                                                                $doctin = '&nbsp;';
                                                            }else{
                                                                $doctin = $doc["tinno"];
                                                            }
                                                             echo "<tr>
                                                                        <td>".$doc["docname"]."</td>
                                                                        <td>".$doctin."</td>
                                                                        ";
                                                            
                                                            for ($i = 0; $i < count($hmoids) ; $i++)  {
                                                                     $tmp_hmoid = $hmoids[$i];
                                                                    $chkamnttot = '&nbsp;';
                                                                    $str_lesstaxtot = '&nbsp;';
                                                                    $docfee = "&nbsp;";
                                                                    $docfee_tot= '&nbsp;';
                                                                    
                                                                    $query = "select sum(a.check_amnt) as chkamnt, 
                                                                                sum(a.billed_amnt) as docfee
                                                                                from hmoar_checks a
                                                                                where a.pay_doc_id = ".$doc["id"]."
                                                                                and a.hmo_id = ".$tmp_hmoid."
                                                                                and a.payto = 'DOCTOR'
                                                                                and a.entry_date between '$dstart' and '$dend'";
                                                                    $command=$connection->createCommand($query);
                                                                    $dr_summ=$command->query();
                                                                    
                                                                    
                                                                    while(($row = $dr_summ->read())!==false) {
                                                                            
                                                                            $chkamnttot = number_format($row["chkamnt"], 2);
                                                                              $docfee = number_format((floatval($row["docfee"]) - $xcestot) + $hmoxcestot, 2);
                                                                              $docfee_tot += $docfee;
                                                                              $row_org_tot += floatval($row["chkamnt"]);
                                                                              $row_docfee_tot += floatval((floatval($row["docfee"]) - $xcestot) + $hmoxcestot);
                                                                    }
                                                                   
                                                                    
                                                                     echo "<td class=money >$docfee</td>";
                                                                     echo "<td class=money >".$chkamnttot."</td>";  
                                                            }
                                                            
                                                          if ($row_org_tot > 0) {
                                                              $grantot_orig += $row_org_tot;
                                                              $grantot_docfee += $row_docfee_tot;
                                                               $row_org_tot = number_format($row_org_tot, 2);
                                                               $row_docfee_tot = number_format($row_docfee_tot, 2);
                                                               /*$row_net_tot = number_format($row_net_tot, 2);*/
                                                          }
                                                            
                                                           echo "<td class=money >$row_docfee_tot</td>";
                                                           echo "<td class=money >$row_org_tot</td> ";
                                                           echo "</tr>" ;
                                                        }
                                                    }
                                            ?>
                                            <tr >
                                                <td colspan="2">TOTAL</td>
                                                
                                                <?php
                                                
                                                //get Total per HMO
                                                    
                                                    for ($i = 0; $i < count($hmoids) ; $i++)  {
                                                        $fill_hmochktot = '&nbsp;';
                                                        $fill_hmodocfeetot = '&nbsp;';
                                                        $fill_hmolesstaxtot = '&nbsp;';
                                                        if ($hmo_id_chktot[$hmoids[$i]] != ""){                                                            
                                                            echo "<td class=money > ".number_format($hmo_id_docfeetot[$hmoids[$i]], 2)."</td>";                                                            
                                                            echo "<td class=money >".number_format($hmo_id_chktot[$hmoids[$i]], 2)."</td>";
                                                        }else{
                                                            echo "<td class=money >$fill_hmodocfeetot</td>";
                                                            echo "<td class=money >$fill_hmochktot</td>";
                                                        }
                                                        
                                                    }
                                                    if ($grantot_orig > 0){
                                                        $grantot_orig = number_format($grantot_orig, 2);
                                                        $grantot_docfee = number_format($grantot_docfee, 2);
                                                        /*$grantot_net = number_format($grantot_net, 2);*/
                                                    }
                                                    echo "<td class=money >$grantot_docfee</td>";
                                                    echo "<td class=money >$grantot_orig</td>";
                                                ?>                                       
                                                
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
                                    
                                    <div style="float:right">
                                        <br/><br/>
                                        Received By / Date:
                                        ____________________________
                                    </div>
                                </div>
                </div>   
           
           </td></tr></tfoot> 
    </table>
  
</body>
</html>
