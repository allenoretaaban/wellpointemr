<?php
$this->breadcrumbs=array(
	'Diag Temps Results'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DiagTempsResults', 'url'=>array('index')),
	array('label'=>'Manage DiagTempsResults', 'url'=>array('admin')),
);
?>

<h1>Create DiagTempsResults</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>