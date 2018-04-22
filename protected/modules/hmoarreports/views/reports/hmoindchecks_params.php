<?php
  
?>
<h1>HMO Doctor Checks: Individual Checks Summary</h1>

<div class="form">
  <div class="row">
        <label>Date Start</label>
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
        <label>Date End</label>
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
   
    if (  $('#date_from').val() ==''  ){
        alert ('Please select date from');return;
    }
    if (  $('#date_end').val() =='' ){
        alert ('Please select date end');return;
    }
    //window.location = '/hmoarreports/reports/bcreport?task=hmoalldocs_generate&start=' + $('#date_from').val() + '&end=' + $('#date_end').val() ;
    var urllink = '/hmoarreports/reports/bcreport?task=hmoindchecks_generate&start=' + $('#date_from').val() + '&end=' + $('#date_end').val();
    window.open( urllink, '_blank' );
}
</script>