<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdate')); ?>:</b>
	<?php echo CHtml::encode($data->createdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createby')); ?>:</b>
	<?php echo CHtml::encode($data->createby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateby')); ?>:</b>
	<?php echo CHtml::encode($data->updateby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp_title')); ?>:</b>
	<?php echo CHtml::encode($data->temp_title); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('result_title')); ?>:</b>
    <?php echo CHtml::encode($data->result_title); ?>
    <br />


</div>