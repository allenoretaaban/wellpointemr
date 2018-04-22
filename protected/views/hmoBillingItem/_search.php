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
        <?php echo $form->label($model,'refno'); ?>
        <?php echo $form->textField($model,'refno'); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'avail_date'); ?>
		<?php echo $form->textField($model,'avail_date'); ?>
	</div>
    
    <div class="row">
        <?php echo $form->label($model,'hmo'); ?>
        <?php echo $form->textField($model,'hmo'); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'date_entered'); ?>
		<?php echo $form->textField($model,'date_entered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_id'); ?>
		<?php echo $form->textField($model,'patient_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_name'); ?>
		<?php echo $form->textField($model,'patient_name',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doctor_id'); ?>
		<?php echo $form->textField($model,'doctor_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doctor'); ?>
		<?php echo $form->textField($model,'doctor',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diagnosis'); ?>
		<?php echo $form->textField($model,'diagnosis',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'medicalservice'); ?>
		<?php echo $form->textField($model,'medicalservice',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'charge_type'); ?>
		<?php echo $form->textField($model,'charge_type',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'charge'); ?>
		<?php echo $form->textField($model,'charge'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'by_userid'); ?>
		<?php echo $form->textField($model,'by_userid',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hmo_billing_id'); ?>
		<?php echo $form->textField($model,'hmo_billing_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->