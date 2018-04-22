<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'visitreason'); ?>
		<?php echo $form->textArea($model,'visitreason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'visitreason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datevisited'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'datevisited',
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
		<?php echo $form->error($model,'datevisited'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->