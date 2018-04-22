<?php
  
$obgynehistory = ApeMh5Obgynehistory::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$obgynehistory[0]->ape_id; 
?>
<style type="text/css">   
.obgyneHistoryTable{
    width:100%;
}           
.obgyneHistoryTable .obgyneHistoryTableHead{    
    font-weight:bold;    
}   
.obgyneHistoryTable tr td{   
    padding-left:3px;
    padding-right:3px;
}
.obgyneHistoryTable tr td input[type="text"]{  
    width: 100%;
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
}
</style>               
<div class="form">
<?php     
$form=$this->beginWidget('CActiveForm', array(        
    'id'=>'ape-obgynehistory-form',
    //'action'=>'/ape/obgyneHistoryUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); 


?>
<table class="obgyneHistoryTable">                
    <tr class="obgyneHistoryTableHead">                                        
        <td>OB-GYNE History</td>  
    </tr>                    
    <tr>                                                         
        <td colspan="2">Last Menstrual Period (1st day cycle)<?php echo $form->textField($obgynehistory[0],"lmp",  
        array('style'=>"width: 500px;")); ?>&nbsp;&nbsp;&nbsp;
        <?php echo $form->checkBox($obgynehistory[0],"is_lmpmon",  
        array('checked'=>$obgynehistory[0]->is_lmpmon)); ?> Monthly&nbsp;
        <?php echo $form->checkBox($obgynehistory[0],"is_lmpirregular",  
        array('checked'=>$obgynehistory[0]->is_lmpirregular)); ?> Irregular</td>    
    </tr>        
    <tr>                                                         
        <td colspan="2">Are you pregnant?&nbsp;
        <?php echo $form->checkBox($obgynehistory[0],"is_pyes",  
        array('checked'=>$obgynehistory[0]->is_pyes)); ?> Yes&nbsp;
        <?php echo $form->checkBox($obgynehistory[0],"is_pno",  
        array('checked'=>$obgynehistory[0]->is_pno)); ?> No</td>    
    </tr>        
    <tr>                                                         
        <td>Problem in past Pregnancy:</td>
        <td>
        <?php echo $form->checkBox($obgynehistory[0],"is_preeclampsia",  
        array('checked'=>$obgynehistory[0]->is_preeclampsia)); ?> Pre-eclampsia</td>    
    </tr>         
    <tr>                                                         
        <td></td>
        <td>
        <?php echo $form->checkBox($obgynehistory[0],"is_eclampsia",  
        array('checked'=>$obgynehistory[0]->is_eclampsia)); ?> Eclampsia</td>    
    </tr>        
    <tr>                                                         
        <td></td>
        <td>
        <?php echo $form->checkBox($obgynehistory[0],"is_miscarriage",  
        array('checked'=>$obgynehistory[0]->is_miscarriage)); ?> Miscarriage (abortion):
        <?php echo $form->textField($obgynehistory[0],"miscarriage",  
        array('style'=>"width: 500px;")); ?></td>    
    </tr>        
    <tr>                                                         
        <td></td>
        <td>
        <?php echo $form->checkBox($obgynehistory[0],"is_caesarian",  
        array('checked'=>$obgynehistory[0]->is_caesarian)); ?> Caesarian section (reason):
        <?php echo $form->textField($obgynehistory[0],"caesarian",  
        array('style'=>"width: 500px;")); ?></td>    
    </tr>                    
       
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="mh5_submit" value="Save" class="ajaxBtn">  
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>