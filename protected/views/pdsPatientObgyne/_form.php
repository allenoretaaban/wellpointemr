<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-patient-obgyne-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'monthlyflag'); ?>
		<?php echo $form->checkBox($model,'monthlyflag'); ?>
		<?php echo $form->error($model,'monthlyflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pregnantflag'); ?>
		<?php echo $form->checkBox($model,'pregnantflag'); ?>
		<?php echo $form->error($model,'pregnantflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastmenstrualperiod'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'lastmenstrualperiod',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'1900'
                                )
                            ),
                            true
                        );
                ?>
		<?php echo $form->error($model,'lastmenstrualperiod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->