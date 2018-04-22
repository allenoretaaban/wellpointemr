<?php
$this->breadcrumbs=array(
	'Invoices'=>array('admin'),
	$model->patientname,
);

$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Print', 'url'=>array('print','id'=>$model->id)),
);
?>

<h1>View Invoice <?php echo $model->patientname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'orno',
		'date',
		'subtotal',
		'vatexemptsale',
		'total',
		'preparedby',
        'patientname'
	),
)); ?>

<br/>
<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs'=>array(
                'Item'=>$this->renderPartial('relation/_item', array('model'=>$model), $this),
                'Discount'=>$this->renderPartial('relation/_discount', array('model'=>$model), $this)
        ),
));
?>