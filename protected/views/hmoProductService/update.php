<?php
$this->breadcrumbs=array(
	'Hmo Product Services'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List HmoProductService', 'url'=>array('index')),
	array('label'=>'Create New Record', 'url'=>array('create')),
	array('label'=>'View Product/Service', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage HMO Product/Service', 'url'=>array('admin')),
);
?>

<h1>Update HmoProductService <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>