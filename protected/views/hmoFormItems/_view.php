<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->itemid), array('view', 'id'=>$data->itemid)); ?>
	<br />                                                                       
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('hmo_form_id')); ?>:</b>
    <?php echo CHtml::encode($data->hmo_form_id); ?>
    <br />    
    
    <!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('item_entry_date')); ?>:</b>
	<?php echo CHtml::encode($data->item_entry_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_avail_date')); ?>:</b>
	<?php echo CHtml::encode($data->item_avail_date); ?>
	<br />
    -->
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('payto')); ?>:</b>
	<?php echo CHtml::encode($data->payto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('claim_doctor_id')); ?>:</b>
	<?php echo CHtml::encode($data->claim_doctor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('claim_doctor_name')); ?>:</b>
	<?php echo CHtml::encode($data->claim_doctor_name); ?>
	<br />      
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('diagnosis')); ?>:</b>
	<?php echo CHtml::encode($data->diagnosis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('med_service')); ?>:</b>
	<?php echo CHtml::encode($data->med_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_type')); ?>:</b>
	<?php echo CHtml::encode($data->service_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_doctor')); ?>:</b>
	<?php echo CHtml::encode($data->req_doctor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge_type')); ?>:</b>
	<?php echo CHtml::encode($data->charge_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge_fee')); ?>:</b>
	<?php echo CHtml::encode($data->charge_fee); ?>
	<br />

	

</div>