<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'discount-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
        <small>Type in a character or word to search</small><br/>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'percentage'); ?>      
        <small>Enter percent value only (ex. For 50% enter 50 )</small><br/>
        <small>Enter 0 if not applicable</small><br/>		
        <?php 
        if ($model->percentage > 0){
            echo $form->textField($model,'percentage'); 
        }else{
            echo $form->textField($model,'percentage',array('value'=>0));              
        }
        
        ?>
		<?php echo $form->error($model,'percentage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flat'); ?>
        <small>Enter 0 if not applicable</small><br/>  
		<?php 
        if ($model->flat > 0){
            echo $form->textField($model,'flat'); 
        }else{
            echo $form->textField($model,'flat',array('value'=>0));              
        }
        
        ?>
		<?php echo $form->error($model,'flat'); ?>
	</div>

	<div class="row buttons">
        
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->