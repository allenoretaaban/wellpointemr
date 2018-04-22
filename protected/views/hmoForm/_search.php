<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hmo_billing_id'); ?>
		<?php echo $form->textField($model,'hmo_billing_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hmo_id'); ?>
		<?php echo $form->textField($model,'hmo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_id'); ?>
		<?php echo $form->textField($model,'patient_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_name'); ?>
		<?php echo $form->textField($model,'patient_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'entry_date'); ?>
		<?php echo $form->textField($model,'entry_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avail_date'); ?>
		<?php echo $form->textField($model,'avail_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'control_no'); ?>
		<?php echo $form->textField($model,'control_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'card_no'); ?>
		<?php echo $form->textField($model,'card_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->