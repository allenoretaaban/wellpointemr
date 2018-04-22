<?php
/* @var $this ClientsController */
/* @var $data Clients */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->client_id), array('view', 'id'=>$data->client_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_name')); ?>:</b>
	<?php echo CHtml::encode($data->client_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_address')); ?>:</b>
	<?php echo CHtml::encode($data->client_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_telno')); ?>:</b>
	<?php echo CHtml::encode($data->client_telno); ?>
	<br />


</div>