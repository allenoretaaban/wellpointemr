<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmo-form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'hmo_name'); ?>
        <small>Search & Select: Type in a character or word to select an HMO Company</small>        
        <?php 
        echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                array(
                        'model'=>$model, 
                        'id'=>'HmoForm_hmo_name',
                        'name'=>'HmoForm[hmo_name]',
                        'attribute'=>'hmo_name',
                        'sourceUrl'=>Yii::app()->createAbsoluteUrl('hmo/lookupbilling', array()),
                        'htmlOptions' => array("size"=>'50'),  
                        'options'=>array(
                                'select'=>'js:function(event,ui){
                                        close();
                                        term=ui.item.value.split(":");
                                        document.getElementById("HmoForm_hmo_id").value=term[0];                                        
                                        ui.item.value=term[1];
                                }'
                        ),

                ),
                true
        );
        ?>                 
        
    </div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'hmo_id'); ?>
	</div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'patient_name'); ?>
        <small>Search & Select: Type in a character or word to select a Patient</small>
         <?php         
        echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
            array(
                    'model'=>$model, 
                    'id'=>'HmoForm_patient_name' ,
                    'name'=>'HmoForm[patient_name]',
                    'attribute'=>'patient_name',
                    'sourceUrl'=>Yii::app()->createAbsoluteUrl('patient/lookuppds', array()),
                    'htmlOptions' => array("size"=>'50'),  
                    'options'=>array(
                            'select'=>'js:function(event,ui){
                                    close();
                                    term=ui.item.value.split(":");
                                    document.getElementById("HmoForm_patient_id").value=term[0];
                                    ui.item.value=term[1];
                            }'
                    ),

            ),
            true
        );
        ?>                                     
    </div>
    
	<div class="row">		
		<?php echo $form->hiddenField($model,'patient_id'); ?>		
	</div>

	<div class="row">	
        <?php echo $form->hiddenField($model,'entry_date', array('value'=>date("Y-m-d")) ); ?>	        
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avail_date'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'avail_date',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'2000'
                                )
                            ),
                            true
                        );
                ?>
        <?php echo $form->error($model,'avail_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'control_no'); ?>
		<?php echo $form->textField($model,'control_no',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'control_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'card_no'); ?>
		<?php echo $form->textField($model,'card_no',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'card_no'); ?>
	</div>
    
    <div class="row">        
        <?php echo $form->hiddenField($model,'hmo_billing_id',array('size'=>20,'maxlength'=>20)); ?>        
    </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
