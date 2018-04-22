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
		<?php echo $form->label($model,'hmo_id'); ?>
		<?php echo $form->textField($model,'hmo_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prepared_by'); ?>
		<?php echo $form->textField($model,'prepared_by',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'by_userid'); ?>
		<?php echo $form->textField($model,'by_userid',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_prepared'); ?>
		<?php echo $form->textField($model,'date_prepared'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_due'); ?>
		<?php echo $form->textField($model,'date_due'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pds_hmo_id'); ?>
		<?php echo $form->textField($model,'pds_hmo_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bill_total'); ?>
		<?php echo $form->textField($model,'bill_total'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->