<?php
$this->breadcrumbs=array(
	'Cash Vouchers'=>array('admin'),
	$model->description,
);

$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Cash Voucher <?php echo $model->description; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'no',
		'date',
		'description',
		'amount',
		'receivedby',
		'approvedby',
		'preparedby',
	),
)); ?>
