<?php
  $model = new HmoarChecks();
?>
<h1>Search Patient Transaction</h1>

<div class="form">
    <div class="row">
        <label>Select Patient</label>
        
        <?php 
        $model = new Patient();
echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                            array(
                                    'model'=>$model,
                                    'attribute'=>'id',
                                    'htmlOptions' => array("size"=>'50','style'=>'padding:10px;'),
                                    'sourceUrl'=>Yii::app()->createAbsoluteUrl('Patient/lookup',array())
                                     
                            ),
                            true
                        );
        
        ?>
        
    </div>
    
     <div class="row">
        <label>Billing Period Start</label>
        <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'date_from',
                    'value' => '',
                    'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                            'showButtonPanel'=>false,
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'yearRange'=>'2000:+1'
                        )
                    ));
               
        ?>
    </div>    
    
    <div class="row">
        <label>Billing Period End</label>
        <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'date_end',
                    'value' => '',
                    'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                            'showButtonPanel'=>false,
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'yearRange'=>'2000:+1'
                        )
                    ));
               
        ?>
    </div>    
    
    <input type="button" onclick="generate()" value='  Generate Report  ' />
   
</div>
 
                
<script>
function generate(){
    if (  $('#Patient_id').val()  ==''){
        alert ('Please select patient'); return;
    }else{
        pid = $('#Patient_id').val();
        arr = pid.split(':');
        pid = arr[1];
    }
    if (  $('#date_from').val() ==''  ){
        alert ('Please select date from');return;
    }
    if (  $('#date_end').val() =='' ){
        alert ('Please select date end');return;
    }
    window.location = '/hmoarreports/reports/bcreport?task=searchtrnxs&pid=' + pid + '&start=' + $('#date_from').val() + '&end=' + $('#date_end').val() ;
}
</script>