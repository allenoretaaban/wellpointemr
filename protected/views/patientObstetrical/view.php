<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
	$model->year
);

$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Obstetrical <?php echo $model->year; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'year',
		'place',
		'gestage',
		'mannerofdelivery',
		'babyweight',
		'babygender',
		'notes'
	),
)); ?>