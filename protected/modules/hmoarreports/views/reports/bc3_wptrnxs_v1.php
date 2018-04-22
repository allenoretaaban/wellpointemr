<?php
$connection=Yii::app()->db;  
$task = $_GET['task'];

$dstart  = $_GET["start"];
$dend  = $_GET["end"];
if($_GET['paid']==null||$_GET['paid']==''){
    $paid = '2'; 
}else{
    $paid = $_GET['paid'];    
}
//get itemids
 $itemds = array();
 $query = "select b.itemid
        from hmo_form_items b       
        left join hmo_form c      
        on b.hmo_form_id = c.id                         
        where 
        b.payto = 'WPCLINIC'  
        and 
        c.avail_date between '$dstart' and '$dend'
        ";
if($paid == '1'){
    $query .= "and b.itemid in(select form_itemid from hmoar_chkapply)";
} 
if($paid == '0'){
    $query .= "and b.itemid not in(select form_itemid from hmoar_chkapply)";
}        
        
$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $itemds[] = $recd["itemid"];
    }
}
$itemds = implode(",",$itemds);

  
?>

<h1>WP Clinic's HMO Billing & Collection Report - Trnxs By Period</h1>

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
                    a.payto = 'WPCLINIC'                    
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
                        b.payto = 'WPCLINIC'  
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
        <tr class="even"><th>Billed Total</th><td><?php echo number_format ( floatval($billtotal) , 2)  ?></td></tr>
        <tr class="even"><th>Paid Total</th><td><?php echo number_format ( floatval($recd["totpaid"]) , 2)  ?></td></tr>
        <tr class="even"><th>Wtax Total</th><td><?php echo number_format ( floatval($recd["tottax"]) , 2)  ?></td></tr>
        <tr class="even"><th>Loss Total</th><td><?php echo number_format ( floatval($recd["totloss"]) , 2)  ?></td></tr>
        <tr class="even"><th>Unpaid Bal</th><td><?php echo number_format($receivable, 2);     ?></td></tr>
    </tbody>
</table>        
<br/>

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
<?php $this->renderPartial('wptrnxs_search',array(
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
     href='http://<?php echo $_SERVER["HTTP_HOST"]; ?>/hmoarreports/reports/hmowptrnxexcel/?<?php
     echo "trnx={$task}&start={$dstart}&end={$dend}&paid={$paid}&";
      if(isset($_GET['Search']))
      {foreach($_GET['Search'] as $key => $value)
      {echo $key.'='.$value.'&';}}
      ?>
      '>Export To Excel</a>
    </div>


<?php


//Data Filter Basic 
$criteria=new CDbCriteria;  
$arr_hmo_itemids = explode(",", $itemds);
$criteria->addInCondition('itemid',$arr_hmo_itemids,'IN'); 

//custom search
if ($_GET["Search"]){
                                                         
    $search_hmo_company = $_GET["Search"]["hmo_company"];
    $search_patient_name = $_GET["Search"]["patient_name"];
    $search_avail_date = $_GET["Search"]["avail_date"];
    $search_claim_doctor_name = $_GET["Search"]["claim_doctor_name"];
    $search_med_service = $_GET["Search"]["med_service"];   
    $search_payable_to = $_GET["Search"]["payable_to"];   
    $search_check_number = $_GET["Search"]["check_number"];   
    $search_check_date = $_GET["Search"]["check_date"];   
    
    if ($search_hmo_company){    
        $criteria->addCondition("hmo_form_id in ". "(select id from hmo_form where hmo_name like '%". $search_hmo_company ."%')");        
    }
    
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
                    'name'=>'HMO Company',
                    'type'=>'raw',
                    'value'=>'Hmoform::model()->findByPk($data->hmo_form_id)->hmo_name'
             ), 
        
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
            
            array(         
                    'name'=>'charge_fee',
                    'type'=>'raw',
                    'value'=>'number_format($data->charge_fee, 2)'
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