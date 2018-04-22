<?php
$this->breadcrumbs=array(
	'Hmoar Banks'=>array('index'),
	$model->bankid,
);

$this->menu=array(
	array('label'=>'Add New Check Bank', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->bankid)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->bankid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Check Banks', 'url'=>array('admin')),
);
?>

<h1>View Check Bank #<?php echo $model->bankid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bankid',
		'bank_title',
	),
)); ?>
