<?php
  
$medicationhistory = ApeMh4Medicationhistory::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$medicationhistory[0]->ape_id; 
?>
<style type="text/css">   
.medicationHistoryTable{
    width:100%;
}           
.medicationHistoryTable .medicationHistoryTableHead{    
    font-weight:bold;    
}   
.medicationHistoryTable tr td{   
    padding-left:3px;
    padding-right:3px;
}
.medicationHistoryTable tr td input[type="text"]{  
    width: 100%;
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
}
</style>               
<div class="form">
<?php     
$form=$this->beginWidget('CActiveForm', array(        
    'id'=>'ape-medicationhistory-form',
    //'action'=>'/ape/medicationHistoryUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); 


?>
<table class="medicationHistoryTable">                
    <tr class="medicationHistoryTableHead">                                        
        <td>Present Medications/Treatment</td>  
    </tr>                    
    <tr>                                                         
        <td><?php echo $form->checkBox($medicationhistory[0],"pmt_no",  
        array('checked'=>$medicationhistory[0]->pmt_no)); ?> No</td>    
    </tr>                    
    <tr>                                                                 
        <td><?php echo $form->checkBox($medicationhistory[0],"pmt_yes",  
        array('checked'=>$medicationhistory[0]->pmt_yes)); ?> Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         Specify Drug/Therapy: <?php echo $form->textField($medicationhistory[0],"sdt",  
        array('style'=>"width: 500px;")); ?></td>    
    </tr>               
    <tr>                                                                 
        <td><?php echo $form->checkBox($medicationhistory[0],"fdase",  
        array('checked'=>$medicationhistory[0]->fdase)); ?> Food/Drug Allergy/Side effects, specify:
        <?php echo $form->textField($medicationhistory[0],"specify",  
        array('style'=>"width: 500px;")); ?></td>    
    </tr>      
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="mh4_submit" value="Save"  class="ajaxBtn">
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">  
</p> 

<?php $this->endWidget(); ?>
    
    </div>