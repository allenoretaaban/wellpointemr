<style>
h3{
    color:#008000;
}
</style>
<div class="form">

<?php
    $diagTemp="";
    $patientid="";


        if(!$_POST["patientval"]){
            $patientid = $_POST["DiagHematology"]['patient_id'];
        }else{
            list($patientname, $patient_id) = explode("|",$_POST["patientval"]);
            list($dum, $patientid) = explode(":",$patient_id);
        }

        $diagTemp = Yii::app()->db->createCommand()
            ->select('*')
            ->from('patient')    
            ->where('id=:id', array(':id'=>$patientid))
            ->queryRow();

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'diag-hematology-form',
        'enableAjaxValidation'=>false,
    )); 
    
    //fullpatient name
    $fullpatientname = $diagTemp['lastname'].',';
    $fullpatientname .= ' '.trim($diagTemp['firstname']);
    if(trim($diagTemp['middleinitial']) != ''){$fullpatientname .= ' '.trim($diagTemp['middleinitial']);}
    
    $birthday_timestamp = strtotime($diagTemp["birthdate"]);  
    $age = date('md', $birthday_timestamp) > date('md') ? date('Y') - date('Y', $birthday_timestamp) - 1 : date('Y') - date('Y', $birthday_timestamp);
    $sex = trim($diagTemp['gender']);
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
		<?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250,'value'=>strtoupper($fullpatientname),'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'age'); ?>
        <?php echo $form->textField($model,'age',array('value'=>$age,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
        <?php echo $form->textField($model,'sex',array('size'=>60,'maxlength'=>250,'value'=>$sex,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requestingphysician'); ?>
		<?php echo $form->textField($model,'requestingphysician',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'requestingphysician'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'spno'); ?>
		<?php echo $form->textField($model,'spno',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'spno'); ?>
	</div>

    <hr>
    
	<div class="row">
		<?php echo $form->labelEx($model,'rbc'); ?>
		<?php echo $form->textField($model,'rbc',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 4.5-6.0 x 10 12/L</div>
		<?php echo $form->error($model,'rbc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hemoglobin'); ?>
		<?php echo $form->textField($model,'hemoglobin',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 140-160g/L(Male) & 120-140g/L(Female)</div>
		<?php echo $form->error($model,'hemoglobin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hematocrit'); ?>
		<?php echo $form->textField($model,'hematocrit',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 0.40-.50/L(Male) & 0.38-0.48/L(Female)</div>
		<?php echo $form->error($model,'hematocrit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wbc'); ?>
		<?php echo $form->textField($model,'wbc',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 5.0-10.0 x 10 9/L</div>
		<?php echo $form->error($model,'wbc'); ?>
	</div>
    
    <hr>        
    <div class="row">
        <h3 style="width:90%;">Differential Count</h3>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'segmenters'); ?>
		<?php echo $form->textField($model,'segmenters',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 0.40-0.60</div>
		<?php echo $form->error($model,'segmenters'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lymphocytes'); ?>
		<?php echo $form->textField($model,'lymphocytes',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 0.20-0.40</div>
		<?php echo $form->error($model,'lymphocytes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monocytes'); ?>
		<?php echo $form->textField($model,'monocytes',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 0.02-0.06</div>
		<?php echo $form->error($model,'monocytes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eosinophils'); ?>
		<?php echo $form->textField($model,'eosinophils',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 0.02-0.04</div>
		<?php echo $form->error($model,'eosinophils'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stabband'); ?>
		<?php echo $form->textField($model,'stabband',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 0.02-0.04</div>
		<?php echo $form->error($model,'stabband'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'basophil'); ?>
		<?php echo $form->textField($model,'basophil',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 0-0.005</div>
		<?php echo $form->error($model,'basophil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plateletcount'); ?>
		<?php echo $form->textField($model,'plateletcount',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 150-450 x 10 9/L</div>
		<?php echo $form->error($model,'plateletcount'); ?>
	</div>

    <hr>
    
	<div class="row">
		<?php echo $form->labelEx($model,'mcv'); ?>
		<?php echo $form->textField($model,'mcv',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'mcv'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'mch'); ?>
		<?php echo $form->textField($model,'mch',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'mch'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'mchc'); ?>
		<?php echo $form->textField($model,'mchc',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'mchc'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'bloodtype'); ?>
		<?php echo $form->textField($model,'bloodtype',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'bloodtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhtype'); ?>
		<?php echo $form->textField($model,'rhtype',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'rhtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'esr'); ?>
		<?php echo $form->textField($model,'esr',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 0-10mm/Hr(Male) & 0-20mm/Hr(Female)</div>
		<?php echo $form->error($model,'esr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bleedingtime'); ?>
		<?php echo $form->textField($model,'bleedingtime',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: 1-5 minutes</div>
		<?php echo $form->error($model,'bleedingtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'clottingtime'); ?>
		<?php echo $form->textField($model,'clottingtime',array('size'=>60,'maxlength'=>200)); ?>
        <div style='color:blue;margin:-6px 0px 10px 0px!important;font-size:10px;'>Reference Range: Less than 15 minutes</div>
		<?php echo $form->error($model,'clottingtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'others'); ?>
        <?php echo $form->textArea($model,'others',array('cols'=>45,'rows'=>3,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'others'); ?>
	</div>
    
        <hr>

	<div class="row">
		<?php echo $form->labelEx($model,'medicaltechnologist'); ?>
		<?php echo $form->textField($model,'medicaltechnologist',array('size'=>60,'maxlength'=>200,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'medicaltechnologist'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'licenseno'); ?>
		<?php echo $form->textField($model,'licenseno',array('size'=>20,'maxlength'=>20,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'licenseno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pathologist'); ?>
		<?php echo $form->textField($model,'pathologist',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'pathologist'); ?>
	</div>

	<div class="row" style="display:none;">                       		
        <input type="hidden" name="DiagHematology[patient_id]" value="<?=$patientid ?>">		
        <input type="hidden" name="DiagHematology[datecreated]" value="<?=date("Y-m-d") ?>">
	</div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::link(CHtml::button('Cancel'),array('diaghematology/admin'),array('style'=>'text-decoration:none;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<script>
submitThis = function(){
    if (confirm("Are you sure you want to save this result? \r\n You will need an Administrator to edit this once saved."))
    {           
        return true;
    }else{
        return false;
    }    
}
</script>