<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmo-product-service-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array('Service'=>'Service','Product'=>'Product')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php 
			echo $form->dropDownList($model,'category',array(
				'Aesthetics'=>'Aesthetics',
				'Annual Physical Exam'=>'Annual Physical Exam',
				'Aesthetics'=>'Aesthetics',
				'Laboratory'=>'Laboratory',
				'Medical'=>'Medical',
				'Others'=>'Others',
				'Radiology and Ancillary'=>'Radiology and Ancillary',
				'Rehabilitation Medicine And Physical Therapy'=>'Rehabilitation Medicine And Physical Therapy'
			)); 
		?>
		<?php //echo $form->textField($model,'category',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isvatable'); ?>
		<?php echo $form->checkBox($model,'isvatable'); ?>
		<?php echo $form->error($model,'isvatable'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->