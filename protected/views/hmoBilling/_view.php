<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hmo_id')); ?>:</b>
	<?php echo CHtml::encode($data->hmo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prepared_by')); ?>:</b>
	<?php echo CHtml::encode($data->prepared_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('by_userid')); ?>:</b>
	<?php echo CHtml::encode($data->by_userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_prepared')); ?>:</b>
	<?php echo CHtml::encode($data->date_prepared); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_due')); ?>:</b>
	<?php echo CHtml::encode($data->date_due); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pds_hmo_id')); ?>:</b>
	<?php echo CHtml::encode($data->pds_hmo_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_total')); ?>:</b>
	<?php echo CHtml::encode($data->bill_total); ?>
	<br />

	*/ ?>

</div>