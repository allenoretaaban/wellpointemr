<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avail_date')); ?>:</b>
	<?php echo CHtml::encode($data->avail_date); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('hmo')); ?>:</b>
    <?php echo CHtml::encode($data->hmo); ?>
    <br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('refno')); ?>:</b>
    <?php echo CHtml::encode($data->refno); ?>
    <br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('approval_code')); ?>:</b>
    <?php echo CHtml::encode($data->approval_code); ?>
    <br />
    
    <!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_entered')); ?>:</b>
	<?php echo CHtml::encode($data->date_entered); ?>
	<br />
    -->

    <!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />
    --> 

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_name')); ?>:</b>
	<?php echo CHtml::encode($data->patient_name); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('cardno')); ?>:</b>
    <?php echo CHtml::encode($data->cardno); ?>
    <br />

	<!--
    <b><?php echo CHtml::encode($data->getAttributeLabel('doctor_id')); ?>:</b>
	<?php echo CHtml::encode($data->doctor_id); ?>
	<br />
    -->

	<b><?php echo CHtml::encode($data->getAttributeLabel('doctor')); ?>:</b>
	<?php echo CHtml::encode($data->doctor); ?>
	<br />

    
    
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('diagnosis')); ?>:</b>
	<?php echo CHtml::encode($data->diagnosis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('medicalservice')); ?>:</b>
	<?php echo CHtml::encode($data->medicalservice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge_type')); ?>:</b>
	<?php echo CHtml::encode($data->charge_type); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('by_userid')); ?>:</b>
	<?php echo CHtml::encode($data->by_userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hmo_billing_id')); ?>:</b>
	<?php echo CHtml::encode($data->hmo_billing_id); ?>
	<br />

	*/ ?>

</div>