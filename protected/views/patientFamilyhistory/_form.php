<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-familyhistory-form',
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
                                    'sourceUrl'=>array('familyhistory/lookup')
                            ),
                            true
                        );
                ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'relation'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                            array(
                                    'model'=>$model,
                                    'attribute'=>'relation',
                                    'source'=>array('Parent', 'Sibling', 'Half-Sibling', 'Grandparent', 'Great-Grandparent', 'Niece', 'Nephew', 'Aunt', 'Uncle', 'Son', 'Daughter')
                            ),
                            true
                        );
                ?>
		<?php echo $form->error($model,'relation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agedetected'); ?>
		<?php echo $form->textField($model,'agedetected'); ?>
		<?php echo $form->error($model,'agedetected'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancertype'); ?>
		<?php echo $form->textField($model,'cancertype',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'cancertype'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->