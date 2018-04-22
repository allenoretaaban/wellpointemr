<?php
  
$bloodpressure = ApePe2Bloodpressure::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$bloodpressure[0]->ape_id; 
?>
<style type="text/css">   
.bloodpressureTable{
    width:100%;
}           
.bloodpressureTable .bloodpressureTableHead{  
    text-align: center;      
    font-weight:bold;    
}   
.bloodpressureTable tr td{   
    padding-left:3px;
    padding-right:3px;
    text-align:right;
}
.bloodpressureTable tr td input[type="text"]{       
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
}
</style>               
<div class="form">   

<?php $form=$this->beginWidget('CActiveForm', array(        
    'id'=>'ape-bloodpressure-form',               
    'enableAjaxValidation'=>false,                    
    
)); ?>
<table class="bloodpressureTable">     
    <tr>                                         
        <td ><b>Blood Pressure&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td> 
        <td>
        Seated/rested:
        <?php echo $form->textField($bloodpressure[0],"is_q1",array("style"=>"width:100px !important;")); ?>
        Repeat BP:
        <?php echo $form->textField($bloodpressure[0],"repeat_bp",array("style"=>"width:100px !important;")); ?>
        PR:
        <?php echo $form->textField($bloodpressure[0],"pr",array("style"=>"width:100px !important;")); ?>     
        RR:
        <?php echo $form->textField($bloodpressure[0],"rr",array("style"=>"width:100px !important;")); ?>
        T:
        <?php echo $form->textField($bloodpressure[0],"t",array("style"=>"width:100px !important;")); ?></td>     
    </tr>  
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="pe2_submit" value="Save" class="ajaxBtn" >
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>