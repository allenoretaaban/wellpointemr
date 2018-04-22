<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-pregnancyproblem-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                            array(
                                    'model'=>$model,
                                    'attribute'=>'name',
                                    'sourceUrl'=>array('pregnancyproblem/lookup')
                            ),
                            true
                        );
                ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->