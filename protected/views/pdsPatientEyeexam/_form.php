<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-patient-eyeexam-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <fieldset>
            <legend>Lashes</legend>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'leftlashes'); ?>
                        <?php echo $form->textField($model,'leftlashes',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'leftlashes'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'rightlashes'); ?>
                        <?php echo $form->textField($model,'rightlashes',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'rightlashes'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Cornea</legend>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'leftcornea'); ?>
                        <?php echo $form->textField($model,'leftcornea',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'leftcornea'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'rightcornea'); ?>
                        <?php echo $form->textField($model,'rightcornea',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'rightcornea'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Ant. Chamber</legend>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'rightantchamber'); ?>
                        <?php echo $form->textField($model,'rightantchamber',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'rightantchamber'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'leftantchamber'); ?>
                        <?php echo $form->textField($model,'leftantchamber',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'leftantchamber'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Iris</legend>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'leftiris'); ?>
                        <?php echo $form->textField($model,'leftiris',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'leftiris'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'rightiris'); ?>
                        <?php echo $form->textField($model,'rightiris',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'rightiris'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Pupil</legend>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'leftpupil'); ?>
                        <?php echo $form->textField($model,'leftpupil',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'leftpupil'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'rightpupil'); ?>
                        <?php echo $form->textField($model,'rightpupil',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'rightpupil'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Lens</legend>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'leftlens'); ?>
                        <?php echo $form->textField($model,'leftlens',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'leftlens'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'rightlens'); ?>
                        <?php echo $form->textField($model,'rightlens',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'rightlens'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>EOMS</legend>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'lefteoms'); ?>
                        <?php echo $form->textField($model,'lefteoms',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'lefteoms'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'righteoms'); ?>
                        <?php echo $form->textField($model,'righteoms',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'righteoms'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Funduscopy</legend>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'leftfunduscopy'); ?>
                        <?php echo $form->textField($model,'leftfunduscopy',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'leftfunduscopy'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'rightfunduscopy'); ?>
                        <?php echo $form->textField($model,'rightfunduscopy',array('size'=>60,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'rightfunduscopy'); ?>
                </div>
            </div>
        </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->