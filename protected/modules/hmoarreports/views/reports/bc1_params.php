<?php
  $model = new HmoarChecks();
?>
<h1>HMO Balance & Collection Report</h1>

<div class="form">
    <div class="row">
        <label>Select HMO</label>
        
        <?php 
        $models = Hmo::model()->findAll(array('order'=>'name'));
        $list = CHtml::listData($models,'id', 'name');
        echo CHtml::dropDownList('hmoid', '', 
              $list,
              array('empty' => '(Select a category'));
        
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
    if (  $('#hmoid').val()  ==''){
        alert ('Please select hmo'); return;
    }
    if (  $('#date_from').val() ==''  ){
        alert ('Please select date from');return;
    }
    if (  $('#date_end').val() =='' ){
        alert ('Please select date end');return;
    }
    window.location = '/hmoarreports/reports/bcreport?task=generate&hmoid=' + $('#hmoid').val() + '&start=' + $('#date_from').val() + '&end=' + $('#date_end').val() ;
}
</script>