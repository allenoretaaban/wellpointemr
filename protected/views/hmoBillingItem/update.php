<?php
$this->breadcrumbs=array(
	'Hmo Billing Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List HmoBillingItem', 'url'=>array('index')),
	//array('label'=>'Create HmoBillingItem', 'url'=>array('create')),
	//array('label'=>'View HmoBillingItem', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage HmoBillingItem', 'url'=>array('admin')),
);
?>

<h1>Update HMO Billing Item <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>