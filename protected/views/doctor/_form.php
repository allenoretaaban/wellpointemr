<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <fieldset>
            <legend>Personal</legend>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model, 'image'); ?>
                        <?php echo $form->fileField($model, 'image'); ?>
                        <?php echo $form->error($model, 'image'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'firstname'); ?>
                        <?php echo $form->textField($model,'firstname',array('size'=>30,'maxlength'=>50)); ?>
                        <?php echo $form->error($model,'firstname'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'lastname'); ?>
                        <?php echo $form->textField($model,'lastname',array('size'=>30,'maxlength'=>50)); ?>
                        <?php echo $form->error($model,'lastname'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'isresident'); ?>
                        <?php echo $form->dropDownList($model,'isresident',array('1'=>'YES','0'=>'NO')); ?>
                        <?php echo $form->error($model,'isresident'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Professional</legend>
            <div class="row">
                    <?php echo $form->labelEx($model,'specialization'); ?>
                    <?php echo $form->textField($model,'specialization',array('size'=>50,'maxlength'=>128)); ?>
                    <?php echo $form->error($model,'specialization'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'prcno'); ?>
                    <?php echo $form->textField($model,'prcno',array('size'=>30,'maxlength'=>64)); ?>
                    <?php echo $form->error($model,'prcno'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'pmano'); ?>
                    <?php echo $form->textField($model,'pmano',array('size'=>30,'maxlength'=>64)); ?>
                    <?php echo $form->error($model,'pmano'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'tinno'); ?>
                    <?php echo $form->textField($model,'tinno',array('size'=>30,'maxlength'=>64)); ?>
                    <?php echo $form->error($model,'tinno'); ?>
            </div>
             
        </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->