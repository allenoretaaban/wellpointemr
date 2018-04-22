<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('checkid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->checkid), array('view', 'id'=>$data->checkid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_no')); ?>:</b>
	<?php echo CHtml::encode($data->check_no); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('entry_date')); ?>:</b>
    <?php echo CHtml::encode($data->entry_date); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_date')); ?>:</b>
	<?php echo CHtml::encode($data->check_date); ?>
	<br />

	<!--b><?php echo CHtml::encode($data->getAttributeLabel('check_clear_date')); ?>:</b>
	<?php echo CHtml::encode($data->check_clear_date); ?>
	<br /-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_id')); ?>:</b>
	<?php echo CHtml::encode($data->bank_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hmo_id')); ?>:</b>
	<?php echo CHtml::encode($data->hmo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payto')); ?>:</b>
	<?php echo CHtml::encode($data->payto); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_doc_id')); ?>:</b>
	<?php echo CHtml::encode($data->pay_doc_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_amnt')); ?>:</b>
	<?php echo CHtml::encode($data->check_amnt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billed_amnt')); ?>:</b>
	<?php echo CHtml::encode($data->billed_amnt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wtax_amnt')); ?>:</b>
	<?php echo CHtml::encode($data->wtax_amnt); ?>
	<br />

	*/ ?>

</div>