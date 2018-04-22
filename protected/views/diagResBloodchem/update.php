<?php
$this->breadcrumbs=array(
	'Blood Chemistry Results'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List DiagResBloodchem', 'url'=>array('index')),
	array('label'=>'Create DiagResBloodchem', 'url'=>array('create')),
	array('label'=>'View DiagResBloodchem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DiagResBloodchem', 'url'=>array('admin')),
);*/

?>

<h1>Update Blood Chemistry Result #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>