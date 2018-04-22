<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-discount-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
        <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model,
                            'attribute'=>'description',
                            'sourceUrl'=>array('discount/lookup'),
                            'options'=>array(
                                    'select'=>'js:function(event,ui){
                                            close();
                                            term=ui.item.value.split(":");
                                            document.getElementById("InvoiceDiscount_flat").value=term[1];
                                            document.getElementById("InvoiceDiscount_percentage").value=term[2];
                                            ui.item.value=term[0];
                                    }'
                            ),
                    ),
                    true
                );
        ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flat'); ?>
		<?php echo $form->textField($model,'flat'); ?>
		<?php echo $form->error($model,'flat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'percentage'); ?>
		<?php echo $form->textField($model,'percentage'); ?>
		<?php echo $form->error($model,'percentage'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->