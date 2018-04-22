<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-hmo-form',
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
        <?php echo $form->labelEx($model,'hmo_id'); ?>
        <?php echo $form->dropDownList($model,'hmo_id',
                            array(
                                    CHtml::listData(Hmo::model()->findAll(), 'id', 'name')
                            )
                        );
                ?>
        <?php echo $form->error($model,'hmo_id'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'primaryname'); ?>
		<?php echo $form->textField($model,'primaryname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'primaryname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primarybirthdate'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'primarybirthdate',
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
		<?php echo $form->error($model,'primarybirthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primaryFlag'); ?>
		<?php echo $form->checkBox($model,'primaryFlag'); ?>
		<?php echo $form->error($model,'primaryFlag'); ?>
	</div>         

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->