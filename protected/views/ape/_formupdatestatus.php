<?php
/* @var $this ApeController */
/* @var $model Ape */
/* @var $form CActiveForm */
?>

<script type="text/javascript">         
$(document).ready(function(){   
    $('#ape-update-status').submit(function(){        
        var date_completed = $('#Ape_date_completed'); 
        var date_completed_value = $('#Ape_date_completed').val().trim(); 
        if(date_completed_value == ""){
            alert('please insert date of completion');        
            return false;
        }       
        var r = confirm("This will not be edited anymore, would you like to continue?");
        if (r == true) {   
            date_completed.val(date_completed_value);     
            return true;
        } else {               
            return false;         
        }      
    });
});        
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ape-update-status',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php $model->date_completed = date('Y-m-d');  // default date ?>
        <?php echo $form->labelEx($model,'date_completed'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'date_completed',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'1900'
                                ),
                                'htmlOptions'=>array(
                                    'required'=>'required'
                                ),
                            ),
                            true
                        );
                ?>
        <?php echo $form->error($model,'date_completed'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'remarks'); ?>
        <?php echo $form->textArea($model,'remarks', array('maxlength' => 300, 'rows' => 6, 'cols' => 50, 'placeholder'=>'Leave your remarks here...')); ?>
        <?php echo $form->error($model,'remarks'); ?>
    </div>


    
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->