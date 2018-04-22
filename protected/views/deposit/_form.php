<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deposit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'date'); ?>
        <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'model'=>$model,
                        'attribute'=>'date',
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
        <?php echo $form->error($model,'date'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
        <?php echo $form->dropDownList($model,'category',array('MF'=>'MF','JF'=>'JF','HMO'=>'HMO','Other'=>'Other')); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model,'type',array('Cash'=>'Cash','Check'=>'Check')); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>

    <fieldset>
        <legend>Check</legend>
        <div class="row">
            <?php echo $form->labelEx($model,'checkno'); ?>
            <?php echo $form->textField($model,'checkno',array('size'=>16,'maxlength'=>32)); ?>
            <?php echo $form->error($model,'checkno'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'checkdate'); ?>
            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                        array(
                            'model'=>$model,
                            'attribute'=>'checkdate',
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
            <?php echo $form->error($model,'checkdate'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'checkbank'); ?>
            <?php echo $form->textField($model,'checkbank',array('size'=>32,'maxlength'=>64)); ?></a>
            <?php echo $form->error($model,'checkbank'); ?>
        </div>
    </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->