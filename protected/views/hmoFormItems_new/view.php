<?php
$this->breadcrumbs=array(
	'Hmo Form Items'=>array('index'),
	$model->itemid,
);

$this->menu=array(
	//array('label'=>'List HmoFormItems', 'url'=>array('index')),
	//array('label'=>'Create HmoFormItems', 'url'=>array('create')),
	array('label'=>'Update Transaction Item', 'url'=>array('update', 'id'=>$model->itemid)),
    array('label'=>'Delete Transaction Item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->itemid),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Back To Transaction', 'url'=>array('hmoForm/view/', 'id'=>$model->hmo_form_id)),	
	//array('label'=>'Manage HmoFormItems', 'url'=>array('admin')),
);
?>

<h1>View HMO Trnx Item #<?php echo $model->itemid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'itemid',
		//'hmo_form_id',
		//'item_entry_date',
		//'item_avail_date',
		'payto',
		//'claim_doctor_id',
		'claim_doctor_name',
		'diagnosis',
		'med_service',
		'service_type',
		'req_doctor',
		'charge_type',
		'charge_fee',
	),
)); ?>
