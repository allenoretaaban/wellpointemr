<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-allergy-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'foodordrug'); ?>
		<?php echo $form->textField($model,'foodordrug',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'foodordrug'); ?>
	</div>
        
        <div class="row">
                <?php echo $form->labelEx($model,'type'); ?>
                <?php echo $form->dropDownList($model,'type',array('Food'=>'Food','Drug'=>'Drug')); ?>
                <?php echo $form->error($model,'type'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'sideeffects'); ?>
		<?php echo $form->textArea($model,'sideeffects',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sideeffects'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->