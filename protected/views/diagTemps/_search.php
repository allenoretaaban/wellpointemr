<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdate'); ?>
		<?php echo $form->textField($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createby'); ?>
		<?php echo $form->textField($model,'createby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updateby'); ?>
		<?php echo $form->textField($model,'updateby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'temp_title'); ?>
		<?php echo $form->textField($model,'temp_title',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->