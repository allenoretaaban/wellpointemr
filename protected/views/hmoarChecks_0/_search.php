<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'checkid'); ?>
		<?php echo $form->textField($model,'checkid',array('size'=>14,'maxlength'=>14)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_no'); ?>
		<?php echo $form->textField($model,'check_no',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_date'); ?>
		<?php echo $form->textField($model,'check_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_clear_date'); ?>
		<?php echo $form->textField($model,'check_clear_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bank_id'); ?>
		<?php echo $form->textField($model,'bank_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hmo_id'); ?>
		<?php echo $form->textField($model,'hmo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payto'); ?>
		<?php echo $form->textField($model,'payto',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_doc_id'); ?>
		<?php echo $form->textField($model,'pay_doc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'check_amnt'); ?>
		<?php echo $form->textField($model,'check_amnt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'billed_amnt'); ?>
		<?php echo $form->textField($model,'billed_amnt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wtax_amnt'); ?>
		<?php echo $form->textField($model,'wtax_amnt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->