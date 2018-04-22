<?php
$this->breadcrumbs=array(
	'Hmo Forms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	/*array('label'=>'List HmoForm', 'url'=>array('index')),
	array('label'=>'Create HmoForm', 'url'=>array('create')),
	*/
    array('label'=>'View Hmo Transaction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Back to HMO Transactions', 'url'=>array('admin')),
);
?>

<h1>Update HMO Transaction <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>