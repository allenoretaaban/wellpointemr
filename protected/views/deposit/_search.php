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
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>32,'maxlength'=>32)); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'checkno'); ?>
        <?php echo $form->textField($model,'checkno',array('size'=>16,'maxlength'=>32)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'checkdate'); ?>
        <?php echo $form->textField($model,'checkdate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'checkbank'); ?>
        <?php echo $form->textField($model,'checkbank',array('size'=>32,'maxlength'=>64)); ?>
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