<?php
$this->breadcrumbs=array(
	'Hmo Product Services'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List HmoProductService', 'url'=>array('index')),
	array('label'=>'Manage HMO Product/Service', 'url'=>array('admin')),
);
?>

<h1>Create New HMO Product/Service Item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>