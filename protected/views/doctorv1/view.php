<?php
$this->breadcrumbs=array(
	'Doctors'=>array('admin'),
	$model->firstname,
);

$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Doctor <?php echo $model->firstname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                array(        
                     'name'=>'filename',
                     'type'=>'raw',
                     'value'=>'<img src="../'.$model->filename.'" style="height:128px" />',
                ),
		'firstname',
		'lastname',
		'specialization',
                'prcno',
                'pmano',
                'isresident',
	),
)); ?>