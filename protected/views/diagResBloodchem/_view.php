<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resultno')); ?>:</b>
	<?php echo CHtml::encode($data->resultno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagtempid')); ?>:</b>
	<?php echo CHtml::encode($data->diagtempid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagtemptitle')); ?>:</b>
	<?php echo CHtml::encode($data->diagtemptitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sp_no')); ?>:</b>
	<?php echo CHtml::encode($data->sp_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdate')); ?>:</b>
	<?php echo CHtml::encode($data->createdate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('createby')); ?>:</b>
	<?php echo CHtml::encode($data->createby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_name')); ?>:</b>
	<?php echo CHtml::encode($data->patient_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('age')); ?>:</b>
	<?php echo CHtml::encode($data->age); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_doctor')); ?>:</b>
	<?php echo CHtml::encode($data->req_doctor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('read_doctor')); ?>:</b>
	<?php echo CHtml::encode($data->read_doctor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_last_print')); ?>:</b>
	<?php echo CHtml::encode($data->date_last_print); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastupdateby')); ?>:</b>
	<?php echo CHtml::encode($data->lastupdateby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('medtech')); ?>:</b>
	<?php echo CHtml::encode($data->medtech); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('med_tech_id')); ?>:</b>
	<?php echo CHtml::encode($data->med_tech_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pathologist')); ?>:</b>
	<?php echo CHtml::encode($data->pathologist); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pathologist_id')); ?>:</b>
	<?php echo CHtml::encode($data->pathologist_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('glucose')); ?>:</b>
	<?php echo CHtml::encode($data->glucose); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bun')); ?>:</b>
	<?php echo CHtml::encode($data->bun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creatinine')); ?>:</b>
	<?php echo CHtml::encode($data->creatinine); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uric_acid')); ?>:</b>
	<?php echo CHtml::encode($data->uric_acid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cholesterol')); ?>:</b>
	<?php echo CHtml::encode($data->cholesterol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('triglycerides')); ?>:</b>
	<?php echo CHtml::encode($data->triglycerides); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hdl_c')); ?>:</b>
	<?php echo CHtml::encode($data->hdl_c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ldl_c')); ?>:</b>
	<?php echo CHtml::encode($data->ldl_c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vldl_c')); ?>:</b>
	<?php echo CHtml::encode($data->vldl_c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sgot_ast')); ?>:</b>
	<?php echo CHtml::encode($data->sgot_ast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sgpt_alt')); ?>:</b>
	<?php echo CHtml::encode($data->sgpt_alt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hba1c')); ?>:</b>
	<?php echo CHtml::encode($data->hba1c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_bilirubin')); ?>:</b>
	<?php echo CHtml::encode($data->total_bilirubin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direct_bilirubin')); ?>:</b>
	<?php echo CHtml::encode($data->direct_bilirubin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indirect_bilirubin')); ?>:</b>
	<?php echo CHtml::encode($data->indirect_bilirubin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sodium')); ?>:</b>
	<?php echo CHtml::encode($data->sodium); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('potassium')); ?>:</b>
	<?php echo CHtml::encode($data->potassium); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('calcium')); ?>:</b>
	<?php echo CHtml::encode($data->calcium); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_protein')); ?>:</b>
	<?php echo CHtml::encode($data->total_protein); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alkaline_phosphatase')); ?>:</b>
	<?php echo CHtml::encode($data->alkaline_phosphatase); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
	<?php echo CHtml::encode($data->other); ?>
	<br />

	*/ ?>

</div>