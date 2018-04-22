<?php
$connection=Yii::app()->db;  
 $billid = $_GET["billid"];
 
 //get hmoids
 $hmoids = array();
 $query = "select id from hmo_form a
            where a.hmo_billing_id = $billid";
$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $hmoids[] = $recd["id"];
    }
}
$hmoids = implode(",",$hmoids);
  
?>

<h1>Trnxs of HMO Billing #<?php echo $billid ?></h1>

<?php 
$model = new HmoBilling();
$model = HmoBilling::model()->findByPk($billid);
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',        
         array(
                    'name'=>'HMO',
                    'value'=> Hmo::model()->findByPk($model->hmo_id)->name
                ),       
         
         array(
                    'name'=>'Encoded Dates Period',
                    'value'=> $model->from_date . " to ". $model->to_date
                ),       
                 
        'prepared_by',
        //'by_userid',
        'date_prepared',
        'date_due',
        //'pds_hmo_id',        
         array(
                    'name'=>'bill_total',
                    'value'=> number_format($model->bill_total,2 )
                ),
    ),
)); 


$query ="select c.hmo_billing_id, sum(a.paid_amnt) as totpaid,
                sum(a.wtax) as tottax,
                sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                left join hmo_form c
                on b.hmo_form_id = c.id
                where c.hmo_billing_id = ".$model->id;
            
$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
        $receivable = floatval($model->bill_total) - $tmp_paidtot;
       
            
       
    }
}

?>
<table id="yw0" class="detail-view">
    <tbody>
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
                            'condition'=>'hmo_form_id in (' . $hmoids. ')'
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
                                'value'=>'Hmoform::model()->findByPk($data->hmo_form_id)->patient_name'
                         ), 
                        'payto',
                        array(         
                                'name'=>'service',
                                'type'=>'raw',
                                'value'=>'"(Dr. ".$data->claim_doctor_name .")<br/>". $data->med_service."<br/>Availed:".Hmoform::model()->findByPk($data->hmo_form_id)->avail_date'
                         ),
                                                
                        
                        'charge_fee',
                        
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