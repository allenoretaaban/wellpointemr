<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'itemid'); ?>
		<?php echo $form->textField($model,'itemid',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hmo_form_id'); ?>
		<?php echo $form->textField($model,'hmo_form_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_entry_date'); ?>
		<?php echo $form->textField($model,'item_entry_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_avail_date'); ?>
		<?php echo $form->textField($model,'item_avail_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payto'); ?>
		<?php echo $form->textField($model,'payto',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'claim_doctor_id'); ?>
		<?php echo $form->textField($model,'claim_doctor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'claim_doctor_name'); ?>
		<?php echo $form->textField($model,'claim_doctor_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diagnosis'); ?>
		<?php echo $form->textField($model,'diagnosis',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'med_service'); ?>
		<?php echo $form->textField($model,'med_service',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_type'); ?>
		<?php echo $form->textField($model,'service_type',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'req_doctor'); ?>
		<?php echo $form->textField($model,'req_doctor',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'charge_type'); ?>
		<?php echo $form->textField($model,'charge_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'charge_fee'); ?>
		<?php echo $form->textField($model,'charge_fee'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->