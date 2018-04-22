<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <fieldset>
            <legend>HMO</legend>
            <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
                    <?php echo $form->error($model,'name'); ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Address</legend>
            <div class="row">
                    <?php echo $form->labelEx($model,'street1'); ?>
                    <?php echo $form->textField($model,'street1',array('size'=>60,'maxlength'=>64)); ?>
                    <?php echo $form->error($model,'street1'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'street2'); ?>
                    <?php echo $form->textField($model,'street2',array('size'=>60,'maxlength'=>64)); ?>
                    <?php echo $form->error($model,'street2'); ?>
            </div>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'barangay'); ?>
                        <?php echo $form->textField($model,'barangay',array('size'=>20,'maxlength'=>32)); ?>
                        <?php echo $form->error($model,'barangay'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'city'); ?>
                        <?php echo $form->textField($model,'city',array('size'=>20,'maxlength'=>32)); ?>
                        <?php echo $form->error($model,'city'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'province'); ?>
                        <?php echo $form->textField($model,'province',array('size'=>20,'maxlength'=>32)); ?>
                        <?php echo $form->error($model,'province'); ?>
                </div>
            </div>
        </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->