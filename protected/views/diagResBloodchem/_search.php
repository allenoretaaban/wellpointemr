<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resultno'); ?>
		<?php echo $form->textField($model,'resultno',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	
	<div class="row">
		<?php echo $form->label($model,'sp_no'); ?>
		<?php echo $form->textField($model,'sp_no',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdate'); ?>
		<?php echo $form->textField($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createby'); ?>
		<?php echo $form->textField($model,'createby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_id'); ?>
		<?php echo $form->textField($model,'patient_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_name'); ?>
		<?php echo $form->textField($model,'patient_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'age'); ?>
		<?php echo $form->textField($model,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'req_doctor'); ?>
		<?php echo $form->textField($model,'req_doctor',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'read_doctor'); ?>
		<?php echo $form->textField($model,'read_doctor',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_last_print'); ?>
		<?php echo $form->textField($model,'date_last_print'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastupdateby'); ?>
		<?php echo $form->textField($model,'lastupdateby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'medtech'); ?>
		<?php echo $form->textField($model,'medtech',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'med_tech_id'); ?>
		<?php echo $form->textField($model,'med_tech_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pathologist'); ?>
		<?php echo $form->textField($model,'pathologist',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pathologist_id'); ?>
		<?php echo $form->textField($model,'pathologist_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'glucose'); ?>
		<?php echo $form->textField($model,'glucose',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bun'); ?>
		<?php echo $form->textField($model,'bun',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creatinine'); ?>
		<?php echo $form->textField($model,'creatinine',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uric_acid'); ?>
		<?php echo $form->textField($model,'uric_acid',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cholesterol'); ?>
		<?php echo $form->textField($model,'cholesterol',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'triglycerides'); ?>
		<?php echo $form->textField($model,'triglycerides',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hdl_c'); ?>
		<?php echo $form->textField($model,'hdl_c',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ldl_c'); ?>
		<?php echo $form->textField($model,'ldl_c',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vldl_c'); ?>
		<?php echo $form->textField($model,'vldl_c',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sgot_ast'); ?>
		<?php echo $form->textField($model,'sgot_ast',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sgpt_alt'); ?>
		<?php echo $form->textField($model,'sgpt_alt',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hba1c'); ?>
		<?php echo $form->textField($model,'hba1c',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_bilirubin'); ?>
		<?php echo $form->textField($model,'total_bilirubin',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direct_bilirubin'); ?>
		<?php echo $form->textField($model,'direct_bilirubin',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indirect_bilirubin'); ?>
		<?php echo $form->textField($model,'indirect_bilirubin',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sodium'); ?>
		<?php echo $form->textField($model,'sodium',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'potassium'); ?>
		<?php echo $form->textField($model,'potassium',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chloride'); ?>
		<?php echo $form->textField($model,'chloride',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'calcium'); ?>
		<?php echo $form->textField($model,'calcium',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<!--div class="row">
		<?php echo $form->label($model,'total_protein'); ?>
		<?php echo $form->textField($model,'total_protein',array('size'=>60,'maxlength'=>250)); ?>
	</div-->

	<div class="row">
		<?php echo $form->label($model,'alkaline_phosphatase'); ?>
		<?php echo $form->textField($model,'alkaline_phosphatase',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other'); ?>
		<?php echo $form->textArea($model,'other',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->