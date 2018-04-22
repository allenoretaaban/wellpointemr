<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmo-billing-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'hmo_id'); ?>
		<?php echo $form->textField($model,'hmo_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'hmo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prepared_by'); ?>
		<?php echo $form->textField($model,'prepared_by',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'prepared_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'by_userid'); ?>
		<?php echo $form->textField($model,'by_userid',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'by_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_prepared'); ?>
		<?php echo $form->textField($model,'date_prepared'); ?>
		<?php echo $form->error($model,'date_prepared'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_due'); ?>
		<?php echo $form->textField($model,'date_due'); ?>
		<?php echo $form->error($model,'date_due'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pds_hmo_id'); ?>
		<?php echo $form->textField($model,'pds_hmo_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pds_hmo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bill_total'); ?>
		<?php echo $form->textField($model,'bill_total'); ?>
		<?php echo $form->error($model,'bill_total'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->