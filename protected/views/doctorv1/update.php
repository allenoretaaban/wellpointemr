<?php
$this->breadcrumbs=array(
	'Doctors'=>array('admin'),
	$model->firstname=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Doctor <?php echo $model->firstname; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>