<?php
$this->breadcrumbs=array(
	'Hmoar Checks'=>array('index'),
	$model->checkid=>array('view','id'=>$model->checkid),
	'Update',
);

$this->menu=array(
	array('label'=>'Add New', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->checkid)),
	array('label'=>'Received Checks', 'url'=>array('admin')),
);
?>

<h1>Update Received Check #<?php echo $model->checkid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>