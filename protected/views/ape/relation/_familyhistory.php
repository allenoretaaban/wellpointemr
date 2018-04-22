<?php
  
$familyhistory = ApeMh2Familyhistory::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$familyhistory[0]->ape_id; 
?>
<style type="text/css">   
.familyHistoryTable{
    width:100%;
}           
.familyHistoryTable .familyHistoryTableHead{  
    text-align: center;      
    font-weight:bold;    
}   
.familyHistoryTable tr td{   
    padding-left:3%;
    padding-right:3px;
}
.familyHistoryTable tr td input[type="text"]{  
    width: 100%;
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
}
</style>               
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(        
    'id'=>'ape-familyhistory-form',
    //'action'=>'/ape/FamilyHistoryUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<table class="familyHistoryTable">     
    <tr>
        <td colspan="5"><b>Family History - Any member of the family or near relative suffering (or died) of the ff:</b></td>     
    </tr>          
    <tr><td>&nbsp;</td></tr>      
    <tr class="familyHistoryTableHead">
        <td></td>
        <td>Relationship</td>
        <td>Age detected</td>
        <td>(or Age died)</td>
        <td></td>
    </tr>       
    <tr>
        <td><?php echo $form->checkBox($familyhistory[0],"is_ha",  array('checked'=>$familyhistory[0]->is_ha)); ?> Heart disease/heart attack</td>
        <td><?php echo $form->textField($familyhistory[0],"ha_relationship"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"ha_agedetected"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"ha_agedied"); ?></td>     
        <td></td>
    </tr>    
    <tr>                                           
        <td><?php echo $form->checkBox($familyhistory[0],"is_ht",  array('checked'=>$familyhistory[0]->is_ht)); ?> Hypertension(Bp: 140/90 or above)</td>
        <td><?php echo $form->textField($familyhistory[0],"ht_relationship"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"ht_agedetected"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"ht_agedied"); ?></td>  
        <td></td>
    </tr>  
    <tr>                                            
        <td><?php echo $form->checkBox($familyhistory[0],"is_dm",  array('checked'=>$familyhistory[0]->is_dm)); ?> Diabetes Mellitus</td>
        <td><?php echo $form->textField($familyhistory[0],"dm_relationship"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"dm_agedetected"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"dm_agedied"); ?></td>
        <td></td>
    </tr>   
    <tr>                                       
        <td><?php echo $form->checkBox($familyhistory[0],"is_ptb",  
        array('checked'=>$familyhistory[0]->is_ptb)); ?> Pulmonary Tuberculosis</td>
        <td><?php echo $form->textField($familyhistory[0],"ptb_relationship"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"ptb_agedetected"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"ptb_agedied"); ?></td>   
        <td></td>
    </tr>  
    <tr>                                     
        <td><?php echo $form->checkBox($familyhistory[0],"is_cancer",  
        array('checked'=>$familyhistory[0]->is_cancer)); ?> Cancer(What Type?)<?php 
        echo $form->textField($familyhistory[0],"cancer_type",array('style'=>'width:auto;')); ?></td>
        <td><?php echo $form->textField($familyhistory[0],"cancer_relationship"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"cancer_agedetected"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"cancer_agedied"); ?></td>     
        <td></td>
    </tr>     
    <tr>                                       
        <td><?php echo $form->checkBox($familyhistory[0],"is_kd",  
        array('checked'=>$familyhistory[0]->is_kd)); ?> Kidney disease</td>
        <td><?php echo $form->textField($familyhistory[0],"kd_relationship"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"kd_agedetected"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"kd_agedied"); ?></td>   
        <td></td>
    </tr>      
    <tr>                           
        <td><?php echo $form->checkBox($familyhistory[0],"is_others",  
        array('checked'=>$familyhistory[0]->is_others)); ?> Others:<br><?php 
        echo $form->textArea($familyhistory[0],"others_name",array('style'=>'width:100%;')); ?></td>
        <td><?php echo $form->textField($familyhistory[0],"others_relationship"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"others_agedetected"); ?></td>   
        <td><?php echo $form->textField($familyhistory[0],"others_agedied"); ?></td>  
        <td></td>
    </tr>   
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="mh2_submit" value="Save" class="ajaxBtn">  
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>