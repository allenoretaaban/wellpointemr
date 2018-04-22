<?php
$this->breadcrumbs=array(
	'Daily Sheet Forms'=>array('admin'),
	$model->date,
);

$this->menu=array(
    array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
    array('label'=>'Print', 'url'=>array('print','id'=>$model->id)),
    array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Daily Sheet Form <?php echo $model->date; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'beginningcash',
		'supervisorname',
		'denomination1000',
		'denomination500',
		'denomination200',
		'denomination100',
		'denomination50',
		'denomination20',
		'denomination10',
		'denomination5',
		'denomination1',
		'denomination50c',
		'denomination25c',
		'denomination10c',
		'denomination5c',
		'denomination1c',
        'cashcensus_laboratory',
        'cashcensus_ancillary',
        'cashcensus_consultation',
        'hmocensus_laboratory',
        'hmocensus_ancillary',
        'hmocensus_consultation',
        'cashdeposit',
        'total',
		'verifiedby',
		'preparedby',
	),
)); ?>
