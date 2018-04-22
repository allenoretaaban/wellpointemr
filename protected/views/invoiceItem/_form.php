<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
        <small>Type in a character or word to search</small><br/>
        <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model,
                            'attribute'=>'description',
                            'sourceUrl'=>array('productservice/lookup'),
                            'options'=>array(
                                    'select'=>'js:function(event,ui){
                                            close();
                                            term=ui.item.value.split(":");
                                            document.getElementById("InvoiceItem_amount").value=term[1];
                                            if (term[2] == "1"){                                                
                                                document.getElementById("InvoiceItem_isvatable").checked="checked";
                                            }else{
                                                document.getElementById("InvoiceItem_isvatable").checked="";    
                                            }   
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
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'isvatable'); ?>
        <?php echo $form->checkBox($model,'isvatable'); ?>
        <?php echo $form->error($model,'isvatable'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'discount'); ?>
        <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model,
                            'attribute'=>'discount',
                            'sourceUrl'=>array('discount/lookup'),
                            'options'=>array(
                                    'select'=>'js:function(event,ui){
                                            close();
                                            term=ui.item.value.split(":");
                                            document.getElementById("InvoiceItem_discountflat").value=term[1];
                                            document.getElementById("InvoiceItem_discountpercentage").value=term[2];
                                            ui.item.value=term[0];
                                    }'
                            ),
                    ),
                    true
                );
        ?>
		<?php echo $form->error($model,'discount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discountflat'); ?>
		<?php echo $form->textField($model,'discountflat'); ?>
		<?php echo $form->error($model,'discountflat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discountpercentage'); ?>
		<?php echo $form->textField($model,'discountpercentage'); ?>
		<?php echo $form->error($model,'discountpercentage'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->