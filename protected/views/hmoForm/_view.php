<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />                                                                    
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('hmo_id')); ?>:</b>
	<?php echo CHtml::encode($data->hmo_id); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('hmo_name')); ?>:</b>
    <?php echo CHtml::encode($data->hmo_name); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_name')); ?>:</b>
	<?php echo CHtml::encode($data->patient_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entry_date')); ?>:</b>
	<?php echo CHtml::encode($data->entry_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avail_date')); ?>:</b>
	<?php echo CHtml::encode($data->avail_date); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('hmo_billing_id')); ?>:</b>
    <?php echo CHtml::encode($data->hmo_billing_id); ?>
    <br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('control_no')); ?>:</b>
	<?php echo CHtml::encode($data->control_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('card_no')); ?>:</b>
	<?php echo CHtml::encode($data->card_no); ?>
	<br />

	*/ ?>

</div>