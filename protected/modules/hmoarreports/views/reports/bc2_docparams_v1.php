<?php
  $model = new HmoarChecks();
?>
<h1>Doctor's HMO Balance & Collection Report</h1>

<div class="form">
    <!--div class="row">
        <label>Select Doctor</label>
        
        <?php         
        $list = CHtml::listData( Doctor::model()->findAll(), 'id', 'fullname' );
        echo CHtml::dropDownList('docid', '', 
              $list,
              array('empty' => '(Select a category'));
        
        
         
        ?>
        
    </div-->
    
     <div class="row">
        <label>Service Period Start</label>
        <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'date_from',
                    'value' => '',
                    'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                            'showButtonPanel'=>false,
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'yearRange'=>'2000'
                        )
                    ));
               
        ?>
    </div>    
    
    <div class="row">
        <label>Service Period End</label>
        <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'date_end',
                    'value' => '',
                    'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                            'showButtonPanel'=>false,
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'yearRange'=>'2000'
                        )
                    ));
               
        ?>
    </div>    
    
    <input type="button" onclick="generate()" value='  Generate Report  ' />
   
</div>
 
                
<script>
function generate(){
    if (  $('#docid').val()  ==''){
        alert ('Please select hmo'); return;
    }
    if (  $('#date_from').val() ==''  ){
        alert ('Please select date from');return;
    }
    if (  $('#date_end').val() =='' ){
        alert ('Please select date end');return;
    }
    window.location = '/hmoarreports/reports/bcreport?task=docgenerate&docid=' + $('#docid').val() + '&start=' + $('#date_from').val() + '&end=' + $('#date_end').val() ;
}
</script>