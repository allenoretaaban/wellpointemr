<?php
$connection=Yii::app()->db;  

$pid  = $_GET["pid"];
$dstart  = $_GET["start"];
$dend  = $_GET["end"];

//get itemids
 $itemds = array();
 $query = "select b.itemid
        from hmo_form_items b       
        left join hmo_form c      
        on b.hmo_form_id = c.id                         
        where 
        c.patient_id = $pid
        and 
        c.avail_date between '$dstart' and '$dend'
        ";
$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $itemds[] = $recd["itemid"];
    }
}
$itemds = implode(",",$itemds);

if ($itemds ==""){
    echo "No record found"; return;
}

  
?>

<h1>Patient Trnxs By Period</h1>

<?php 

//bill total
 $query ="select sum(c.charge_fee) as bill_total            
                    from               
                    (                  
                    select b.avail_date, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.charge_fee 
                    from hmo_form_items a                  
                    left join hmo_form b                  
                    on a.hmo_form_id = b.id                  
                    where              
                    b.patient_id = $pid
                    and                   
                    b.avail_date 
                    between                   
                    '$dstart' and '$dend'              
                    ) c ";
             $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) {
                    $billtotal = floatval($recd["bill_total"]); 
                }
            }         


//balances total         
 $query ="SELECT sum(a.paid_amnt) as totpaid,    
                      sum(a.wtax) as tottax,      
                      sum(a.loss) as totloss      
                      from hmoar_chkapply a      
                        left join hmo_form_items b      
                            on a.form_itemid = b.itemid      
                        left join hmo_form c      
                            on b.hmo_form_id = c.id            
                        where              
                        c.patient_id = $pid
                        and 
                        c.avail_date between '$dstart' and '$dend'   ";
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
                    $receivable = floatval($billtotal) - $tmp_paidtot;
                    
                }
            }         

?>
<table id="yw0" class="detail-view">
    <tbody>
        <tr class="even"><th>Patient</th><td><?php $patient = Patient::model()->findByPk($pid); echo $patient->firstname. " ". $patient->lastname;  ?></td></tr>
        <tr class="even"><th>Billed Total</th><td><?php echo number_format ( floatval($billtotal) , 2)  ?></td></tr>
        <tr class="even"><th>Paid Total</th><td><?php echo number_format ( floatval($recd["totpaid"]) , 2)  ?></td></tr>
        <tr class="even"><th>Wtax Total</th><td><?php echo number_format ( floatval($recd["tottax"]) , 2)  ?></td></tr>
        <tr class="even"><th>Loss Total</th><td><?php echo number_format ( floatval($recd["totloss"]) , 2)  ?></td></tr>
        <tr class="even"><th>Unpaid Bal</th><td><?php echo number_format($receivable, 2);     ?></td></tr>
    </tbody>
</table>        
<br/>

<?php


$dataSource = new CActiveDataProvider('HmoFormItems', array(
                    'criteria'=>array(
                            'condition'=>'itemid in (' . $itemds. ')'
                    ),
                    'pagination'=>array(
                            'pageSize'=>50,
                    ),
            ));  

$this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'invoiceItem-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
            'columns'=>array(
            'itemid',
            'hmo_form_id',
            
            array(         
                    'name'=>'patient_name',
                    'type'=>'raw',
                    'value'=>'HmoForm::model()->findByPk($data->hmo_form_id)->patient_name'
             ), 
             
            'payto',
            array(         
                    'name'=>'service',
                    'type'=>'raw',
                    'value'=>'"(Dr. ".$data->claim_doctor_name .")<br/>". $data->med_service."<br/>Availed:".HmoForm::model()->findByPk($data->hmo_form_id)->avail_date'
             ),
            
            array(         
                    'name'=>'charge_fee',
                    'type'=>'raw',
                    'value'=>'number_format($data->charge_fee, 2)."<br/>*".Hmo::model()->findByPk(HmoForm::model()->findByPk($data->hmo_form_id)->hmo_id)->name'
             ), 
            
            array(            
                'name'=>'paid',
                'value'=>array($this,'getTrnxPaidTotal')
            ),
            array(            
                'name'=>'wtax',
                'value'=>array($this,'getTrnxWtaxTotal')
            ),
            array(            
                'name'=>'Loss',
                'value'=>array($this,'getTrnxLossTotal')
            ),
            
            array(            
                'name'=>'Unpaid Bal',
                'value'=>array($this,'getTrnxBalance')
            ),

            
    ),
));
            
?>