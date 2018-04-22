<?php
$this->breadcrumbs=array(
	'Medical Statuses'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Medical Status <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>