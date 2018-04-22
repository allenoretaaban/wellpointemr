<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-patient-appearance-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'item'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                            array(
                                    'model'=>$model,
                                    'attribute'=>'item',
                                    'source'=>array(
                                                'General Appearance',
                                                'Eyes',
                                                'Ears',
                                                'Nose',
                                                'Mouth, Teeth, Gums',
                                                'Dental Caries',
                                                'Dentures',
                                                'Throat',
                                                'Neck',
                                                'Heart',
                                                'Chest/Lungs',
                                                'Breasts',
                                                'Abdomen',
                                                'Genital',
                                                'Rectal',
                                                'Extremities',
                                                'Skin',
                                                'Neurologic',
                                                'Deformity'
                                        )
                            ),
                            true
                        );
                ?>
		<?php echo $form->error($model,'item'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'normalFlag'); ?>
		<?php echo $form->checkBox($model,'normalFlag'); ?>
		<?php echo $form->error($model,'normalFlag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->