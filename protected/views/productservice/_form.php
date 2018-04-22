<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'productservice-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array('Service'=>'Service','Product'=>'Product')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'provider'); ?>
        <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model,
                            'attribute'=>'provider',
                            'source'=>array('Laboratory','Ancillary','Consultation','O.R. Use','E.R. Use','Medical Certificate','Annual Package A','Annual Package B','Annual Package C','Gold Card','Silver Card','Bronze Card','Basic Priviledge','Premium Package','Pre-Natal','Medicine/Vaccine','Physical Medicine and Rehabilitation')
                    ),
                    true
                );
        ?>
        <?php echo $form->error($model,'provider'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'isvatable'); ?>
		<?php echo $form->checkBox($model,'isvatable'); ?>
		<?php echo $form->error($model,'isvatable'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->