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
        <?php echo $form->labelEx($model,'id'); ?>
        <?php echo $form->textField($model,'id'); ?>
        <?php echo $form->error($model,'id'); ?>
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
                   
    <div class="row">
        <label for="ApeReports_datefrom">Date From:</label>
                <?php  
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'from_date',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));
                ?>                                      
    </div>
    <div class="row">
        <label for="ApeReports_datefrom">Date To:</label>
                <?php  
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'to_date',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));
                ?>                                      
    </div>    
               
    <div class="row">
        <?php echo $form->labelEx($model,'hmo_id'); ?>
        <?php echo $form->dropDownList($model,'hmo_id',
                                CHtml::listData(Hmo::model()->findAll(array('order'=>'name')), 'id', 'name'),
                                array('empty'=>'', 'prompt'=>$model->hmo_id)
                        );
                ?>
        <?php echo $form->error($model,'hmo_id'); ?>
    </div>                  
    <div class="row">
        <?php echo $form->labelEx($model,'client_id'); ?>
        <?php echo $form->dropDownList($model,'client_id',
                                CHtml::listData(Clients::model()->findAll(array('order'=>'client_name')), 'client_id', 'client_name'),
                                array('empty'=>'', 'prompt'=>$model->hmo_id)
                        );
                ?>
        <?php echo $form->error($model,'client_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ape_type'); ?>
        <?php
        $options = array ('' => 'All', 'In-House' => 'In-House', 'Corporate' => 'Corporate');
        //echo CHtml::dropDownList('ape_type', 'In-House', $options);
        echo $form->dropDownList($model,'ape_type',$options);
        ?>
        <?php echo $form->error($model,'ape_type'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->