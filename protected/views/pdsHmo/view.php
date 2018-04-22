<?php
$this->breadcrumbs=array(
	'PDS'=>array('pds/admin'),
        $model->pds->id=>array('pds/view','id'=>$model->pds->id),
	$model->controlno
);

$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View HMO <?php echo $model->controlno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'controlno',
		'approvalcode',
		'notes',
		array(
                    'name'=>'hmo_id',
                    'value'=>$model->hmo->name
                )
	),
)); ?>