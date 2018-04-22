<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmo-form-items-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

  
	<div class="row">		
		<?php echo $form->hiddenField($model,'hmo_form_id', array('value'=>$_GET["id"])); ?>		
	</div>
    <!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'item_entry_date'); ?>
		<?php echo $form->textField($model,'item_entry_date'); ?>
		<?php echo $form->error($model,'item_entry_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_avail_date'); ?>
		<?php echo $form->textField($model,'item_avail_date'); ?>
		<?php echo $form->error($model,'item_avail_date'); ?>
	</div-->

	<div class="row">				        
        <?php echo $form->labelEx($model,'payto'); ?>
        <?php echo $form->dropDownList($model,'payto',array('WPCLINIC'=>'WellPoint Clinic','DOCTOR'=>'Doctor')); ?>
        <?php echo $form->error($model,'payto'); ?>        
	</div>

	<div class="row">
		<label>Doctor Name (The claimant doctor if payable to the doctor)</label>
        <small>Search & Select: Type in a character or word to search a doctor name </small>	   
        <?php 
            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model, 
                            'id'=>'HmoFormItems_claim_doctor_name',
                            'name'=>'HmoFormItems[claim_doctor_name]',
                            'attribute'=>'claim_doctor_name',
                            'sourceUrl'=>Yii::app()->createAbsoluteUrl('doctor/lookup', array()),
                            'htmlOptions' => array("size"=>'50', "onblur"=>"checkIfEmtpry(this)"),  
                            'options'=>array(
                                    'select'=>'js:function(event,ui){
                                            close();
                                            term=ui.item.value.split(":");
                                            document.getElementById("HmoFormItems_claim_doctor_id").value=term[0];
                                            ui.item.value=term[1];
                                    }'                                    
                            ),

                    ),
                    true
            );
        ?>
        
	</div>
    <script>
     function checkIfEmtpry(el){
         if(el.value == ''){
             document.getElementById("HmoFormItems_claim_doctor_id").value=0;
         }
     }
    </script>
    
    <div class="row">        
        <?php echo $form->hiddenField($model,'claim_doctor_id'); ?>        
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'diagnosis'); ?>
		<?php echo $form->textField($model,'diagnosis',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'diagnosis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'med_service'); ?>
		<?php echo $form->textField($model,'med_service',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'med_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_type'); ?>		
        <?php echo $form->dropDownList($model,'service_type',array('DIAGNOSTIC'=>'Diagnostic','CONSULTATION'=>'Consultation','APE'=>'Annual Physical Exam')); ?>
		<?php echo $form->error($model,'service_type'); ?>
	</div>

	<!--div class="row">
        <?php echo $form->labelEx($model,'hmo_department'); ?>
        <?php //echo $form->textField($model,'bank_id'); ?>
        <?php 
	        $connection=Yii::app()->db;
	        $sql = 'select parent from authitemchild as aic group by parent';	       
	        $command = $connection->createCommand($sql);
	        $row = $command->queryAll();
	       	$datas = null; $i = 0;
			foreach ($row as $data) {
				$datas[$data['parent']] = $data['parent'];
			}

        	echo $form->dropDownList($model,'hmo_department',$datas);
        ?>
	</div-->

	<div class="row">
		<?php echo $form->labelEx($model,'req_doctor'); ?>
        <small>Type in the name of the requesting physician.</small><br/>
		<?php echo $form->textField($model,'req_doctor',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'req_doctor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'charge_type'); ?>		
<?php echo $form->dropDownList($model,'charge_type',array('CCHARGE'=>'Clinic Charge','PROCEDURE'=>'Procedure','PROF_FEE'=>'Professional Fee')); ?>		<?php echo $form->error($model,'charge_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'charge_fee'); ?>
		<?php echo $form->textField($model,'charge_fee'); ?>
		<?php echo $form->error($model,'charge_fee'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->