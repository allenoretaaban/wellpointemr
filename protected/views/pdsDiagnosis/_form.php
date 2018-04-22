<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-diagnosis-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'diagnosis'); ?>
		<?php echo $form->textArea($model,'diagnosis',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'diagnosis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommendation'); ?>
		<?php echo $form->textArea($model,'recommendation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'recommendation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doctor'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                            array(
                                    'model'=>$model,
                                    'attribute'=>'doctor',
                                    'sourceUrl'=>array('doctor/lookupDiagnosis')
                            ),
                            true
                        );
                ?>
		<?php echo $form->error($model,'doctor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->