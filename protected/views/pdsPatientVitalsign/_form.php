<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-patient-vitalsign-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <fieldset>
            <legend>BMI</legend>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'height'); ?>
                        <?php echo $form->textField($model,'height'); ?>
                        <?php echo $form->error($model,'height'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'weight'); ?>
                        <?php echo $form->textField($model,'weight'); ?>
                        <?php echo $form->error($model,'weight'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'bmi'); ?>
                        <?php echo $form->textField($model,'bmi'); ?>
                        <?php echo $form->error($model,'bmi'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Blood Pressure</legend>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'bpsystolic'); ?>
                        <?php echo $form->textField($model,'bpsystolic'); ?>
                        <?php echo $form->error($model,'bpsystolic'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'bpdiastolic'); ?>
                        <?php echo $form->textField($model,'bpdiastolic'); ?>
                        <?php echo $form->error($model,'bpdiastolic'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'restedbpsystolic'); ?>
                        <?php echo $form->textField($model,'restedbpsystolic'); ?>
                        <?php echo $form->error($model,'restedbpsystolic'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'restedbpdiastolic'); ?>
                        <?php echo $form->textField($model,'restedbpdiastolic'); ?>
                        <?php echo $form->error($model,'restedbpdiastolic'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'repeatbpsystolic'); ?>
                        <?php echo $form->textField($model,'repeatbpsystolic'); ?>
                        <?php echo $form->error($model,'repeatbpsystolic'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'repeatbpdiastolic'); ?>
                        <?php echo $form->textField($model,'repeatbpdiastolic'); ?>
                        <?php echo $form->error($model,'repeatbpdiastolic'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Other</legend>
            <div class="row">
                    <?php echo $form->labelEx($model,'pulserate'); ?>
                    <?php echo $form->textField($model,'pulserate'); ?>
                    <?php echo $form->error($model,'pulserate'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'respiratoryrate'); ?>
                    <?php echo $form->textField($model,'respiratoryrate'); ?>
                    <?php echo $form->error($model,'respiratoryrate'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'temperature'); ?>
                    <?php echo $form->textField($model,'temperature'); ?>
                    <?php echo $form->error($model,'temperature'); ?>
            </div>
        </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->