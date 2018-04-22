<?php
/* @var $this ApeController */
/* @var $model Ape */
/* @var $form CActiveForm */
?>

<script type="text/javascript">         
$('#ape-form').submit(function(){   
    if($('#patient_name').val()==''){  
        alert("Error: Patient name is blank.")
        return false;
    }
});
</script>

<div class="form">
      
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ape-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'ape_type'); ?>
        <?php
        $options = array ('In-House' => 'In-House', 'Corporate' => 'Corporate');
        //echo CHtml::dropDownList('ape_type', 'Corporate', $options);
        echo $form->dropDownList($model,'ape_type',$options);
        ?>
        <?php echo $form->error($model,'ape_type'); ?>
    </div>
                               
    <div class="row">
        <?php echo $form->labelEx($model,'client_id'); ?>
        <?php echo $form->dropDownList($model,'client_id',
        CHtml::listData(Clients::model()->findAll(), 'client_id', 'client_name'));?>   
        <?php echo $form->error($model,'client_id'); ?>
    </div>    
    
    <div class="row">
        <?php echo $form->labelEx($model,'employee_id'); ?>
        <?php echo $form->textField($model,'employee_id',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'employee_id'); ?>
    </div> 
    
     <div class="row">
        <?php echo $form->labelEx($model,'hmo_id'); ?>
        <?php echo $form->dropDownList($model,'hmo_id',
        CHtml::listData(Hmo::model()->findAll(), 'id', 'name'));?>
        <?php echo $form->error($model,'hmo_id'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'hmo_member_id'); ?>
        <?php echo $form->textField($model,'hmo_member_id',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'hmo_member_id'); ?>
    </div>  
    
    <div class="row">
        <?php echo $form->labelEx($model,'datevisited'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'datevisited',
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
        <?php echo $form->error($model,'datevisited'); ?>
    </div>
                
    <div class="row"> 
        <?php echo $form->labelEx($model,'patient_id'); ?>
        <?php echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                array(
                        'id'=>'patient_name',
                        'name'=>'patient_name',
                        'attribute'=>'id',
                        'sourceUrl'=>Yii::app()->createAbsoluteUrl('ape/lookupApe', array()),
                        'options'=>array(
                                'select'=>'js:function(event,ui){
                                        close();
                                        term=ui.item.value.split(":");
                                        document.getElementById("Ape_patient_id").value=term[0];
                                        ui.item.value=term[1];
                                }'
                        ),
                        'value'=>($model->patient->firstname)?$model->patient->firstname." ".$model->patient->lastname:"",  
                ),  
                true
            );
        ?> 
        <?php echo $form->hiddenField($model,'patient_id'); ?> 
        <?php echo $form->error($model,'patient_id'); ?>
    </div>   
    
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->