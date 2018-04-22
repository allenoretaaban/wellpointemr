<style>
h3{
    color:#008000;
}
</style>
<div class="form">

<?php
    $diagTemp="";
    $patientid="";
    
    if(!$_GET["patient_id"]) {
        if(!$_POST["patientval"]) {
            $du = Yii::app()->db->createCommand()
                ->select('*')
                ->from('diag_fecalysis')    
                ->where('id=:id', array(':id'=>$model->id))
                ->queryRow();
            $patientid = $du['patient_id'];
        } else {
            list($patientname, $patient_id) = explode("|",$_POST["patientval"]);
            list($dum, $patientid) = explode(":",$patient_id);
        }

        $diagTemp = Yii::app()->db->createCommand()
            ->select('*')
            ->from('patient')    
            ->where('id=:id', array(':id'=>$patientid))
            ->queryRow();
    } else {
        $patientid = $_GET["patient_id"];
        $diagTemp = Patient::model()->findByPk($_GET["patient_id"]);
    }

    $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'diag-fecalysis-form',
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
    
    <hr>
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
		<?php echo $form->labelEx($model,'color'); ?>
		<?php echo $form->textField($model,'color',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'consistency'); ?>
		<?php echo $form->textField($model,'consistency',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'consistency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mucus'); ?>
		<?php echo $form->textField($model,'mucus',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'mucus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'undigestedfood'); ?>
		<?php echo $form->textField($model,'undigestedfood',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'undigestedfood'); ?>
	</div>

    <hr >        
    <div class="row">
        <h3 style="width:90%;">MICROSCOPIC</h3>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'wbc'); ?>
		<?php echo $form->textField($model,'wbc',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'wbc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rbc'); ?>
		<?php echo $form->textField($model,'rbc',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'rbc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fatglobules'); ?>
		<?php echo $form->textField($model,'fatglobules',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'fatglobules'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yeastcells'); ?>
		<?php echo $form->textField($model,'yeastcells',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'yeastcells'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bacteria'); ?>
		<?php echo $form->textField($model,'bacteria',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'bacteria'); ?>
	</div>
    
    <hr>

	<div class="row">
		<?php echo $form->labelEx($model,'parasites'); ?>
        <?php echo $form->textArea($model,'parasites',array('cols'=>45,'rows'=>3,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'parasites'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amoeba'); ?>
        <?php echo $form->textArea($model,'amoeba',array('cols'=>45,'rows'=>3,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'amoeba'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'occultblood'); ?>
        <?php echo $form->textField($model,'occultblood',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'occultblood'); ?>
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
		<?php echo $form->textField($model,'licenseno',array('size'=>60,'maxlength'=>200,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'licenseno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pathologist'); ?>
		<?php echo $form->textField($model,'pathologist',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'pathologist'); ?>
	</div>

    <div class="row" style="display:none;">
		<?php echo $form->labelEx($model,'patient_id'); ?>
        <input type="hidden" name="DiagFecalysis[patient_id]" value="<?=$patientid ?>">
		<?php echo $form->textField($model,'patient_id',array('size'=>20,'maxlength'=>20,'value'=>$patientid)); ?>
		<?php echo $form->error($model,'patient_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::link(CHtml::button('Cancel'),array('DiagFecalysis/admin'),array('style'=>'text-decoration:none;')); ?>
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