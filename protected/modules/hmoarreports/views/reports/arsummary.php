<?php
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
        
     $query2 = "select sum(charge_fee) as biltot 
from hmo_form_items 
where hmo_form_id in 
(
select id 
from hmo_form  
where hmo_id = ".$hmo["id"]."
)";
    $command2=$connection->createCommand($query2);
    $dataReader2 = $command2->query();
    foreach($dataReader2 as $row2) {
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
    
    
    
    
    $query4 = "select c.hmo_billing_id, sum(a.paid_amnt) as totpaid,
                sum(a.wtax) as tottax,
                sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                left join hmo_form c
                on b.hmo_form_id = c.id
                where c.hmo_id = ".$hmo["id"]." and
                b.payto = 'WPCLINIC'";
    $command4=$connection->createCommand($query4);
    $dataReader4 = $command4->query();
    foreach($dataReader4 as $row4) {
        $wp_paidtot = floatval($row4["totpaid"]) + floatval($row4["tottax"]) + floatval($row4["totloss"]);
    }
    
        $query5 = "select c.hmo_billing_id, sum(a.paid_amnt) as totpaid,
                sum(a.wtax) as tottax,
                sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                left join hmo_form c
                on b.hmo_form_id = c.id
                where c.hmo_id = ".$hmo["id"]." and
                b.payto = 'DOCTOR'";
    $command5=$connection->createCommand($query5);
    $dataReader5 = $command5->query();
    foreach($dataReader5 as $row5) {
        $doc_paidtot = floatval($row5["totpaid"]) + floatval($row5["tottax"]) + floatval($row5["totloss"]);
    }
     
        $query6 = "select sum(charge_fee) as bill_total 
from hmo_form_items 
where hmo_form_id in 
(
select id 
from hmo_form  
where hmo_id = ".$hmo["id"]."
) 
and payto = 'DOCTOR'";
    $command6=$connection->createCommand($query6);
    $dataReader6 = $command6->query();
    foreach($dataReader6 as $row6) {
        $doc_billtotal = floatval($row6["bill_total"]);
    }
    $hmo['doc_bill_total'] =     $doc_billtotal;    
     
     
        $query7 = "select sum(charge_fee) as bill_total 
from hmo_form_items 
where hmo_form_id in 
(
select id 
from hmo_form  
where hmo_id = ".$hmo["id"]."
) 
and payto = 'WPCLINIC'";
    $command7=$connection->createCommand($query7);
    $dataReader7 = $command7->query();
    foreach($dataReader7 as $row7) {
        $doc_billtotal = floatval($row7["bill_total"]);
    }
    $hmo['wp_bill_total'] =     $doc_billtotal;
    
    
    
    
    
    
    $receivable = floatval($hmo["billtot"]) - $tmp_paidtot;
    $hmo["balance"] =  $receivable;
    $hmo['paidtotal'] = $tmp_paidtot;
    $hmo['wp_paidtot'] =   $wp_paidtot;
    $hmo['doc_paidtot'] =   $doc_paidtot;
    $total_bal += $receivable;
  
  
  
  
  
  
    
    $hmos[] = $hmo;
    
}

  
?>
<h1>HMO Receivable Report To-date</h1>
<style>
.lbl{width:auto;text-align: right;}
.val{text-align:right;}
td{padding:5px;}
</style>

<!--div>
<label>Receivable to-date total:</label>&nbsp;&nbsp;<span id=""><?php echo number_format($total_bal, 2)  ?></span>
</div>
<div>
    <a href="http://wellpoint.cis/hmoarreports/reports/printsummary" target="_blank">Print </a>
</div-->
<br/>
<fieldset>
<legend>HMO Balances:</legend>
        
        <table border='1'>  <tr>
                            <td class="lbl">
                            <span style="width:150px">HMO Company:</span>
                            </td>
                            <td class="val">
                                <span>Doctor Bill total</span>
                            </td> 
                            <td class="val">
                                <span>Wellpoint Bill total</span>
                            </td>
                            <td class="val">
                                <span>Bill total</span>
                            </td>     
                            <td class="val">
                                <span>Doctor Paid total</span>
                            </td>
                            <td class="val">
                                <span>WellPoint Paid total</span>
                            </td> 
                            <td class="val">
                                <span>Paid total</span>
                            </td> 
                            <td class="val">
                                <span>Doctor Balance total</span>
                            </td> 
                            <td class="val">
                                <span>WellPoint Balance total</span>
                            </td> 
                            <td class="val">
                                <span>Total Balance</span>
                            </td>    
                            </tr>
            <?php
                foreach ($hmos as $xhmo){
                    ?>
                    <tr>
                            <td class="lbl">
                            <span style="width:150px"><?php echo $xhmo["name"] ?>:</span>
                            </td>
                            <td class="val">
                                <span><?php echo number_format($xhmo["doc_bill_total"], 2) ?></span>
                            </td>     
                            <td class="val">
                                <span><?php echo number_format($xhmo["wp_bill_total"], 2) ?></span>
                            </td> 
                            <td class="val">
                                <span><?php echo number_format($xhmo["billtot"], 2) ?></span>
                            </td>     
                            <td class="val">
                                <span><?php echo number_format($xhmo["doc_paidtot"], 2) ?></span>
                            </td>     
                            <td class="val">
                                <span><?php echo number_format($xhmo["wp_paidtot"], 2) ?></span>
                            </td>  
                            <td class="val">
                                <span><?php echo number_format($xhmo["paidtotal"], 2) ?></span>
                            </td>    
                            <td class="val">
                                <span><?php $doc_bal_total = $xhmo["doc_bill_total"] - $xhmo["doc_paidtot"]; echo number_format($doc_bal_total, 2)?></span>
                            </td>     
                            <td class="val">
                                <span><?php $wp_bal_total = $xhmo["wp_bill_total"] - $xhmo["wp_paidtot"]; echo number_format($wp_bal_total, 2) ?></span>
                            </td>  
                            <td class="val">
                                <span><?php echo number_format($xhmo["balance"], 2) ?></span>
                            </td>         
                    </tr>
                    <?php
                }
            ?>
            
            
        </table>

</fieldset>