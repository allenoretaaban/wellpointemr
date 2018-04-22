<?php
$this->breadcrumbs=array(
	'Hmo Billings'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List HmoBilling', 'url'=>array('index')),
	//array('label'=>'Create HmoBilling', 'url'=>array('create')),
	//array('label'=>'Update HmoBilling', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete HmoBilling', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Print Billing', 'url'=>array('printbilling', 'id'=>$model->id), 'target'=>'_blank'),
    array('label'=>'Print Billing with Categories', 'url'=>array('printbillingCategory', 'id'=>$model->id), 'target'=>'_blank'),
	array('label'=>'Back to Billings List', 'url'=>array('admin'), 'target'=>'_blank'),
);
?>

<h1>View HMO Billing #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',		
         array(
                    'name'=>'HMO',
                    'value'=> Hmo::model()->findByPk($model->hmo_id)->name
                ),        
		'prepared_by',
		//'by_userid',
		'date_prepared',
		'date_due',
		//'pds_hmo_id',		
         array(
                    'name'=>'bill_total',
                    'value'=> number_format($model->bill_total,2 )
                ),
	),
)); ?>

<div>
    <fieldset>
        <legend>Hmo Forms</legend>
        <?php echo $this->renderPartial('bill_items', array('model'=>$model)); ?>
    </fieldset>

</div>