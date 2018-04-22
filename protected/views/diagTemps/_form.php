<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'diag-temps-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?
    if (Yii::app()->controller->action->id == 'create'):
    ?>
	<div class="row">		
		<?php echo $form->hiddenField($model,'createdate', array("value" => date('Y-m-d'))); ?>		
	</div>

	<div class="row">		
		<?php echo $form->hiddenField($model,'createby', array("value" => Yii::app()->user->id)); ?>		
	</div>
    
    <? endif; ?>
    
	<div class="row">		
		<?php echo $form->hiddenField($model,'updateby',array("value" => Yii::app()->user->id)); ?>		
	</div>        

	<div class="row">
		<?php echo $form->labelEx($model,'temp_title'); ?>
		<?php echo $form->textField($model,'temp_title',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'temp_title'); ?><br/>
        <span style="color:#808000">*The title of the template for reference</span>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'result_title'); ?>
        <?php echo $form->textField($model,'result_title',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'result_title'); ?><br/>
        <span style="color:#808000">*The title of the result to be used on printing</span>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'diag_type'); ?>        
        <?php echo $form->dropDownList($model,'diag_type',array('ANCILLARY'=>'Ancillary','LABORATORY'=>'Laboratory')); ?>
        <?php echo $form->error($model,'diag_type'); ?>
    </div>
    
    <br/>   
    
    <div class="row">             
        <?php echo $form->labelEx($model,'content_format'); ?>
        <div style="color: royalblue;">
        <span style="color: #FF0000;">Special Data Fill tags:</span><br/>
        [user_personalname] = First Name and Last Name of currenct user<br/>
        [user_joblicenseno] = License No. of current user              <br/>        
        [date_released] = Date Result is Created
        
        </div>
        <?php
        Yii::import('ext.krichtexteditor.KRichTextEditor');
        $this->widget('KRichTextEditor', array(
            'model' => $model,
            'value' => $model->isNewRecord ? '' : $model->content_format,
            'attribute' => 'content_format',            
            'options' => array(
                'width' => '612',
                'height' => '750',                
                'plugins' => 'table',
                'theme_advanced_resizing' => 'true',
                'theme_advanced_statusbar_location' => 'bottom',
                'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,|,hr,table",
            ),
        ));
        ?>
        <?php echo $form->error($model,'content_format'); ?>
        
    </div>     

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->