<?php
$this->breadcrumbs=array(
	'Hmo Billing Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List HmoBillingItem', 'url'=>array('index')),
	array('label'=>'Create New Bill Item', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Back to list', 'url'=>array('admin')),
);
?>

<h1>View HMO Bill Item #<?php echo $model->id; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'avail_date',
        'refno', 
        'approval_code', 
        'hmo', 
		//'date_entered',
		//'patient_id',
		'patient_name',
        'cardno',
		//'doctor_id',
		'doctor',
		'diagnosis',
		'medicalservice',		
        array(
                    'name'=>'charge_type',
                    'value'=> HmoChargeType::model()->findByPk($model->charge_type)->charge_type
                ),		
        array(
                    'name'=>'charge',
                    'value'=> number_format($model->charge,2 )
                ),
		'by_userid',
		'hmo_billing_id',
	),
)); ?>


