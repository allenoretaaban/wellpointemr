<?php
$this->breadcrumbs=array(
	'Invoice'=>array('invoice/admin'),
    $model->invoice->orno=>array('invoice/view','id'=>$model->invoice_id),
	$model->description
);

$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Invoice Item <?php echo $model->description; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'amount',
        'isvatable:boolean',
		'discount',
		'discountflat',
		'discountpercentage',
		'total'
	),
)); ?>