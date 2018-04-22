<?php


$connection=Yii::app()->db;  
 $billid = $_GET["billid"];
 $paid = $_GET['paid'];
 
 //Export to Excel
if(isset($_REQUEST['Test']) && $_REQUEST['Test']=='1'){                                  
    $table = str_replace('<thead>','',$_REQUEST['table']); 
    $table = str_replace('</thead>','',$table);   
    $table = str_replace('<body>','',$_REQUEST['table']); 
    $table = str_replace('</body>','',$table);   
    $table = str_replace('<th ','<td ',$table);   
    $table = str_replace('</th>','</td>',$table);       
    $table = str_replace('class="odd"','',$table);  
    $table = str_replace('class="even"','',$table); 
    
    $filename ='trnx_soa_no_'.$_REQUEST['billid'].'_'.date('Y-m-d H:i:s'); 
    
    header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0"); 
    echo "<table border='1'>";
    echo $table;
    echo "</table>";
    die();
}

//AJAX Data
if(isset($_GET['getTrnxPaidTotal'])){
            $connection=Yii::app()->db;   
            $itemid  = $_GET["itemid"];     
    
            $query ="select sum(a.paid_amnt) as totpaid
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$itemid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    if (floatval($recd["totpaid"]) > 0){
                        echo number_format($recd["totpaid"], 2);    
                    }else{
                        echo "0.00";
                    }
                    
                }
            }
            die();    
}
if(isset($_GET['getTrnxWtaxTotal'])){
            $connection=Yii::app()->db;   
            $itemid  = $_GET["itemid"];     
            $query ="select sum(a.wtax) as totwtax
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$itemid;     
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totwtax"]) > 0){
                        echo number_format($recd["totwtax"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }
            die();    
}  
if(isset($_GET['getTrnxLossTotal'])){
            $connection=Yii::app()->db;    
            $itemid  = $_GET["itemid"]; 
            $query ="select sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$itemid;
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totloss"]) > 0){
                        echo number_format($recd["totloss"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }
            die();    
}    
if(isset($_GET['getTrnxBalance'])){
            $connection=Yii::app()->db;    
            $itemid  = $_GET["itemid"];  
            $query ="select sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$itemid;
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totloss"]) > 0){
                        echo number_format($recd["totloss"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }
            die();    
}      
if(isset($_GET['getChkapplyHmoXces'])){
            $connection=Yii::app()->db;    
            $itemid  = $_GET["itemid"];   
            $query ="select a.hmo_xces
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$itemid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();    
            if ($datareader){
                foreach($datareader as $recd) {  
                    $hmo_xces = $recd['hmo_xces'];   
                }
            }    
            if ($hmo_xces ==""){
                echo number_format($hmo_xces, 2);    
            }else{
                echo "0.00";
            }
            die();    
}      
if(isset($_GET['getChkapplyProviderXces'])){
            $connection=Yii::app()->db;    
            $itemid  = $_GET["itemid"];    
            $query ="select a.provider_xces
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$itemid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    $provider_xces =  $recd['provider_xces'];
                }
            }
            
            if ($provider_xces ==""){
                echo number_format($provider_xces, 2);    
            }else{
                echo "0.00";
            }
            die();    
}    
if(isset($_GET['getChecksNo'])){
            $connection=Yii::app()->db;    
            $itemid  = $_GET["itemid"];  
            $check_id= array();
            $query ="select a.check_id
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$itemid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                   $check_id[] = $recd['check_id'];
                  
                }
            }
            $check_id = implode(',',$check_id);
            $query = "select check_no from hmoar_checks where checkid in('$check_id')";
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                  echo $recd['check_no'];
                }
            }
            die();    
}   
if(isset($_GET['getChecksDate'])){
            $connection=Yii::app()->db;    
            $itemid  = $_GET["itemid"];   
            $check_id= array();
            $query ="select a.check_id
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$itemid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                   $check_id[] = $recd['check_id'];
                  
                }
            }
            $check_id = implode(',',$check_id);   
            $query = "select check_date from hmoar_checks where checkid in('$check_id')";
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                  echo $recd['check_date'];
                }
            }
            die();    
}  
 
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

$hmo_form_item_id = array();
$query = "select * from hmo_form_items where hmo_form_id in($hmoids)";
if($_GET['paid']==1){
    $query .= ' AND itemid in (SELECT form_itemid from hmoar_chkapply)';
}
if($_GET['paid']==0 && $_GET['paid']!=null ){
    $query .= ' AND itemid not in (SELECT form_itemid from hmoar_chkapply)';
}  
if($_GET['paid']==2 || $_GET['paid']==null){
    $query .= '';
}  
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

                               
$query = "SELECT id FROM hmo_form WHERE hmo_billing_id = ". $model->id;
$hmo_id = array();
$command=$connection->createCommand($query);
$datareader=$command->query();            
if ($datareader){    
    foreach($datareader as $recd) { 
        $hmo_id[] = $recd["id"];
    }
}
     
//get hmo_ids
$hmo_ids = implode(",",$hmo_id);             

$query = "SELECT * FROM hmo_form_items WHERE hmo_form_id IN (".$hmo_ids.")";
$itemid = array();
$command=$connection->createCommand($query);
$datareader=$command->query();            
if ($datareader){    
    foreach($datareader as $recd) { 
        $itemid[] = $recd["itemid"];
    }
}

//get itemid
$itemids = implode(",",$itemid);   

$query ="select sum(paid_amnt) as totpaid,
                sum(wtax) as tottax,
                sum(loss) as totloss 
            from hmoar_chkapply where form_itemid in(".$itemids.")";
            
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
    <!--<script type="text/javascript">
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
      '>Export To Excel</a> -->
      
      <form method="POST" action="http://<?= $_SERVER["HTTP_HOST"] ?>/hmoarreports/reports/bcreport?task=<?php echo $_GET['task']; ?>&start=<?php echo $_GET['start']; ?>&end=<?php echo $_GET['end']; ?>">   
      <input type="hidden" name="Test" value='1'>
      <input type="hidden" id="table" name="table"/>
      <input type="submit" value="Export To Excel" onclick="ExportToExcel();">
      <div style="text-align: left; width: 400px; margin:0  0 0 auto; display:block;">
      </form>
      <div style="text-align: right;">Total row displayed: <span id='counter'>0</span></div><br/>
      <label>Note: wait until the displaying rows are equal to total rows displayed.<br/>
      only displayed data in the table will be generated to excel.<br/>
      You may add more data in the table by increasing the number below.</label>
      <select id='show_no'>
        <?php
            $selected = " selected='selected' ";
         ?>                                                                                                          
        <option value="10" <?php if(isset($_GET['show_no']) && $_GET['show_no']=='10'){echo $selected;}?>>10</option>
        <option value="50" <?php if(isset($_GET['show_no']) && $_GET['show_no']=='50'){echo $selected;}?>>50</option>
        <option value="100" <?php if(isset($_GET['show_no']) && $_GET['show_no']=='100'){echo $selected;}?>>100</option>
        <option value="500" <?php if(isset($_GET['show_no']) && $_GET['show_no']=='500'){echo $selected;}?>>500</option>  
        <option value="1000" <?php if(isset($_GET['show_no']) && $_GET['show_no']=='1000'){echo $selected;}?>>1000</option>
        <option value="5000" <?php if(isset($_GET['show_no']) && $_GET['show_no']=='5000'){echo $selected;}?>>5000</option>
      </select>
      </div>
    </div>     
    <script type="text/javascript">
        $(document).ready(function(){
             $('#show_no').on('change',function(){
                 showThis($(this).val());  
             });   
        });   
        function replaceUrlParam(url, paramName, paramValue){
            var pattern = new RegExp('('+paramName+'=).*?(&|$)') 
            var newUrl = url.replace(pattern,'$1' + paramValue + '$2');
            if(newUrl == url){
               newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue 
            }
            return newUrl
        }
        function showThis(number){
           var currentPageUrlIs = "";
            if (typeof this.href != "undefined") {
                   currentPageUrlIs = this.href.toString().toLowerCase(); 
            }else{ 
                   currentPageUrlIs = document.location.toString().toLowerCase();
            } 
           window.location = replaceUrlParam(currentPageUrlIs,'show_no', number);
            //alert(currentPageUrlIs+"&show_no="+number);
            //window.location =  "bcreport?task=wpgenerate&start=2013-01-01&end=2013-01-31&show_no="+number;
           // window.location.search = 'show_no='+number;
        }
        function incrementValue(){
            var value = parseInt(document.getElementById('counter').innerHTML, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('counter').innerHTML = value;
        }
        function ExportToExcel(itemid){  
           var table= $('.items').html();
           $('#table').val(table); 
           console.log(table);       
           return false; 
        }  
        function getTrnxPaidTotal(itemid){  
             $.ajax({
                method: 'GET',                            
                data: {'getTrnxPaidTotal':'1', 'itemid':itemid},
                success: function(msg) {  
                    $('#getTrnxPaidTotal'+itemid).parent().html(msg); 
                    //incrementValue();    
                },
                error: function() {
                    getTrnxPaidTotal(itemid);
                }
            });      
        }
        function getTrnxWtaxTotal(itemid){  
             $.ajax({
                method: 'GET',                            
                data: {'getTrnxWtaxTotal':'1', 'itemid':itemid},
                success: function(msg) {  
                    $('#getTrnxWtaxTotal'+itemid).parent().html(msg); 
                    //incrementValue();    
                },
                error: function() {
                    getTrnxWtaxTotal(itemid);                          
                }
            });      
        } 
        function getTrnxLossTotal(itemid){  
             $.ajax({
                method: 'GET',                            
                data: {'getTrnxLossTotal':'1', 'itemid':itemid},
                success: function(msg) {  
                    //console.log(msg); 
                    $('#getTrnxLossTotal'+itemid).parent().html(msg); 
                    //incrementValue();    
                },
                error: function() {
                    getTrnxLossTotal(itemid);                          
                }
            });      
        } 
        function getTrnxBalance(itemid){  
             $.ajax({
                method: 'GET',                            
                data: {'getTrnxBalance':'1', 'itemid':itemid},
                success: function(msg) {  
                    //console.log(msg); 
                    $('#getTrnxBalance'+itemid).parent().html(msg); 
                    //incrementValue();    
                },
                error: function() {
                    getTrnxBalance(itemid);                          
                }
            });      
        }     
        function getChkapplyHmoXces(itemid){  
             $.ajax({
                method: 'GET',                            
                data: {'getChkapplyHmoXces':'1', 'itemid':itemid},
                success: function(msg) {  
                    //console.log(msg); 
                    $('#getChkapplyHmoXces'+itemid).parent().html(msg); 
                    //incrementValue();    
                },
                error: function() {
                    getChkapplyHmoXces(itemid);                          
                }
            });      
        }    
        function getChkapplyProviderXces(itemid){  
             $.ajax({
                method: 'GET',                            
                data: {'getChkapplyProviderXces':'1', 'itemid':itemid},
                success: function(msg) {  
                    //console.log(msg); 
                    $('#getChkapplyProviderXces'+itemid).parent().html(msg); 
                    //incrementValue();    
                },
                error: function() {
                    getChkapplyProviderXces(itemid);                          
                }
            });      
        }   
        function getChecksNo(itemid){  
             $.ajax({
                method: 'GET',                            
                data: {'getChecksNo':'1', 'itemid':itemid},
                success: function(msg) {  
                    //console.log(msg); 
                    $('#getChecksNo'+itemid).parent().html(msg); 
                    //incrementValue();    
                },
                error: function() {
                    getChecksNo(itemid);                          
                }
            });      
        }  
        function getChecksDate(itemid){  
             $.ajax({
                method: 'GET',                            
                data: {'getChecksDate':'1', 'itemid':itemid},
                success: function(msg) {  
                    //console.log(msg); 
                    $('#getChecksDate'+itemid).parent().html(msg); 
                    incrementValue();    
                },
                error: function() {
                    getChecksDate(itemid);                          
                }
            });      
        }     
    </script>
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
    if(isset($_GET['show_no'])){ $pageSize = $_GET['show_no'];}else{$pageSize =10;} 
    
$dataSource = new CActiveDataProvider('HmoFormItems', array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>$pageSize,
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
                                'name'=>'Availment Date',
                                'type'=>'raw',
                                'value'=>'HmoForm::model()->findByPk($data->hmo_form_id)->avail_date'
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