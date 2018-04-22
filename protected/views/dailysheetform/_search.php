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
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'beginningcash'); ?>
		<?php echo $form->textField($model,'beginningcash'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'supervisorname'); ?>
		<?php echo $form->textField($model,'supervisorname',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination1000'); ?>
		<?php echo $form->textField($model,'denomination1000'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination500'); ?>
		<?php echo $form->textField($model,'denomination500'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination200'); ?>
		<?php echo $form->textField($model,'denomination200'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination100'); ?>
		<?php echo $form->textField($model,'denomination100'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination50'); ?>
		<?php echo $form->textField($model,'denomination50'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination20'); ?>
		<?php echo $form->textField($model,'denomination20'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination10'); ?>
		<?php echo $form->textField($model,'denomination10'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination5'); ?>
		<?php echo $form->textField($model,'denomination5'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination1'); ?>
		<?php echo $form->textField($model,'denomination1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination50c'); ?>
		<?php echo $form->textField($model,'denomination50c'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination25c'); ?>
		<?php echo $form->textField($model,'denomination25c'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination10c'); ?>
		<?php echo $form->textField($model,'denomination10c'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'denomination5c'); ?>
		<?php echo $form->textField($model,'denomination5c'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'verifiedby'); ?>
		<?php echo $form->textField($model,'verifiedby',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preparedby'); ?>
		<?php echo $form->textField($model,'preparedby',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->