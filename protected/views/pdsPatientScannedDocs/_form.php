<style>
#PdsPatientScannedDocs_description{
    width: 380px;
    height: 90px;
}
#PdsPatientScannedDocs_title{
    width: 300px;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-patient-scanneddocs-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <fieldset>
            <legend>BMI</legend>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'title'); ?>
                        <?php echo $form->textField($model,'title'); ?>
                        <?php echo $form->error($model,'title'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'description'); ?>
                        <?php echo $form->textArea($model,'description'); ?>
                        <?php echo $form->error($model,'description'); ?>
                        
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>BMI</legend>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'file'); ?>
                        <?php echo $form->fileField($model,'file'); ?>
                        <?php echo $form->error($model,'file'); ?>
                </div>
            </div>
        </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Upload' : 'Update'); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
/*
getDescription = function(){
    var strDescri = document.getElementById('PdsPatientScannedDocs_description').innerHTML ;
    document.getElementById('PdsPatientScannedDocs_description').setAttribute('name','') ;
    if(strDescri != ''){
        document.getElementById('description').value(strDescri);
        document.getElementById('description').setAttribute('name','PdsPatientScannedDocs[description]') ;
        document.getElementById('description').setAttribute('id','PdsPatientScannedDocs_description') ;
        return true;
    }else{
        document.getElementById('description').value('');  
        return false;      
    }
}
*/
</script>
</div><!-- form -->