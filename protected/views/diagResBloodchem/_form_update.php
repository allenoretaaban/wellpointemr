<?php  
$patient = Yii::app()->db->createCommand()
    ->select('*')
    ->from('patient')    
    ->where('id=:id', array(':id'=>$model->patient_id))
    ->queryRow();
//getage
$birthday_timestamp = strtotime($patient["birthdate"]);  
$age = date('md', $birthday_timestamp) > date('md') ? date('Y') - date('Y', $birthday_timestamp) - 1 : date('Y') - date('Y', $birthday_timestamp);
//gender
($patient["gender"] == "M")? $gender="Male" : $gender = "Female";    
?>
<style>
div.row{
    margin-bottom:15px !important;
}
.row span{
    color:#0000FF;
}
.row small{
    color:#0000FF;
}
</style>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'diag-res-bloodchem-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <hr/>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">        
        <?php echo $form->hiddenField($model,'patient_id', array('value'=>$model->patient_id) ); ?>                
        <?php echo $form->hiddenField($model,'id', array('value'=>$model->id) ); ?>        
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'datereceived'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'datereceived',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'1900'
                                )
                            ),
                            true
                        );
                ?>
        <?php echo $form->error($model,'datereceived'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'datereleased'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'datereleased',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'1900'
                                )
                            ),
                            true
                        );
                ?>
        <?php echo $form->error($model,'datereleased'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'patient_name'); ?>
        <?php echo $form->textField($model,'patient_name',array('size'=>60,'maxlength'=>250,'value'=>$model->patient_name,'readonly'=>'readonly')); ?>
        <?php echo $form->error($model,'patient_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'age'); ?>
        <?php echo $form->textField($model,'age',array('size'=>5,'maxlength'=>250,'value'=>$age,'readonly'=>'readonly')); ?>
        <?php echo $form->error($model,'age'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'gender'); ?>
        <?php echo $form->textField($model,'gender',array('size'=>10,'maxlength'=>250,'value'=>$gender,'readonly'=>'readonly')); ?>
        <?php echo $form->error($model,'gender'); ?>
    </div>       
    <hr/>
    <div class="row">
        <?php echo $form->labelEx($model,'sp_no'); ?>
        <?php echo $form->textField($model,'sp_no',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'sp_no'); ?>
    </div>             

    <div class="row">
        <?php echo $form->labelEx($model,'req_doctor'); ?>
        <?php echo $form->textField($model,'req_doctor',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'req_doctor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'medtech'); ?>
        <?php echo $form->textField($model,'medtech',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'medtech'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'medtech_license'); ?>
        <?php echo $form->textField($model,'medtech_license',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'medtech_license'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'pathologist'); ?>
        <?php echo $form->textField($model,'pathologist',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'pathologist'); ?>
    </div>
    <hr/>
    
    <div class="row">
        <?php echo $form->labelEx($model,'glucose'); ?>
        <?php echo $form->textField($model,'glucose',array('size'=>60,'maxlength'=>250)); ?>     
        <br/><small>Ref Range: 4.11 - 6.39 mmol/L</small>
        <?php echo $form->error($model,'glucose'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'bun'); ?>
        <?php echo $form->textField($model,'bun',array('size'=>60,'maxlength'=>250)); ?>      
        <br/><small>Ref Range: 2.8 - 8.2 mmol/L</small>
        <?php echo $form->error($model,'bun'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'creatinine'); ?>
        <?php echo $form->textField($model,'creatinine',array('size'=>60,'maxlength'=>250)); ?>        
        <br/><small>Ref Range: M:61.88-150.28 umol/L / F:61.88-123.76 umol/L</small>
        <?php echo $form->error($model,'creatinine'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'uric_acid'); ?>
        <?php echo $form->textField($model,'uric_acid',array('size'=>60,'maxlength'=>250)); ?>     
        <br/><small>Ref Range: M: 202.23 - 416.36 umol/L / F: 142.75 - 339.03 umol/L</small>
        <?php echo $form->error($model,'uric_acid'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cholesterol'); ?>
        <?php echo $form->textField($model,'cholesterol',array('size'=>60,'maxlength'=>250)); ?><br/>    
        <small>Desirable: < 5.2 mmol/L</small><br/>
        <small>Borderline: 5.2 - 6.2 mmol/L</small><br/>
        <small>High Risk: > 6.24 mmol/L</small><br/>
        <?php echo $form->error($model,'cholesterol'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'triglycerides'); ?>
        <?php echo $form->textField($model,'triglycerides',array('size'=>60,'maxlength'=>250)); ?>  
        <br/><small>Ref Range: 0.396 - 1.815 mmol/L</small> 
        <?php echo $form->error($model,'triglycerides'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'hdl_c'); ?>
        <?php echo $form->textField($model,'hdl_c',array('size'=>60,'maxlength'=>250)); ?> 
        <br/><small>Ref Range: M: 0.594 - 1.629 mmol/L / F: 1.629 - 1.939 mmol/L</small> 
        <?php echo $form->error($model,'hdl_c'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ldl_c'); ?>
        <?php echo $form->textField($model,'ldl_c',array('size'=>60,'maxlength'=>250)); ?>  
        <br/><small>Ref Range: 0-3.362 mmol/L</small> 
        <?php echo $form->error($model,'ldl_c'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'vldl_c'); ?>
        <?php echo $form->textField($model,'vldl_c',array('size'=>60,'maxlength'=>250)); ?>   
        <br/><small>Ref Range: 0.113 - 0.452 mmol/L</small> 
        <?php echo $form->error($model,'vldl_c'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sgot_ast'); ?>
        <?php echo $form->textField($model,'sgot_ast',array('size'=>60,'maxlength'=>250)); ?>  
        <br/><small>Ref Range: 0 - 40 IU/L</small> 
        <?php echo $form->error($model,'sgot_ast'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sgpt_alt'); ?>                                        
        <?php echo $form->textField($model,'sgpt_alt',array('size'=>60,'maxlength'=>250)); ?>  
        <br/><small>Ref Range: 0 - 49 IU/L</small> 
        <?php echo $form->error($model,'sgpt_alt'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'hba1c'); ?>
        <?php echo $form->textField($model,'hba1c',array('size'=>60,'maxlength'=>250)); ?>   
        <br/><small>Ref Range: 4.2 - 6.2%</small> 
        <?php echo $form->error($model,'hba1c'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'total_bilirubin'); ?>
        <?php echo $form->textField($model,'total_bilirubin',array('size'=>60,'maxlength'=>250)); ?>     
        <br/><small>Ref Range: 0 - 17.1 umol/L</small> 
        <?php echo $form->error($model,'total_bilirubin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'direct_bilirubin'); ?>
        <?php echo $form->textField($model,'direct_bilirubin',array('size'=>60,'maxlength'=>250)); ?>        
        <br/><small>Ref Range: 0 - 5.10 umol/L</small> 
        <?php echo $form->error($model,'direct_bilirubin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'indirect_bilirubin'); ?>
        <?php echo $form->textField($model,'indirect_bilirubin',array('size'=>60,'maxlength'=>250)); ?>    
        <br/><small>Ref Range: 0 - 12.0 umol/L</small> 
        <?php echo $form->error($model,'indirect_bilirubin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sodium'); ?>
        <?php echo $form->textField($model,'sodium',array('size'=>60,'maxlength'=>250)); ?>    
        <br/><small>Ref Range: 135 - 148 meq/L</small> 
        <?php echo $form->error($model,'sodium'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'potassium'); ?>
        <?php echo $form->textField($model,'potassium',array('size'=>60,'maxlength'=>250)); ?>   
        <br/><small>Ref Range: 3.4 - 5.3 meq/L</small> 
        <?php echo $form->error($model,'potassium'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'chloride'); ?>
        <?php echo $form->textField($model,'chloride',array('size'=>60,'maxlength'=>250)); ?>      
        <br/><small>Ref Range: 96 - 108 meq/L</small> 
        <?php echo $form->error($model,'chloride'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'calcium'); ?>
        <?php echo $form->textField($model,'calcium',array('size'=>60,'maxlength'=>250)); ?>      
        <br/><small>Ref Range: 2.2 - 3.1 meq/L</small> 
        <?php echo $form->error($model,'calcium'); ?>
    </div>

    <!--div class="row">
        <?php echo $form->labelEx($model,'total_protein'); ?>
        <?php echo $form->textField($model,'total_protein',array('size'=>60,'maxlength'=>250)); ?>    
        <br/><small>1.3 - 2.1 meq/L</small> 
        <?php echo $form->error($model,'total_protein'); ?>
    </div-->

    <div class="row">
        <?php echo $form->labelEx($model,'alkaline_phosphatase'); ?>
        <?php echo $form->textField($model,'alkaline_phosphatase',array('size'=>60,'maxlength'=>250)); ?>    
        <br/><small>Adult (34 - 114 u/L)</small> 
        <?php echo $form->error($model,'alkaline_phosphatase'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'other'); ?>
        <?php echo $form->textArea($model,'other',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'other'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->