<?php
$this->breadcrumbs=array(
	'Hmo Forms'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List HmoForm', 'url'=>array('index')),
	array('label'=>'Manage HmoForm', 'url'=>array('admin')),
);*/
?>

<h1>Create HMO Transaction</h1>
<?php echo $this->renderPartial('_form_create', array('model'=>$model)); ?>