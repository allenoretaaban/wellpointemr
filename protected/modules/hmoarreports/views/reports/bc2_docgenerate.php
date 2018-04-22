<?php

$dstart  = $_GET["start"];
$dend  = $_GET["end"];

if(isset($_GET['getDocBilled'])){
            $connection=Yii::app()->db;   
            $dstart  = $_GET["start"];
            $dend  = $_GET["end"];  
            $doc_id = $_GET['doc_id'];
    
            $billed_total = 0;  
            
            $query = "select sum(a.charge_fee) as bill_total
                    from hmo_form_items a
                    left join hmo_form b
                    on a.hmo_form_id = b.id
                    where a.claim_doctor_id = $doc_id and
                     b.avail_date between '".$dstart."' AND '".$dend."'";   
                     
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){                    
                foreach($datareader as $recd) {   
                    $billed_total = $recd["bill_total"];    
                }
            }        
            
            echo number_format($billed_total, 2);
            die();    
}

if(isset($_GET['getDocBalance'])){        
    $connection=Yii::app()->db;  
    $dstart  = $_GET["start"];
    $dend  = $_GET["end"];  
    $doc_id = $_GET['doc_id'];   
    
    
    $billed_total = 0;  
            
    $query = "select sum(a.charge_fee) as bill_total
            from hmo_form_items a
            left join hmo_form b
            on a.hmo_form_id = b.id
            where a.claim_doctor_id = $doc_id and
             b.avail_date between '".$dstart."' AND '".$dend."'";   
             
    $command=$connection->createCommand($query);
    $datareader=$command->query();
    if ($datareader){                    
        foreach($datareader as $recd) {   
            $billed_total = $recd["bill_total"];    
        }
    } 

    $query = "select itemid
            from hmo_form_items a
            left join hmo_form b
            on a.hmo_form_id = b.id
            where a.claim_doctor_id = $doc_id and
             b.avail_date between '".$dstart."' AND '".$dend."'";   
             
    $command=$connection->createCommand($query);
    $datareader=$command->query();
    $itemids = array();
    if ($datareader){                    
        foreach($datareader as $recd) {   
            $itemids[] = $recd["itemid"];    
        }
    }        

    $itemids = implode(',', $itemids);
    if($itemids ==""){
        $itemids = 0;
    }
    $query ="SELECT sum(paid_amnt) as totpaid,    
    sum(wtax) as tottax,      
    sum(loss) as totloss
    FROM hmoar_chkapply
    WHERE form_itemid in (".$itemids.")";

     $command=$connection->createCommand($query);
    $datareader=$command->query();   
    if ($datareader){                    
        foreach($datareader as $recd) {                                                 
            $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
            $receivable = floatval($billed_total) - $tmp_paidtot;
            echo number_format($tmp_paidtot, 2) ." / ". number_format($receivable, 2);  
        }
    }
    die();     
}


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
    where b.payto = 'DOCTOR'  
    and c.hmo_billing_id in ($billids)";

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

<script type="text/javascript">
$(document).ready(function(){
    
    
});
    function  getDocBilled(doc_id){  
         $.ajax({
            method: 'GET',                            
            data: {'getDocBilled':'1', 'doc_id':doc_id},
            success: function(msg) {  
                console.log(msg); 
                $('#tr1'+doc_id).parent().html(msg);     
            },
            error: function() {
                getDocBilled(doc_id);
            }
        });      
    }
    function  getDocBalance(doc_id){  
         $.ajax({
            method: 'GET',                            
            data: {'getDocBalance':'1', 'doc_id':doc_id},
            success: function(msg) {  
                console.log(msg); 
                $('#tr2'+doc_id).parent().html(msg);     
            },
            error: function() {
                getDocBalance(doc_id);
            }
        });      
    }
</script>

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

