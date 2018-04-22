<?php
$this->breadcrumbs=array(
	'Hmoar Checks'=>array('index'),
	$model->checkid,
);

$this->menu=array(
	array('label'=>'Add New', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->checkid)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->checkid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Received Checks', 'url'=>array('admin')),
);
?>

<h1>View Received Check #<?php echo $model->check_no; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'check_no',
		'check_date',
		 array(
                    'name'=>'Bank',
                    'value'=> HmoarBanks::model()->findByPk($model->bank_id)->bank_title
                ),   
		
        array(
                    'name'=>'HMO',
                    'value'=> Hmo::model()->findByPk($model->hmo_id)->name
                ),   
		'payto',
		
         array(
                    'name'=>'Doctor',
                    'value'=> Doctor::model()->findByPk($model->pay_doc_id)->firstname . " ".Doctor::model()->findByPk($model->pay_doc_id)->lastname
                ), 
        
		'check_amnt',
		'billed_amnt',
		'wtax_amnt',
	),
)); 

?>
