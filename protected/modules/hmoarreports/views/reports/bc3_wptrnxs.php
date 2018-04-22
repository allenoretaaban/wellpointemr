<?php
$connection=Yii::app()->db;  
$task = $_GET['task'];

$dstart  = $_GET["start"];
$dend  = $_GET["end"];


//Export to Excel
if(isset($_REQUEST['Test']) && $_REQUEST['Test']=='1'){
    //print_r($_REQUEST);                                     
    $table = str_replace('<thead>','',$_REQUEST['table']); 
    $table = str_replace('</thead>','',$table);   
    $table = str_replace('<body>','',$_REQUEST['table']); 
    $table = str_replace('</body>','',$table);   
    $table = str_replace('<th ','<td ',$table);   
    $table = str_replace('</th>','</td>',$table);       
    $table = str_replace('class="odd"','',$table);  
    $table = str_replace('class="even"','',$table);   
    $string[] = str_replace('-','_',$dstart);
    $string[] = '_';
    $string[] = str_replace('-','_',$dend);
    $string = implode('',$string);

    $filename ='wptrnx_'.$string;                               
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
        left join hmo_billing a
        on c.hmo_billing_id = a.id                         
        where 
        b.payto = 'WPCLINIC'  
        and 
        a.date_prepared between '$dstart' and '$dend'
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
$query ="select sum(a.charge_fee) as bill_total 
        from hmo_form_items a                  
        left join hmo_form b                  
        on a.hmo_form_id = b.id  
        left join hmo_billing c
        on b.hmo_billing_id = c.id                 
        where              
        a.payto = 'WPCLINIC'                    
        and                   
        c.date_prepared  
        between                   
        '$dstart' and '$dend'              
        ";
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
                        left join hmo_billing d
                        on c.hmo_billing_id = d.id           
                        where              
                        b.payto = 'WPCLINIC'  
                        and 
                        d.date_prepared between '$dstart' and '$dend'";
            
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
                    'name'=>'HMO Company',
                    'type'=>'raw',
                    'value'=>'HmoForm::model()->findByPk($data->hmo_form_id)->hmo_name'
             ), 
        
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