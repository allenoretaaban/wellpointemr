<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-hmo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cardno'); ?>
		<?php echo $form->textField($model,'cardno',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'cardno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'controlno'); ?>
		<?php echo $form->textField($model,'controlno',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'controlno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approvalcode'); ?>
		<?php echo $form->textField($model,'approvalcode',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'approvalcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hmo_id'); ?>
		<?php echo $form->dropDownList($model,'hmo_id',
                            array(
                                    CHtml::listData(Hmo::model()->findAll(), 'id', 'name')
                            )
                        );
                ?>
		<?php echo $form->error($model,'hmo_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->