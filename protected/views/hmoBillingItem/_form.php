<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmo-billing-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'hmo'); ?>
        <small>Select HMO Company</small><br/>
        <?php 
        echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                array(
                        'model'=>$model, 
                        'id'=>'HmoBillingItem_hmo',
                        'name'=>'HmoBillingItem[hmo]',
                        'attribute'=>'hmo',
                        'sourceUrl'=>Yii::app()->createAbsoluteUrl('hmo/lookupbilling', array()),
                        'htmlOptions' => array("size"=>'50'),  
                        'options'=>array(
                                'select'=>'js:function(event,ui){
                                        close();
                                        term=ui.item.value.split(":");
                                        document.getElementById("HmoBillingItem_hmo_id").value=term[0];                                        
                                        ui.item.value=term[1];
                                }'
                        ),

                ),
                true
        );
        ?>                  
    </div>
    
    <div class="row">        
        <?php echo $form->hiddenField($model,'hmo_id',array('value'=>$model->hmo_id)); ?>
        <?php echo $form->error($model,'hmo_id'); ?>
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
        <?php echo $form->labelEx($model,'refno'); ?>
        <?php echo $form->textField($model,'refno'); ?>
        <?php echo $form->error($model,'refno'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'approval_code'); ?>
        <?php echo $form->textField($model,'approval_code'); ?>
        <?php echo $form->error($model,'approval_code'); ?>
    </div>     

    <div class="row">
        <?php echo $form->labelEx($model,'patient'); ?>
        <small>Select a patient</small><br/>
        <?php         
        echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
            array(
                    'model'=>$model, 
                    'id'=>'HmoBillingItem_patient_name' ,
                    'name'=>'HmoBillingItem[patient_name]',
                    'attribute'=>'patient_name',
                    'sourceUrl'=>Yii::app()->createAbsoluteUrl('patient/lookuppds', array()),
                    'htmlOptions' => array("size"=>'50'),  
                    'options'=>array(
                            'select'=>'js:function(event,ui){
                                    close();
                                    term=ui.item.value.split(":");
                                    document.getElementById("HmoBillingItem_patient_id").value=term[0];
                                    ui.item.value=term[1];
                            }'
                    ),

            ),
            true
        );
        ?>                                     
    </div>
    
    <div class="row">        
        <?php echo $form->hiddenField($model,'patient_id',array('value'=>$model->patient_id)); ?>
        <?php echo $form->error($model,'patient_id'); ?>
    </div>                  
    
    <div class="row">
        <?php echo $form->labelEx($model,'cardno'); ?>
        <?php echo $form->textField($model,'cardno',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'cardno'); ?>
    </div>
    
    <div class="row">
    <?php echo $form->labelEx($model,'doctor'); ?>
    <small>Select a doctor</small><br/>
    <?php 
    echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
            array(
                    'model'=>$model, 
                    'id'=>'HmoBillingItem_doctor',
                    'name'=>'HmoBillingItem[doctor]',
                    'attribute'=>'doctor',
                    'sourceUrl'=>Yii::app()->createAbsoluteUrl('doctor/lookup', array()),
                    'htmlOptions' => array("size"=>'50'),  
                    'options'=>array(
                            'select'=>'js:function(event,ui){
                                    close();
                                    term=ui.item.value.split(":");
                                    document.getElementById("HmoBillingItem_doctor_id").value=term[0];
                                    ui.item.value=term[1];
                            }'
                    ),

            ),
            true
    );
    ?>
    </div>
    
    <div class="row">        
        <?php echo $form->hiddenField($model,'doctor_id',array('value'=>$model->doctor_id)); ?>
        <?php echo $form->error($model,'doctor_id'); ?>
    </div>           
   
     <div class="row">        
        <?php echo $form->hiddenField($model,'date_entered',array('value'=>$model->date_entered)); ?>
        <?php echo $form->error($model,'date_entered'); ?>
    </div>                  
    
    
	<div class="row">
		<?php echo $form->labelEx($model,'diagnosis'); ?>
		<?php echo $form->textField($model,'diagnosis',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'diagnosis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'medicalservice'); ?>
		<?php echo $form->textField($model,'medicalservice',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'medicalservice'); ?>
	</div>

	 <div class="row">
        <?php echo $form->labelEx($model,'charge_type'); ?>
        <?php echo $form->dropDownList($model,'charge_type', CHtml::listData(HmoChargeType::model()->findAll(), 'id', 'charge_type'), array('empty'=>'--please select--')); ?>
        <?php echo $form->error($model,'charge_type'); ?>
    </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'charge'); ?>
		<?php echo $form->textField($model,'charge'); ?>
		<?php echo $form->error($model,'charge'); ?>    
        <small>Must be an amount.</small>
	</div>
    
    <div class="row">        
        <?php echo $form->hiddenField($model,'by_userid',array('value'=>$model->by_userid)); ?>
        <?php echo $form->error($model,'by_userid'); ?>
    </div> 

    
	<!--div class="row">
		<?php echo $form->labelEx($model,'hmo_billing_id'); ?>
		<?php echo $form->textField($model,'hmo_billing_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'hmo_billing_id'); ?>
	</div-->
    
    
    <?php
    if (intval($model->hmo_billing_id) > 0):
    ?>
        Note: <br/>
        You will not be able to edit this record anymore for it has been been generated with a billing already. <br/>
        If you desires to edit this please contact your system administrator.
    <?php else: ?>
	    <div class="row buttons">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	    </div>
    <?php endif; ?>

<?php $this->endWidget(); ?>

</div><!-- form -->