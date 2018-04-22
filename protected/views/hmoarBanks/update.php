<?php
$this->breadcrumbs=array(
	'Hmoar Banks'=>array('index'),
	$model->bankid=>array('view','id'=>$model->bankid),
	'Update',
);

$this->menu=array(
	array('label'=>'Add New Check Bank', 'url'=>array('create')),
	array('label'=>'View Check Bank', 'url'=>array('view', 'id'=>$model->bankid)),
	array('label'=>'Check Banks', 'url'=>array('admin')),
);
?>

<h1>Update Check Bank #<?php echo $model->bankid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>