<div class="view">
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resultno')); ?>:</b>
	<?php echo CHtml::encode($data->resultno); ?>
	<br />
    

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdate')); ?>:</b>
	<?php echo CHtml::encode($data->createdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('result_content')); ?>:</b>
	<?php echo CHtml::encode($data->result_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('age')); ?>:</b>
	<?php echo CHtml::encode($data->age); ?>
	<br />

	<?php /*
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('med_tech_id')); ?>:</b>
	<?php echo CHtml::encode($data->med_tech_id); ?>
	<br />

	*/ ?>

</div>