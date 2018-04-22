<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'announce-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    
    

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php
        Yii::import('ext.krichtexteditor.KRichTextEditor');
        $this->widget('KRichTextEditor', array(
            'model' => $model,
            'value' => $model->isNewRecord ? '' : $model->text,
            'attribute' => 'text',
            'options' => array(
                'theme_advanced_resizing' => 'true',
                'theme_advanced_statusbar_location' => 'bottom',
                'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,fontselect,fontsizeselect,|,hr",
            ),
        ));
    ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">		
		<?php echo $form->hiddenField($model,'byuserid', array('value' => Yii::app()->user->id) ); 
        
        ?>		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->