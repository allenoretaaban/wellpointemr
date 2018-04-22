<?php
$this->breadcrumbs=array(
	'Urinalysis'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update '.$model->id,
);
/*
$this->menu=array(
	array('label'=>'List DiagUrinalysis', 'url'=>array('index')),
	array('label'=>'Create DiagUrinalysis', 'url'=>array('create')),
	array('label'=>'View DiagUrinalysis', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DiagUrinalysis', 'url'=>array('admin')),
);
*/
?>

<h2>Update Patient's Diagnostic for Urinalysis</h2>
<?php echo CHtml::link('[View This Result]',array('diagUrinalysis/'.$model->id)); ?>
<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>