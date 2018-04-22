<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'bankid'); ?>
		<?php echo $form->textField($model,'bankid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bank_title'); ?>
		<?php echo $form->textField($model,'bank_title',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->