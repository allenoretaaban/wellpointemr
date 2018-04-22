<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-obstetrical-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'place'); ?>
		<?php echo $form->textField($model,'place',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'place'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gestage'); ?>
		<?php echo $form->textField($model,'gestage'); ?>
		<?php echo $form->error($model,'gestage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mannerofdelivery'); ?>
		<?php echo $form->dropDownList($model,'mannerofdelivery',array('Normal'=>'Normal','Caesarian'=>'Caesarian')); ?>
		<?php echo $form->error($model,'mannerofdelivery'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'babyweight'); ?>
		<?php echo $form->textField($model,'babyweight'); ?>
		<?php echo $form->error($model,'babyweight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'babygender'); ?>
                <?php echo $form->dropDownList($model,'babygender',array('M'=>'Male','F'=>'Female')); ?>
		<?php echo $form->error($model,'babygender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->