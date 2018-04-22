<?php
$connection=Yii::app()->db;  
 $billid = $_GET["billid"];
 $paid = $_GET['paid'];
 
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

$query = "select * from hmo_form_items where hmo_form_id in($hmoids)";
if($_GET['paid']==1){$query .= ' AND itemid in (SELECT form_itemid from hmoar_chkapply)';}
if($_GET['paid']==0&&$_GET['paid']!=''){$query .= ' AND itemid not in (SELECT form_itemid from hmoar_chkapply)';}  
if($_GET['paid']==2||$_GET['paid']==NULL){$query .= '';}  
    $command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $hmo_form_items) { 
        $hmo_form_item_id[] = $hmo_form_items["itemid"];
    }
}

$hmo_form_item_ids = implode(",", $hmo_form_item_id);



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

<!--Search-->

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#invoiceItem-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<div class="search-form">
<?php $this->renderPartial('bc2_hmopaidtrnxs_search',array(
    'model'=>$model,
)); ?>
</div>



    <div style='text-align:right; margin: 10px 50px 0 0;'>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#Download').live('click',function(){ 
            
        });
    });
    </script> 
    <a id='Download'
    target='_blank'
     href='http://<?php echo $_SERVER["HTTP_HOST"]; ?>/hmoarreports/reports/hmopaidtrnxsexcel/?<?php
     echo 'billid='.$billid.'&paid='.$paid.'&';
      if(isset($_GET['Search']))
      {foreach($_GET['Search'] as $key => $value)
      {echo $key.'='.$value.'&';}}
      ?>
      '>Export To Excel</a>
    </div>

<?php

//Data Filter Basic 
$criteria=new CDbCriteria;  
$arr_hmo_itemids = explode(",", $hmo_form_item_ids);
$criteria->addInCondition('itemid',$arr_hmo_itemids,'IN'); 

//custom search
if ($_GET["Search"]){
                  
    $search_avail_date = $_GET["Search"]["avail_date"];
    $search_claim_doctor_name = $_GET["Search"]["claim_doctor_name"];
    $search_med_service = $_GET["Search"]["med_service"];   
    $search_patient_name = $_GET["Search"]["patient_name"];   
    $search_payable_to = $_GET["Search"]["payable_to"];   
    $search_check_number = $_GET["Search"]["check_number"];   
    $search_check_date = $_GET["Search"]["check_date"];   
    
    if ($search_avail_date){    
        $criteria->addCondition("hmo_form_id in ". "(select id from hmo_form where avail_date = '". $search_avail_date ."')");        
    }    

    if ($search_claim_doctor_name){
        $criteria->compare('claim_doctor_name', $search_claim_doctor_name,true);    
    }
    
     
    if ($search_med_service){
        $criteria->compare('med_service', $search_med_service,true);   
    }
    
    if ($search_patient_name){
        $criteria->addCondition("hmo_form_id in ". "(select id from hmo_form where patient_name like '%".$search_patient_name."%')");   
    }

    if ($search_payable_to){
        $criteria->compare('payto', $search_payable_to,true);    
    }
    // (select form_id from hmoar_chkapply where checkid = (select checkid from hmoar_checks where check_no =  '$search_check_number'))
    if ($search_check_number){ 
        $form_itemid = '';                                                                           
        $query = "select form_itemid 
        from hmoar_chkapply 
        where check_id in 
        (select checkid from hmoar_checks 
        where check_no = '$search_check_number')";
        $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                        $form_itemid[] = $recd["form_itemid"];
                }
            }
             $form_itemid = implode(',',$form_itemid);
        $criteria->addCondition("itemid in ". "($form_itemid)");   
    }
    
    if ($search_check_date){  
        $form_itemid = '';                                                                           
        $query = "select form_itemid 
        from hmoar_chkapply 
        where check_id in 
        (select checkid from hmoar_checks 
        where check_date = '$search_check_date')";
        $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                        $form_itemid[] = $recd["form_itemid"];
                }
            }
             $form_itemid = implode(',',$form_itemid);  
        $criteria->addCondition("itemid in ". "($form_itemid)");   
    }
}
 
$dataSource = new CActiveDataProvider('HmoFormItems', array(
                    'criteria'=>$criteria,
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
                                'name'=>'Availment Date',
                                'type'=>'raw',
                                'value'=>'Hmoform::model()->findByPk($data->hmo_form_id)->avail_date'
                         ),
                         array(         
                                'name'=>'Doctor',
                                'type'=>'raw',
                                'value'=>'$data->claim_doctor_name'
                         ),
                         array(         
                                'name'=>'Services',
                                'type'=>'raw',
                                'value'=>'$data->med_service'
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
                        array(         
                                'name'=>'HMO Excess',
                                'type'=>'raw',
                                'value'=>array($this,'getChkapplyHmoXces')
                         ),
                         
                        array(         
                                'name'=>'Provider Excess',
                                'type'=>'raw',
                                'value'=>array($this,'getChkapplyProviderXces')
                         ),
                         
                        array(         
                                'name'=>'Check Number',
                                'type'=>'raw',
                                'value'=>array($this,'getChecksNo')
                         ),
                         
                        array(         
                                'name'=>'Check Date',
                                'type'=>'raw',
                                'value'=>array($this,'getChecksDate')
                         ),
                        
                ),
            ));
            
?>