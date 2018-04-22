<?php
$this->breadcrumbs=array(
	'Hmo Product Services'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List HmoProductService', 'url'=>array('index')),
	array('label'=>'Create New Record', 'url'=>array('create')),
	array('label'=>'Update Record', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Record', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this record?')),
	array('label'=>'Manage HMO Product/Service', 'url'=>array('admin')),
);
?>

<h1>View HmoProductService #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'amount',
		'name',
		'type',
		'category',
		'isvatable',
	),
)); ?>
