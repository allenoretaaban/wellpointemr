<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-medicationhistory-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'drugortherapy'); ?>
		<?php echo $form->textField($model,'drugortherapy',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'drugortherapy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'presentFlag'); ?>
		<?php echo $form->checkBox($model,'presentFlag'); ?>
		<?php echo $form->error($model,'presentFlag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->