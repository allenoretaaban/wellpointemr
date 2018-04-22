<?php
$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List DiagTemps', 'url'=>array('index')),
	array('label'=>'Create DiagTemps', 'url'=>array('create')),
	array('label'=>'View DiagTemps', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DiagTemps', 'url'=>array('admin')),
);*/
?>

<h1>Update Diagnostic Template <?php echo $model->id; ?></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>