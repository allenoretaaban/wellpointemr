<?php
$this->breadcrumbs=array(
	'Hmo Billing Items'=>array('index'),
	'Create',
);
/*
$this->menu=array(
	array('label'=>'List HmoBillingItem', 'url'=>array('index')),
	array('label'=>'Manage HmoBillingItem', 'url'=>array('admin')),
);
*/
?>

<h1>Create HMO Billing Item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>