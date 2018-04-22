<?php

$hmoid  = $_GET["hmoid"];
$dstart  = $_GET["start"];
$dend  = $_GET["end"];

if($hmoid == ""){
    header('Location: http://wpbacoor.emr/hmoarreports/reports/bcreport'); 
    die();          
}

$connection=Yii::app()->db;  
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

if ($billids ==""){
    echo "No Record Found"; return;
}

$query ="select c.hmo_billing_id, sum(a.paid_amnt) as totpaid, sum(a.wtax) as tottax, sum(a.loss) as totloss
    from hmoar_chkapply a left join hmo_form_items b on a.form_itemid = b.itemid left join hmo_form c on b.hmo_form_id = c.id                   
    where c.hmo_id = ".$hmoid." and c.hmo_billing_id in ($billids)";

$command = $connection->createCommand($query);
$datareader = $command->query();

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
<h1>HMO Billing & Collection Report</h1>

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

<?php
//$test = array();
//$query = "SELECT * FROM hmo_billing WHERE hmo_id ='$hmoid' AND  date_prepared BETWEEN '$dstart' AND '$dend'";

//$command=$connection->createCommand($query);
//$datareader=$command->query();
//if ($datareader){
//    foreach($datareader as $recd) { 
//        $test[] = $recd["id"];
//    }
//}

//$a = implode(",",$test);


$this->widget('zii.widgets.grid.CGridView', array(

    'dataProvider'=>HmoBilling::model()->hmoArReport($hmoid, $dstart, $dend),
    //'dataProvider'=>HmoBilling::model()->search(),
    'enablePagination' => true,
    'columns'=>array(
        'id',
        'date_prepared',
        'date_due',
         array(
            'name'=>'bill_total',
            'value'=> number_format($data->bill_total,2 )
        ),
        array(            
            'name'=>'paid',
            'value'=>array($this,'getPaidTotal')
        ),
        array(            
            'name'=>'wtax',
            'value'=>array($this,'getWtaxTotal')
        ),
        array(            
            'name'=>'Loss',
            'value'=>array($this,'getLossTotal')
        ),
        
        array(            
            'name'=>'Unpaid Bal',
            'value'=>array($this,'getBalance')
        ),
         
        array(            
            'name'=>'custom_links',
            'value'=>array($this,'customLinks')
        ),
    ),    
   ));
   
?>

