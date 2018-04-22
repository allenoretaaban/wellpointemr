<?php
/* @var $this ApeReportsController */
/* @var $model ApeReports */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>     
      
            
    <div class="row">
        <?php echo $form->labelEx($model,'hmo_id'); ?>
        <?php echo $form->dropDownList($model,'hmo_id',
                                CHtml::listData(Hmo::model()->findAll(), 'id', 'name'),
                                array('empty'=>'ALL', 'prompt'=>$model->hmo_id) 
                        );
                ?>
        <?php echo $form->error($model,'hmo_id'); ?>
    </div>                  
    <div class="row">
        <?php echo $form->labelEx($model,'client_id'); ?>
        <?php echo $form->dropDownList($model,'client_id',
                                CHtml::listData(Clients::model()->findAll(), 'client_id', 'client_name'),
                                array('empty'=>'ALL', 'prompt'=>$model->hmo_id)
                        );
                ?>
        <?php echo $form->error($model,'client_id'); ?>
    </div>
    
               
  <div class="row">                                         
    <?php echo $form->labelEx($model,'patient_id'); ?>
    <?php 
        echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                array(
                        'id'=>'patient_name',
                        'name'=>'patient_name',
                        'attribute'=>'id',
                        'sourceUrl'=>Yii::app()->createAbsoluteUrl('ape/lookupApe', array()),  
                        'htmlOptions'=>array(
                            'style'=>'width:288px;',
                        ),
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
    <?php echo $form->error($model,'patient_id'); ?>
    <?php echo $form->hiddenField($model,'patient_id'); ?>
</div>   
    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->