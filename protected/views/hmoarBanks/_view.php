<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('bankid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->bankid), array('view', 'id'=>$data->bankid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_title')); ?>:</b>
	<?php echo CHtml::encode($data->bank_title); ?>
	<br />


</div>