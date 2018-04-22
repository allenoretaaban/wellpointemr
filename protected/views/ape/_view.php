<?php
/* @var $this ApeController */
/* @var $data Ape */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datevisited')); ?>:</b>
	<?php echo CHtml::encode($data->datevisited); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('department')); ?>:</b>
	<?php echo CHtml::encode($data->department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hmo')); ?>:</b>
	<?php echo CHtml::encode($data->hmo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_preemployment')); ?>:</b>
	<?php echo CHtml::encode($data->is_preemployment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_annual')); ?>:</b>
	<?php echo CHtml::encode($data->is_annual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_executive')); ?>:</b>
	<?php echo CHtml::encode($data->is_executive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_card')); ?>:</b>
	<?php echo CHtml::encode($data->is_card); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('card_number')); ?>:</b>
	<?php echo CHtml::encode($data->card_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_promo')); ?>:</b>
	<?php echo CHtml::encode($data->is_promo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promo')); ?>:</b>
	<?php echo CHtml::encode($data->promo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_others')); ?>:</b>
	<?php echo CHtml::encode($data->is_others); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('others')); ?>:</b>
	<?php echo CHtml::encode($data->others); ?>
	<br />

	*/ ?>

</div>