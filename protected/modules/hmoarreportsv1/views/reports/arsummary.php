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
    
    $query2 = "select sum(bill_total) as biltot from hmo_billing where hmo_id =  ".$hmo["id"];
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
    
    $receivable = floatval($hmo["billtot"]) - $tmp_paidtot;
    $hmo["balance"] =  $receivable;
    
    $total_bal += $receivable;
    
    $hmos[] = $hmo;
    
}

  
?>
<h1>HMO Receivable Report To-date</h1>
<style>
.lbl{width:auto;text-align: right;}
.val{text-align:right;}
</style>

<div>
<label>Receivable to-date total:</label>&nbsp;&nbsp;<span id=""><?php echo number_format($total_bal, 2)  ?></span>
</div>
<div>
    <a href="http://wellpoint.cis/hmoarreports/reports/printsummary" target="_blank">Print </a>
</div>
<br/>
<fieldset>
<legend>HMO Balances:</legend>
        
        <table>
            <?php
                foreach ($hmos as $xhmo){
                    ?>
                    <tr>
                            <td class="lbl">
                            <span style="width:150px"><?php echo $xhmo["name"] ?>:</span>
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