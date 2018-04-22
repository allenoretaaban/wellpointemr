<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dailysheetform-form',
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
		<?php echo $form->labelEx($model,'beginningcash'); ?>
		<?php echo $form->textField($model,'beginningcash'); ?>
		<?php echo $form->error($model,'beginningcash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'supervisorname'); ?>
		<?php echo $form->textField($model,'supervisorname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'supervisorname'); ?>
	</div>

    <fieldset>
        <legend>Denomination</legend>
        <fieldset>
            <legend>Bills</legend>
            <div class="newline">
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination1000'); ?>
		            <?php echo $form->textField($model,'denomination1000'); ?>
		            <?php echo $form->error($model,'denomination1000'); ?>
	            </div>
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination500'); ?>
		            <?php echo $form->textField($model,'denomination500'); ?>
		            <?php echo $form->error($model,'denomination500'); ?>
	            </div>
            </div>
            <div class="newline">
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination200'); ?>
		            <?php echo $form->textField($model,'denomination200'); ?>
		            <?php echo $form->error($model,'denomination200'); ?>
	            </div>
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination100'); ?>
		            <?php echo $form->textField($model,'denomination100'); ?>
		            <?php echo $form->error($model,'denomination100'); ?>
	            </div>
            </div>
            <div class="newline">
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination50'); ?>
		            <?php echo $form->textField($model,'denomination50'); ?>
		            <?php echo $form->error($model,'denomination50'); ?>
	            </div>
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination20'); ?>
		            <?php echo $form->textField($model,'denomination20'); ?>
		            <?php echo $form->error($model,'denomination20'); ?>
	            </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Coins</legend>
            <div class="newline">
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination10'); ?>
		            <?php echo $form->textField($model,'denomination10'); ?>
		            <?php echo $form->error($model,'denomination10'); ?>
	            </div>
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination5'); ?>
		            <?php echo $form->textField($model,'denomination5'); ?>
		            <?php echo $form->error($model,'denomination5'); ?>
	            </div>
            </div>
            <div class="newline">
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination1'); ?>
		            <?php echo $form->textField($model,'denomination1'); ?>
		            <?php echo $form->error($model,'denomination1'); ?>
	            </div>
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination50c'); ?>
		            <?php echo $form->textField($model,'denomination50c'); ?>
		            <?php echo $form->error($model,'denomination50c'); ?>
	            </div>
            </div>
            <div class="newline">
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination25c'); ?>
		            <?php echo $form->textField($model,'denomination25c'); ?>
		            <?php echo $form->error($model,'denomination25c'); ?>
	            </div>
	            <div class="row line">
		            <?php echo $form->labelEx($model,'denomination10c'); ?>
		            <?php echo $form->textField($model,'denomination10c'); ?>
		            <?php echo $form->error($model,'denomination10c'); ?>
	            </div>
            </div>
            <div class="newline">
	            <div class="row">
		            <?php echo $form->labelEx($model,'denomination5c'); ?>
		            <?php echo $form->textField($model,'denomination5c'); ?>
		            <?php echo $form->error($model,'denomination5c'); ?>
	            </div>
            </div>
        </fieldset>
    </fieldset>

    <fieldset>
        <legend>HMO Census</legend>
        <div class="row">
            <?php echo $form->labelEx($model,'hmocensus_laboratory'); ?>
            <?php echo $form->textField($model,'hmocensus_laboratory'); ?>
            <?php echo $form->error($model,'hmocensus_laboratory'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'hmocensus_ancillary'); ?>
            <?php echo $form->textField($model,'hmocensus_ancillary'); ?>
            <?php echo $form->error($model,'hmocensus_ancillary'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'hmocensus_consultation'); ?>
            <?php echo $form->textField($model,'hmocensus_consultation'); ?>
            <?php echo $form->error($model,'hmocensus_consultation'); ?>
        </div>
    </fieldset>

	<div class="row">
		<?php echo $form->labelEx($model,'verifiedby'); ?>
		<?php echo $form->textField($model,'verifiedby',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'verifiedby'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->