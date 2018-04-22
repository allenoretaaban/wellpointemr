<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'diag-temps-results-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
<h4 style="color:red">Static Info:</h4>  

<?php 
    $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        /*'id',*/
        'diagtemptitle',
        'resultno',
        'createdate', 
        'status',        
        'patient_id',
        'patient_name', 
        'diag_type', 
        /*'age',
        'gender',*/
        /*'req_doctor',
        'read_doctor',
        'date_last_print',
        'lastupdateby',
        'med_tech_id',*/
    ),
)); ?>  
                   
<h4 style="color:red">Editable Info:</h4>  
<div class="row">
        <?php echo $form->labelEx($model,'age'); ?>
        <?php echo $form->textField($model,'age'); ?>
        <?php echo $form->error($model,'age'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'gender'); ?>
        <?php echo $form->dropDownList($model,'gender',array('M'=>'Male','F'=>'Female')); ?>
        <?php echo $form->error($model,'gender'); ?>
    </div>
    
     <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array('Active'=>'Active','Voided'=>'Voided')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    
    <div class="row">
        <b>Result Content</b>
        <?php          
                Yii::import('ext.krichtexteditor.KRichTextEditor');
                $this->widget('KRichTextEditor', array(
                    'model' => $model,
                    'value' => $model->result_content,
                    'attribute' => 'result_content',            
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
    </div>    
	                             

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->