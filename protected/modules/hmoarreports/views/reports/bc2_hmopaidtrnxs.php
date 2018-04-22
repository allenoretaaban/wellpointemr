<?php
$model=HmoFormItems::model();
//var_dump($model);       
$paid = $_GET['paid'];

$hmoid = $_GET["hmoid"];
$dstart  = $_GET["start"];
$dend  = $_GET["end"];   
if($paid != 1){echo "<h1>Nothing is paid</h1>
                    <a href='bcreport?task=generate&hmoid={$hmoid}&start={$dstart}&end={$dend}'>Back</a>";}else{
              
$connection=Yii::app()->db;
$hmoids = array();

$query = "select id from hmo_billing 
where hmo_id = $hmoid
and 
date_prepared between '$dstart' and '$dend'";

$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $billid) { 
        $billids[] = $billid["id"];
    }
}
$hmo_forms = array();

$billids = implode(",", $billids);

    $query = "select * from hmo_form where hmo_billing_id in ($billids)";   
    $command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $hmo_form) {
         
        $hmo_form_ids[] = $hmo_form["id"];
    }
}

$hmo_form_ids = implode(",", $hmo_form_ids);

    $query = "select * from hmo_form_items
     where hmo_form_id in($hmo_form_ids) AND itemid in (SELECT form_itemid from hmoar_chkapply)";   
    $command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $hmo_form_items) { 
        $hmo_form_item_id[] = $hmo_form_items["itemid"];
    }
}

$hmo_form_item_ids = implode(",", $hmo_form_item_id);  
$query = "select sum(bill_total) as billtotal from hmo_billing 
        where hmo_id = $hmoid
        and 
        date_prepared between '$dstart' and '$dend'";
$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $bill_total = $recd["billtotal"];
    }
}
////////////////////////////////////////////////

//get billing ids
$billids = array();
$query = "select id from hmo_billing 
        where hmo_id = $hmoid
        and 
        date_prepared between '$dstart' and '$dend'";
$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $billids[] = $recd["id"];
    }
}

//get paid total
$billids = implode(",",$billids);
$query ="select c.hmo_billing_id, sum(a.paid_amnt) as totpaid,
    sum(a.wtax) as tottax,
    sum(a.loss) as totloss
    from hmoar_chkapply a
    left join hmo_form_items b
    on a.form_itemid = b.itemid
    left join hmo_form c
    on b.hmo_form_id = c.id                   
    where c.hmo_id = ".$hmoid. 
    " and c.hmo_billing_id in ($billids)";

$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
        $receivable = floatval($bill_total) - $tmp_paidtot;
        
        if ($receivable > 0){
            $unpaid = number_format($receivable, 2);    
        }else{
            $unpaid = "0.00";
        }
        
        if ($tmp_paidtot > 0){
            $tmp_paidtot = number_format($tmp_paidtot, 2);    
        }else{
            $tmp_paidtot = "0.00";
        }
    }
}
  
?>

<style>
.row{padding:0 0 5px 0 ;}
div.row label{color:royalblue;}
</style>
<h1>HMO Billing & Collection Report - Paid Transactions</h1>

<div>    
    <div class="row">
        <label><b>HMO: </b></label>
        <?php
            echo Hmo::model()->findByPk($hmoid)->name;
        ?>
    </div>
    <div class="row">
        <label><b>Billing Period Start: </b></label>
        <?php
            echo $dstart;
        ?>
    </div>
    <div class="row">
        <label><b>Billing Period End: </b></label>
        <?php
            echo $dend;
        ?>
    </div>
    <div class="row">
        <label><b>Bill Total For The Period : </b></label>
        <?php
            echo number_format($bill_total, 2);
        ?>
    </div>
    <div class="row">
 
        <label><a href='/hmoarreports/reports/bcreport?task=hmopaidtrnxs&hmoid=<?php echo $hmoid; ?>&start=<?php echo $dstart; ?>&end=<?php echo $dend; ?>&paid=<?php if($tmp_paidtot==0){echo 0;}else{echo 1;} ?>' target='_blank'><b>Paid Total For The Period :</b></a>  </label> <?php echo $tmp_paidtot; ?>
        
        &nbsp;<small style="color:royalblue">Note: Includes wtax & loss</small>
    </div>
    
    
    <div class="row">
        <label><a href='/hmoarreports/reports/bcreport?task=hmonotpaidtrnxs&hmoid=<?php echo $hmoid; ?>&start=<?php echo $dstart; ?>&end=<?php echo $dend; ?>&paid=<?php if($unpaid==0){echo 1;}else{echo 0;} ?>' target='_blank'><b>Total Bal. For The Period : </b></a></label>
        <?php
            echo $unpaid;
        ?>
    </div>
    
</div>
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
     echo 'hmoid='.$hmoid.'&start='.$dstart.'&end='.$dend.'&paid='.$paid.'&';
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

 
 //$criteria->addSearchCondition('claim_doctor_name',$search_claim_doctor_name,'IN'); 
 
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
                         /*array(         
                                'name'=>'service',
                                'type'=>'raw',
                                'value'=>'"(Dr. ".$data->claim_doctor_name .")<br/>". $data->med_service."<br/>Availed:".Hmoform::model()->findByPk($data->hmo_form_id)->avail_date'
                         ),*/
                                                
                        
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
            
}
?>