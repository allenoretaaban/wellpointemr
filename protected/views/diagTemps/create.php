<?php
$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	'Create',
);

/*
$this->menu=array(
	array('label'=>'List DiagTemps', 'url'=>array('index')),
	array('label'=>'Manage DiagTemps', 'url'=>array('admin')),
);*/
?>

<h1>Create Diagnostic Template</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>