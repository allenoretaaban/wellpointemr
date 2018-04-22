<?php

$dstart  = $_GET["start"];
$dend  = $_GET["end"];

$connection=Yii::app()->db;  
$query = "select sum(c.charge_fee) as bill_total
            from 
            (
                select b.avail_date, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.charge_fee from hmo_form_items a
                left join hmo_form b
                on a.hmo_form_id = b.id
                where
                a.payto = 'DOCTOR'  
                and 
                b.avail_date between 
                '$dstart' and '$dend'
            ) c ";
$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $bill_total = $recd["bill_total"];
    }
}

//get billing ids
$billids = array();
$query = "select id from hmo_billing 
        where date_prepared between '$dstart' and '$dend'";
$command=$connection->createCommand($query);
$datareader=$command->query();
if ($datareader){
    foreach($datareader as $recd) { 
        $billids[] = $recd["id"];
    }
}

if (count($billids)<=0){
    echo "No found billing in this period";return;
    
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
    where b.payto = 'DOCTOR'  and c.hmo_billing_id in ($billids)";

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
<h1>Doctor's Billing & Collection Report</h1>

<div>    
    <div class="row">
        <label><b>Billing Period Start: </b></label>
        <?php
            echo $dstart;
        ?>
    </div>
    <div class="row">
        <label><b>Billing Period Start: </b></label>
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
        <label><b>Paid Total For The Period : </b></label>
        <?php
            echo $tmp_paidtot;
        ?>
        &nbsp;<small style="color:royalblue">Note: Includes wtax & loss</small>
    </div>
    
    
    <div class="row">
        <label><b>Total Bal. For The Period : </b></label>
        <?php
            echo $unpaid;
        ?>
    </div>
</div>

<?php
$dataSource = new CActiveDataProvider('Doctor', array(
                    'criteria'=>array(
                            
                    ),
                    'pagination'=>array(
                            'pageSize'=>100,
                    ),
            ));

$this->widget('zii.widgets.grid.CGridView', array(

    'dataProvider'=>$dataSource,
    'enablePagination' => true,
    'columns'=>array(
        'id',
        array(         
                'name'=>'Doctor',
                'type'=>'raw',
                'value'=>'Doctor::model()->findByPk($data->id)->firstname. " ".Doctor::model()->findByPk($data->id)->lastname'
         ),  
         
       array(            
            'name'=>'Billed',
            'value'=>array($this,'getDocBilled')
        ),
        
        array(            
            'name'=>'Paid / Balance',
            'value'=>array($this,'getDocBalance')
        ),   
        
        array(            
            'name'=>'Action',
            'value'=>array($this,'docCustomLinks')
        ),
        
    ),    
   )); 

?>

