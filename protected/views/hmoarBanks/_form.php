<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmoar-banks-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'bank_title'); ?>
		<?php echo $form->textField($model,'bank_title',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'bank_title'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->